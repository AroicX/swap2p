@extends('layouts.app')
@section('content')

<!--page-content-wrapper-->
<div class="page-content-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
			<div class="breadcrumb-title pr-3">Back Office</div>
			<div class="pl-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Verify Account</li>
					</ol>
				</nav>
			</div>
			<div class="ml-auto">
			</div>
		</div>
		<!--end breadcrumb-->
		
		<div class="row">
		<div class="col-sm-6 offset-sm-3 col-md-6 offset-md-3">
		<div class="user-profile-page">
			<div class="card radius-5">
				<div class="card-body pt-5 mx-3">
						@if(Auth::user()->status=="pending")
							<form method="post" action={{ route('verify') }}>
								@csrf
								<div class="row">
									<div class="col-md-12 form-group">
										<label>Enter Verification Code</label>
										<input type="text" name="evc" class="form-control">
									</div>
								</div>
								<button type="submit" class="float-right btn btn-md btn-success text-white">Verify Now</button>
							</form>
						@elseif(Auth::user()->status=="active")
							<div class="alert alert-success">Account active!</div>
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