@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet" />
@endsection

@section('content')

<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">Unfulfilled Merging</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('merging') }}">Mergings</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Upload Proof</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-sm-6 offset-sm-3 col-md-6 offset-md-3">
                <hr>
                <div class="user-profile-page">
                    <div class="card radius-5">

                        <div class="card-header">
                            <h5>Upload Proof of Payment</h5>
                        </div>
                        <div class="card-body pt-5 mx-3">
                            @if($mid)
                            @php
                            $proof = \App\Models\Proof::where('mid', $mid)->first();
                            @endphp
                            @if(!$proof)
                            <form method="post" action={{ route('save.proof') }} enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="mid" value="{{$mid}}">
                                <div class="row">

                                    @if ($errors->any())
                                        <div class="alert alert-warning mx-1">
                                            @foreach ($errors->all() as $error)
                                            <li>{{$error}}</li>
                                            @endforeach
                                        </div>
                                        @endif

            
                                <br>

                                <div class="col-md-12 form-group">
                                    <label>Select Clear Photo</label>
                                    <small class="text-danger">Note: Image should not be greater than 1mb</small>
                                    <input required type="file" accept="image/*" name="file" class="form-control"
                                        required>

                                   
                                </div>


                                <div class="col-md-12 form-group">
                                    <label>Transaction Id</label>
                                    <input type="text" name="transaction_id" class="form-control" required>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label>Extra Note <small class="text-danger">(Required)</small></label>
                                    <textarea rows="2" name="note" class="form-control" required></textarea>
                                </div>
                        </div>
                        <button type="submit" class="float-right btn btn-md btn-success text-white">Done</button>
                        </form>
                        @else
                        <div class="alert alert-danger">
                            Proof already uploaded!
                        </div>
                        <div class="float-right mt-0">
                            <form method="POST" action="{{ route('delete.proof') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $proof->id }}">
                                <button type="submit"  class="mt-3 btn btn-md btn-danger">Delete</button>
                            </form>
                        </div>
                        @endif
                        @else
                        <div class="alert alert-success">No merging found!</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--end page-content-wrapper-->

@endsection

@section('script')

<script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="assets/plugins/fancy-file-uploader/jquery.ui.widget.js"></script>
<script src="assets/plugins/fancy-file-uploader/jquery.fileupload.js"></script>
<script src="assets/plugins/fancy-file-uploader/jquery.iframe-transport.js"></script>
<script src="assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js"></script>
<script src="assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js"></script>
<script>
    $('#fancy-file-upload').FancyFileUpload({
        params: {
            action: 'fileuploader'
        },
        maxfilesize: 1000000
    });

</script>
<script>
    $(document).ready(function () {
        $('#image-uploadify').imageuploadify();
    })

</script>
@endsection
