@extends('layouts.master')



@section('content')

<div class="container-fluid" >

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card mt-2">

                                    <div class="card-header">
                                        <h3 class="font-weight-light my-4"> </h3>
                                        <div class="row">
                                            <!-- <div class="col-md-1">
                                                <a  class="btn btn-info btn-block"  href="{{route('membre.create')}}" class="text-white">
                                                    <i class="fa fa-user-plus" style="font-size:40px;"></i>
                                                </a>
                                                <label class="text-center">Nouveau </label>
                                            </div>                                 -->

                                            <div class="col-md-1">
                                                <a href="{{route('inscription.presence',['inscription'=>$inscription->id])}}" class="btn btn-info text-white">
                                                    <i class="fa fa-list" style="font-size:40px;" ></i>
                                                </a>
                                                <label class="text-center">Présences</label>
                                            </div>
                                            



                                            
                                            <div class="col-md-1" >
                                                <button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#renouvler" >
                                                    <i class="fa fa-redo" style="font-size:40px;" aria-hidden="true"></i>
                                                </button>
                                                <label class="text-center">Renouvler </label>
                                            </div>
                                                                           
                                            

                                        </div>

                                    </div>





                                    <div class="card-header">
                                        <h3 class="font-weight-light my-4"> Modifier Membre : 
                                        
                                            {{$membre->nom ?? ''}}
{{$membre->prenom ?? ''}}
                                          </h3>
                                          <div class="form-group">
                                                        <label style="font-size: 30px;">
                                                            Séance Reste : {{$inscription->reste ?? ''}}
                                                        </label>
                                                    </div>
                                        <div class="row">
                                            



                                        </div>


                                    </div>
                                    <div class="card-body" >
                                        <form role="form" action="{{route('membre.update',['membre'=>$membre->id])}}" method="post">
                                        <input id="mydata" type="hidden" name="mydata" value=""/>

                                        @csrf

                                            <div class="row">

                                                <div class="col-sm-4">

                                                    <div class="form-group">
                                                        <img id="blah" src="{{asset($membre->photo)}}"  width="150px" alt="" />

                                                        
                                                    </div>

                                                        


                                                    <div class="form-group">
                                                        <label>Code de Matricule</label>
                                                        <input type="text" readonly  value="{{$membre->matricule ?? ''}}" name="matricule" class="form-control">

                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nom</label>
                                                        <input type="text"  required value="{{$membre->nom ?? ''}}" name="nom" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Prénom</label>
                                                        <input type="text"  required value="{{$membre->prenom ?? ''}}" name="prenom" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Adresse</label>
                                                        <input type="text"  value="{{$membre->adresse ?? ''}}" name="adresse" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Téléphone</label>
                                                        <input type="text"  value="{{$membre->telephone ?? ''}}" name="telephone" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Genre</label>
                                                        <select class="form-control" name="sexe">
                                                            <option value="femme">Femme</option>						                                                             
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text"  value="{{$membre->email ?? ''}}" name="email" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Group Sanguin</label>
                                                        <select class="form-control" name="sanguin">
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>

                                                        </select>

                                                    </div>


                                                </div>

                                                    
                                                <div class ="col-sm-1  ">
                                                    <div class="form-group">
                                                        <a class="btn btn-danger text-white" href="{{route('membre.minus',['membre'=>$membre->id])}}">
                                                            <i class="fa fa-minus " style="padding:20px;font-size:40px;"></i>
                                                        </a>
                                                    </div>
                                                    

                                                </div>

                                                <!-- <div class ="col-sm-1  ">
                                                    <div class="form-group">
                                                        <input value="0" name="nbr" class="form-control" />
                                                    </div>
                                                    

                                                </div> -->
                                                <div class ="col-sm-1">
                                                    <div class="form-group">
                                                        <a class="btn btn-info text-white" href="{{route('membre.plus',['membre'=>$membre->id])}}">
                                                            <i class="fa fa-plus " style="padding:20px;font-size:40px;"></i>
                                                        </a>
                                                    </div>

                                                </div>

                                                <div class ="col-sm-1">
                                                </div>

                                                <div class ="col-sm-4 col-md-ofset-2">

                                                


                                                    <div class="form-group">
                                                        <label>Type :</label>
                                                        <select class="form-control" name="sexe">
                                                            <option value="femme">Femme</option>	
                                                            <option value="mixte">mixte</option>						                                                             
                                                        </select>
                                                    </div>
                                                
                                                    <div class="form-group">
                                                        <label>Nombre de mois</label>
                                                        <input type="number"  value="{{$inscription->nbrmois ?? '' ?? 1}}" min="1" id="nbrmois" name="nbrmois" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Abonnement</label>
                                                        <select class="form-control" id="abonnement" name="abonnement">
                                                            <option value="">séléctionner un abonnement</option>
                                                            @foreach($abonnements as $abonnement)
                                                            <option @if($inscription->abonnement == $abonnement->id) selected @endif value="{{$abonnement}}">{{$abonnement->label}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Date début</label>
                                                        <input type="date" id="debut"  value="{{$inscription->debut}}" name="debut" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Date Fin</label>
                                                        <input type="date" id="fin"  value="{{$inscription->fin}}" name="debut" class="form-control">
                                                    </div>




                                                    <div class="form-group">
                                                        <label>Remarque :</label>
                                                        <input id="remarque" type="text" value="{{$inscription->remarque ?? 'sa' }}" name="remarque" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Tarification:</label>
                                                        <input type="number"  name="tarif" value="{{$inscription->tarif}}" id="tarif" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Assurance:</label>

                                                        <div class="form-check">
                                                          <input class="form-check-input" type="radio" name="assurance" value="1" id="flexRadioDefault1" @if($membre->assurance==1) checked @endif>
                                                          <label class="form-check-label" for="flexRadioDefault1">
                                                            A Payé
                                                          </label>
                                                        </div>
                                                        <div class="form-check">
                                                          <input class="form-check-input" type="radio" name="assurance" value="0" id="flexRadioDefault2" @if($membre->assurance==0) checked @endif >
                                                          <label class="form-check-label" for="flexRadioDefault2">
                                                            Non Payante
                                                          </label>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label>Total</label>
                                                        <input type="number" id="total" value="{{$inscription->total ?? ''}}" name="total" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Remise</label>
                                                        <input type="number" value="{{$inscription->remise ?? '' ?? 0}}" id="remise" name="remise" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Versement</label>
                                                        <input type="number" value="{{$inscription->versement ?? '' ?? 0}}" id="versement" name="versement" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Total Final : </label>
                                                        <input type="number" value="{{$inscription->ttc ?? '' ?? 0}}" id="ttc" name="ttc" class="form-control">
                                                    </div>


                                                </div>


                                                <div class ="col-sm-4">

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-2" style="padding:30px;">
                                                    <button style="padding:30px;font-size:30px;" type="submit" id="valider"  class="btn btn-info btn-block">Valider</button>
                                                </div>
                                                <div class="col-md-2" style="padding:30px;">
                                                    <button style="padding:30px;font-size:30px;" 
                                                    onclick="window.history.go(-1); return false;"

                                                     class="btn btn-danger btn-block">Annuler</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>



                                <!-- <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Type d'abonnement  </h3></div>
                                    <div class="card-body">
                                            <div class="row">

                                            </div>

                                        </form>
                                    </div>
                                </div> -->



                            </div>

                        </div>

                    </div>

                        @include('includes.modals.renouvler',['membre'=>$membre])

@endsection


@section('scripts')

<script>

    function take_snapshot() {
            // take snapshot and get image data
            Webcam.snap( function(data_uri) {
                var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
                
                document.getElementById('mydata').value = raw_image_data;
                // document.getElementById('myform').submit();
                document.getElementById('blah').src = data_uri

            } );
        }
$(document).ready(function() {
    
        
    $('#today').on('click',function(){
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
        var today = year+ "-" +month+ "-" +day;//+"-"+// + "-" +  +"T00:00";       
        $("#debut").attr("value", today);

    })
    $('#abonnement').on('change',function(event){
        var value = JSON.parse(this.value);
        var remise = $('#remise').val();
        console.log(ttc)
        var assurance = $('#tarif').val()

        $('#tarif').val(value.tarif)
        $('#total').val($('#nbrmois').val()*$('#tarif').val())
        $('#versement').val($('#nbrmois').val()*$('#tarif').val()+1000)
        var total =  $('#total').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc').val(ttc)

    })
    $('#remise').on('change',function(){
        var remise = this.value;
        var total =  $('#total').val()
        var ttc = total - remise 
        $('#ttc').val(ttc)

    })
    $('#nbrmois').on('change',function(event){
        var value = this.value;
        var debut = new Date($('#debut').val());
        var fin  = debut.setMonth(debut.getMonth()+value); 
        var remise = $('#remise').val();
        $('#total').val(value*$('#tarif').val())
        $('#versement').val(value*$('#tarif').val())
        $('#fin').val(fin)
        var total =  $('#total').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc').val(ttc)
    })

    // secnd part 2 

    $('#today2').on('click',function(){
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth() + 1;
        var year = date.getFullYear();
        if (month < 10) month = "0" + month;
        if (day < 10) day = "0" + day;
        var today = year+ "-" +month+ "-" +day;//+"-"+// + "-" +  +"T00:00";       
        $("#debut").attr("value", today);

    })
    $('#abonnement2').on('change',function(event){
        var value = JSON.parse(this.value);
        var remise = $('#remise2').val();
        console.log(ttc)

        $('#tarif2').val(value.tarif)
        $('#total2').val($('#nbrmois2').val()*$('#tarif2').val())
        $('#versement2').val($('#nbrmois2').val()*$('#tarif2').val())
        var total =  $('#total2').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc2').val(ttc)

    })
    $('#remise2').on('change',function(){
        var remise = this.value;
        var total =  $('#total2').val()
        var ttc = total - remise 
        $('#ttc2').val(ttc)

    })
    $('#nbrmois2').on('change',function(event){
        var value = this.value;
        var debut = new Date($('#debut2').val());
        var fin  = debut.setMonth(debut.getMonth()+value); 
        var remise = $('#remise2').val();
        $('#total2').val(value*$('#tarif2').val()+1000)
        $('#versement2').val(value*$('#tarif2').val())
        $('#fin2').val(fin)
        var total =  $('#total2').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc2').val(ttc+1000)

    })

});

</script>
@endsection


