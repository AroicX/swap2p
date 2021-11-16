@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('treant/Treant.css') }}">
<script src="{{ asset('treant/vendor/raphael.js') }}"></script>
<script src="{{ asset('treant/Treant.js') }}"></script>

<?php
//TREE DATA
$username = Auth::user()->username;
$merge_stage1 = \App\Models\Merge::where(['upline' => Auth::user()->user_id, 'stage' => 1])->get();

$merge_stage2 = \App\Models\Merge::where(['upline' => Auth::user()->user_id, 'stage' => 2])->get();

$merge_stage3 = \App\Models\Merge::where(['upline' => Auth::user()->user_id, 'stage' => 3])->get();

$merge_stage4 = \App\Models\Merge::where(['upline' => Auth::user()->user_id, 'stage' => 4])->get();

$merge_stage5 = \App\Models\Merge::where(['upline' => Auth::user()->user_id, 'stage' => 5])->get();

$merge_stage = [$merge_stage1,$merge_stage2,$merge_stage3,$merge_stage4,$merge_stage5];
?>
<!--page-content-wrapper-->
<div class="page-content-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
            <div class="breadcrumb-title pr-3">Genealogy</div>
            <div class="pl-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class='bx bx-home-alt'></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Genealogy</li>
                    </ol>
                </nav>
            </div>
            <div class="ml-auto">
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="user-profile-page">
                    <div class="card radius-15">
                        <div class="card-body p-5 m-3">

                    <?php for ($i=0; $i < 5 ; $i++) { 
                        $stage = \App\Models\Stage::where('sid', $i+1)->first();
                    ?>
                        <div class="shadow my-2">
                        <h4 class="p-2 m-2 font-weight-bold">STAGE <?php echo $i+1; ?></h4>
                        <div class="alert alert-light p-2">
                            <b>Mergings:</b> <?php echo $stage->downline; ?><br>
                            <b>Per Merge:</b> &#8358;<?php echo $stage->amount; ?><br>
                            <b>Returns:</b> &#8358;<?php echo $stage->downline*$stage->amount; ?><br>
                        </div>
                        <hr>
                        <div id="genealogyTree<?php echo $i; ?>"></div>
                        </div>
                            
                        <script>
                            var tree<?php echo $i ?> = {
                                chart: { 
                                container: "#genealogyTree<?php echo $i; ?>" },
                                nodeStructure: {
                                    text: { name: "<?php echo Auth::user()->username; ?>" },
                                    children: [
                                    <?php
                                        foreach($merge_stage[$i] as $ms1){
                                        $ms1User = \App\Models\User::where('user_id', $ms1->downline)->value('username');
                                        $ms1Username = (empty($ms1User) ? "N/A" : $ms1User);
                                        echo '{ text: { name: "'.$ms1Username.'"} },';
                                        }
                                   
                                    ?>
                                    ]
                                }
                            };
                        </script>
                        <script>
                            new Treant( tree<?php echo $i; ?> );
                        </script>
                    <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
<!--end page-content-wrapper-->

@endsection
