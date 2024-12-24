@extends('layouts.profile')

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
                    @if(strlen(Setting::getSetting('titre'))>0)
                        <img  src="{{asset(Setting::getSetting('logo'))}}" width="400px" />
                    @else
                        <img  src="{{asset('img/gymA.svg')}}" width="400px" />
                    @endif
                    </div>
                </div>
                <br>

                
                <div class="row " >
                    <div class="col-md-12" style="text-align:center;">
                    <h1 class="cls_001">Bienvenue Chez {{Setting::getSetting('titre')}} </h1>
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
