@extends('layouts.master')

@section('styles')
    <style type="text/css">
    .switch {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 34px;
    float: right; /* Align the switch to the right */
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 26px;
    width: 26px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #4CAF50; /* Change color when checked */
}

input:checked + .slider:before {
    transform: translateX(26px);
}

.label-text {
    margin-left: 10px; /* Adjust spacing between switch and label */
    font-size: 16px;   /* Adjust font size as needed */
    vertical-align: middle; /* Aligns with the switch */
}

    </style>
@endsection

@section('content')
<?php 
use App\Setting;
?>
<div class="container">

    <div class="row">

        <div class="col-lg-12 table1">
            <div class="card mt-2 ">
                <div class="card-header">
                    <h3 class="font-weight-light my-4"> Paramètre de l'application: <h3>
                </div>
                <div class="card-body">
                    <form role="form" action="{{route('setting.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                      Etat par feu : 
                                    </label>
                                    <h3 class="badge badge-success" style="font-size:20px;">
                                        {{$firewall }}
                                    </h3>
                                </div>

                                <div class="form-group">
                                    <label>
                                      Nom de la salle : 
                                    </label>
                                    <input value="{{Setting::getSetting('titre')}}" name="titre" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                      Email : 
                                    </label>
                                    <input value="{{Setting::getSetting('email')}}" name="email" type="email" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Telephone: 
                                    </label>
                                    <input value="{{Setting::getSetting('telephone')}}" name="telephone" type="number" class="form-control"/>
                                </div>


               

                                <div class="form-group">
                                    <label>
                                        Adress :
                                    </label>
                                    <input value="{{Setting::getSetting('adress')}}" name="adress"  class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <button class="btn bubbly-button" type="submit"> Sauvgarder </button>
                                </div>

                                



                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                       Lien ( Paramètre System ): 
                                    </label>
                                    <input value="{{Setting::getSetting('lien')}}" name="lien"  class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                       URL de serveur :  
                                    </label>
                                    <input value="{{Setting::getSetting('serveur')}}" name="serveur"  class="form-control"/>
                                </div>
                               
                                <div class="form-group">
                                    <label>
                                        Nombre de Tourniquet : 
                                    </label>
                                    <input value="{{Setting::getSetting('nbrtourniquet')}}" name="nbrtourniquet"  class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Tarif Assurance : 
                                    </label>
                                    <input value="{{Setting::getSetting('assurance')}}" name="assurance"  class="form-control"/>
                                </div>

                                <div class="form-group">
                                        <label>
                                            Voix Dans Modifier : 
                                        </label>
                                    <label class="switch">
                                        <input type="checkbox" name="toggle" id="toggleCheckbox" value="1" >
                                        <span class="slider"></span>
                                    </label>
                                    <input type="hidden" name="voixedit" value="0">
                                </div>

                                <div class="form-group">
                                    <label>
                                            Camera: 
                                        </label>
                                    <label class="switch">
                                        <input type="checkbox" name="toggle" id="toggleCheckbox" value="1" >
                                        <span class="slider"></span>
                                    </label>
                                    <input type="hidden" name="camera" value="0">

                                </div>
                                <div class="form-group">
                                    <label class="label-text">Moins dans Scanner : </label>

                                    <label class="switch">
                                        <input type="checkbox" name="toggle" id="toggleCheckbox" value="1" >
                                        <span class="slider"></span>
                                    </label>
                                    <input type="hidden" name="minus" value="0">


                                </div>

                               
                            </div>


                            <div class="col-md-3">

                                <div class="form-group">
                                    <img  src="{{asset(Setting::getSetting('logo'))}}" width="200px" />
                                </div>
                                <div class="form-group">
                                    <label>
                                        Logo :
                                    </label>
                                    <input value="{{Setting::getSetting('logo')}}" name="logo"  type="file" class="file-control"/>
                                </div>


                                <div class="form-group">
                                        <a href="{{route('clear.records')}}" class="btn  bubbly-button">
                                            <i class="fa fa-trash"></i> Vider La Liste des Entrés
                                        </a>
                                    </div>

                                <div class="form-group">
                                        <a href="/export" class="btn  bubbly-button">
                                            Exporter
                                        </a>
                                    </div>
                                    <div class="form-group">


                                </div>

                                    <div class="form-group">
                                        <a href="/repairTables" class="btn  bubbly-button">
                                            Réparer Les tables
                                        </a>
                                    </div>
                                    <div class="form-group">


                                </div>

                            </div>

                        </div>




                    </form> 
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
