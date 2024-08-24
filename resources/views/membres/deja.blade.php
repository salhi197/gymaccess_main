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
                    <div class="col-md-6" style="text-align:center;">
                        <div class="profile-img">
                            @if(strlen($membre->photo)>0)
                            <img src="{{asset($membre->photo)}}" width="400px" alt=""/>
                            @else
                            <img src="{{asset('img/gymA.svg')}}" width="400px" alt=""/>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 pad-20">
                        <div class="profile-head">
                                    <div class='corner2'></div>
                                    <div class='corner2'></div>
                                    <div class='corner2'></div>
                                    <div class='corner2'></div>

                                    <h1 style="text-align:center;">
                                        {{$membre->nom}}  
                                    </h1>
                                    <h1 style="text-align:center;">

                                        {{$membre->prenom}} 
                                    </h1>
                                    <p style="text-align:center;">


                                            <?php if($inscription->reste==0 or $inscription->fin<date('Y-m-d')) {?>
                                                <span id="loading2" class="btn btn-danger">
                                                    Expiré
                                                </span>

                                            <?php }else { ?>
                                                <span id="loading" class="btn btn-success">
                                                    Active
                                                </span>


                                            <?php } ?>


                                    </p>

                                    <div class="">
                                    <!-- <p class="proile-rating"> Poids : <span>70kg</span></p>
                                    <p class="proile-rating">Taille  : <span>188cm</span></p> -->
                                    </div>
<!--                             <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                            </ul> -->
                        </div>
<div class="col-md-6 pad-20">
                  
                    </div>
                    </div>

                    <!-- <div class="col-md-2 editbutton">
                        <a href="{{route('membre.edit',['membre'=>$membre->matricule])}}"  class="bubbly-button">
                            Modifier 
                        </a>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="profile-work">
                        </div>
                    </div>
                    <div class="col-md-10 profileTab pad-50 marg-50">
                                <div class='corner'></div>
                                <div class='corner'></div>
                                <div class='corner'></div>
                                <div class='corner'></div>
                        <div class="tab-content profile-tab " id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            @if($inscription->abonnement != 1)                                               
                                            <div class="col-md-12">
                                                <p style="font-size:60px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"> 

                                            <?php if($inscription->reste==0 or $inscription->fin<date('Y-m-d')) {?>
                                                    0
                                            <?php }else { ?>
                                                {{$inscription->reste ?? ''}}
                                            <?php } ?>

                                                 <label>Séances</label></p>
                                            </div>
                                            @else
                                            <div class="col-md-12">
                                                <p style="font-size:60px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"> Accées Libre </p>
                                            </div>
                                            @endif
                                        </div>
                                  <!--       <div class="row">
                                            <div class="col-md-6">
                                                <label>Inscription : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 style="font-size:40px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center">{{$inscription->getAbonnement()['label'] ?? '  '}}</h5>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date Début : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 style="font-size:50px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center">{{$inscription->debut}}</h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date Fin : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 style="font-size:50px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center" id="datefin">{{$inscription->fin}}</h1>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label> Abonnement : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 style="font-size:50px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center" >{{$inscription->getAbonnement() ?? ''}}</h1>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Crédit : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 style="font-size:50px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center">

                                                    {{$inscription->total-$inscription->versement}} DA                                                
                                                    
                                                </h1>
                                            </div>
                                        </div>
                                        
                                        

                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
                                        <input id="reste22" type="hidden" value="{{$inscription->reste ?? ''}}"/>
                                        <input id="nom" type="hidden" value="{{$membre->nom ?? ''}}"/>
                                        <input id="prenom" type="hidden" value="{{$membre->prenom ?? ''}}"/>
                                        <input id="reste" type="hidden" value="{{$inscription->total-$inscription->versement}}"/>

@endsection

@section('scripts')
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>

<script src="{{asset('adminlte/plugins/toastr/toastr.min.js')}}"></script>

<script src="{{asset('js/responsivevoice.js')}}"></script>

<script type="text/javascript">
             var host = {!! json_encode(url('/')) !!}         
            var envurl = {!! json_encode(Setting::getSetting('lien')) !!}         
            console.log(host)
            setInterval(function(){ 
                    window.location.href = envurl+':8000/membre/default';

            }, 10000);
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var reste = $('#reste22').val();     
        var nom = $('#nom').val();     
        var prenom = $('#prenom').val();     
        var fin = $('#datefin').text();     
        var reste = $('#reste22').val();     
        var credit = $('#reste').val();     
        console.log(credit)
        responsiveVoice.speak("Bienvenue , Vous Avez déja utilsé Votre séance", "French Female");

    })


</script>
@endsection