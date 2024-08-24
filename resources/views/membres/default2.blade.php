@extends('layouts.profile2')

@section('content')
<?php 
use App\Setting;
?>
        <div class="container emp-profile  table2 membreProfile "
            style="margin-top:-4%;"
        >
            <form method="post">
                <div class="row " >
                    <div class="col-md-12" style="text-align:center;">
                        <img src="{{asset('img/logo.png')}}" width="1000px">
                    </div>
                </div>
                <div class="row " >

                    <div class="col-md-12 pad-20">
                        <div class="profile-head">
                                    <p style="text-align:center;font-size: 60px">
                                        
                                    </p>

                                    

                        </div>
                    </div>
                   
                </div>
                <div class="row">
                   
                    
                </div>
            </form>           
        </div>
@endsection
