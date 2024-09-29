@extends('layouts.master')


@section('scripts')
<script src="{{asset('js/scannerjs/scanner.js')}}" type="text/javascript"></script>


<script>
        //
        // Please read scanner.js developer's guide at: http://asprise.com/document-scan-upload-image-browser/ie-chrome-firefox-scanner-docs.html
        //

        /** Initiates a scan */
        function scanToJpg() {
            scanner.scan(displayImagesOnPage,
                    {
                        "output_settings": [
                            {
                                "type": "return-base64",
                                "format": "jpg"
                            }
                        ]
                    }
            );
        }

        /** Processes the scan result */
        function displayImagesOnPage(successful, mesg, response) {
            if(!successful) { // On error
                console.error('Failed: ' + mesg);
                return;
            }

            if(successful && mesg != null && mesg.toLowerCase().indexOf('user cancel') >= 0) { // User cancelled.
                console.info('User cancelled');
                return;
            }

            var scannedImages = scanner.getScannedImages(response, true, false); // returns an array of ScannedImage
            for(var i = 0; (scannedImages instanceof Array) && i < scannedImages.length; i++) {
                var scannedImage = scannedImages[i];
                processScannedImage(scannedImage);
            }
        }

        /** Images scanned so far. */
        var imagesScanned = [];

        /** Processes a ScannedImage */
        function processScannedImage(scannedImage) {
            imagesScanned.push(scannedImage);
            var elementImg = scanner.createDomElementFromModel( {
                'name': 'img',
                'attributes': {
                    'class': 'scanned',
                    'src': scannedImage.src
                }
            });
            document.getElementById('images').appendChild(elementImg);
        }

        <!-- Previous lines are same as demo-01, below is new addition to demo-02 -->

        /** Upload scanned images by submitting the form */
        function submitFormWithScannedImages() {
            if (scanner.submitFormWithImages('form1', imagesScanned, function (xhr) {
                if (xhr.readyState == 4) { // 4: request finished and response is ready
                    document.getElementById('server_response').innerHTML = "<h2>Response from the server: </h2>" + xhr.responseText;
                    document.getElementById('images').innerHTML = ''; // clear images
                    imagesScanned = [];
                }
            })) {
                document.getElementById('server_response').innerHTML = "Submitting, please stand by ...";
            } else {
                document.getElementById('server_response').innerHTML = "Form submission cancelled. Please scan first.";
            }
        }

    </script>

@endsection
@section('content')
<?php 
use App\Setting;
?>

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header">
                                        <h1 class="m-0 text-white">
                                        Nouveau Membre:
                                        </h1>
                                        <div class="col-sm-4"></div>
                                    </div>
                                    <div class="card-body table1">
                                        <form role="form" action="{{route('membre.store')}}" method="post" enctype="multipart/form-data">
                                        <input id="mydata" type="hidden" name="mydata" value=""/>

                                        @csrf

                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <h1 class="m-0 text-white">Informations Personnels  :</h1>

                                                    <div class="form-group text-center">
                                                        <img id="blah" src=""  width="150px" alt="" />
                                                        <br>   <br>
                                                        <div id="my_camera" ></div>

                                                        <div id="results"></div>
                                                        <div class="browse-button">
                                                            <i class="fa fa-pencil-alt"></i>
                                                            <input type='file' id="imgInp" name="photoMembre" onchange="readURL(this);" />

                                                            <input type=button value="Prendre Photo" onClick="take_snapshot()">
                                                            <button type="button" onclick="scanToJpg();">Scan</button>
                                                            <div id="images"></div>

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Remarque:</label>
                                                        <input name="remarque" class="form-control" value="">


                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Code de Matricule:</label>
                                                        <input type="text" required value="{{old('matricule')}}" name="matricule" class="form-control">

                                                    </div>



                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Documents:</label>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault">
                                                            <label class="form-check-label" style="font-size:30px;" for="flexCheckDefault">
                                                                Dossier médical
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" >
                                                            <label class="form-check-label" style="font-size:30px;" for="flexCheckChecked">
                                                                Photocopie de la carte nationnal
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input name="assurance" class="form-check-input" type="checkbox" value="1" id="assurance" >
                                                            <label class="form-check-label" style="font-size:30px;" for="assurance" >
                                                                Assurance 
                                                            </label>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Type : </label><br>
                                                        <select class="customselect" class="" name="sexe">
                                                            <option value="homme">Homme</option>
                                                            <option value="femme">femme</option>

                                                        </select>

                                                    </div>



                                                    
                                                    <div class="form-group">
                                                        <label class="cedate-0 text-white" style="font-size:30px;">Date de Naissance :</label>
                                                        <input type="date" value="naissance" name="naissance" class="form-control">
                                                    </div>

                                                    
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Numéro de la carte Nationale :</label>
                                                        <input type="text" value="{{old('identite')}}" name="identite" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">nom:</label>
                                                        <input type="text" required value="{{old('nom')}}" name="nom" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Prénom:</label>
                                                        <input type="text" required value="{{old('prenom')}}" name="prenom" class="form-control">
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Adresse</label>
                                                        <input type="text" value="{{old('adresse')}}" name="adresse" class="form-control">
                                                    </div> -->

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Téléphone</label>
                                                        <input type="text" value="{{old('telephone')}}" name="telephone" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Groupe Sanguin</label><br>
                                                        <select class="customselect" class="" name="sang">
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

                                                <div class ="col-sm-5 offset-md-2">
                                                    <h1 class="m-0 text-white">Informations inscriptions :</h1>
                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Genre :</label>
                                                        <select class="" name="sexe">
                                                            <option value="femme">Femme</option>						 
                                                            <option value="homme">Homme</option>	
                                                            <option value="mixte">mixte</option>						                                                             
                                                        </select>
                                                    </div> -->
                                                
                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Nombre de mois:</label>
                                                        <input type="number"  value="{{old('nbrmois') ?? 1}}" min="1"  id="nbrmois" name="nbrmois" class="form-control">
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Coach:</label><br>
                                                        <select class="customselect" id="coach" name="coach">
                                                            <option value="" >Séléctionner un Coach:</option>
                                                                @foreach($coachs as $coach)
                                                                    <option value="{{$coach->id}}">{{$coach->name}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div> -->
                                                    


                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Abonnement:</label><br>
                                                        <select class="customselect" id="abonnement" name="abonnement">
                                                            <option value="" >Séléctionner un Abonnement:</option>
                                                                @foreach($abonnements as $abonnement)
                                                                    <option  value="{{$abonnement}}">{{$abonnement->label}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Date début:</label>
                                                        <input type="date" id="debut"  value="{{Date('Y-m-d')}}" name="debut" class="form-control">
                                                    </div>

                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Date Fin</label>
                                                        <input type="date" id="fin"  value="" name="fin" class="form-control">
                                                    </div> -->
                                                    

                                                    <!-- <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Remarque</label>
                                                        <input id="remarque" type="text" value="{{old('remarque')}}" name="remarque" class="form-control">
                                                    </div> -->



                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Tarification:</label>
                                                        <input type="number"  onkeydown="return false;" name="tarif"  value="0" id="tarif" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Remise:</label>
                                                        <input type="number" value="{{old('remise') ?? 0}}" id="remise" name="remise" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Total Final : </label>
                                                        <input type="number" value="{{old('ttc') ?? 0}}" onkeydown="return false;" id="total" name="total" class="form-control">
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Versement:</label>
                                                        <input type="number"  value="{{old('versement') ?? 0}}" id="versement" name="versement" class="form-control">
                                                    </div>

                                                    

                                                    <div class="form-group">
                                                        <label class="m-0 text-white" style="font-size:30px;">Reste:</label>
                                                        <input type="number"  value="{{old('reste') ?? 0}}" onkeydown="return false;" id="reste" name="reste" class="form-control">
                                                    </div>


                                                </div>


                                            </div>

                                            <div class="row">
                                                <div class="col-md-2 offset-md-4" style="padding:30px;">
                                                    <button style="padding:30px;font-size:30px;" type="submit" id="valider" class="btn bubbly-button btn-sm">Valider</button>
                                                </div>
                                                <div class="col-md-2" style="padding:30px;">
                                                    <a style="padding:30px;font-size:30px;" 
                                                    onclick="window.history.go(-1); return false;"
                                                     class="btn bubbly-button btn-sm">Annuler</a>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
@endsection
@section('scripts')
<script src="{{asset('js/webcam.min.js')}}"></script>

<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log(e.target.result)
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

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




    
$(window).keydown(function(event){
    if(event.keyCode == 13) {
        if($('#input_id').val().length >0){
          let number = parseInt($('#input_id').val(), 10);
          let matricules = {!! json_encode(Config::get('matricules')) !!};
          //console.log(matricules);
          var res = false;
          matricules.map(function (matricule) {
              res = res || matricule.matricule == number;
          });          
          console.log(res)
          if(res==false){
            toastr.error('Carte Non valide')
            $('#input_id').val("")
          }else{
            window.location.href = 'http://localhost:8000/membre/edit/'+number;
          }
      }else{
        event.preventDefault();
        return false;
      }
    }
  });


    $('.basic-single').select2();
    @if(Setting::getSetting('camera')==1)
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach( '#my_camera'  );
    @endif

    
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
    $('#versement').on('keyup',function(event){
        var total =  $('#total').val()
        var versement =  $('#versement').val()
        var reste = total - versement
        $('#reste').val(reste)

    })


    $('#abonnement').on('change',function(event){
        var value = JSON.parse(this.value);
        var remise = $('#remise').val();
        console.log(ttc)
        $('#tarif').val(value.tarif)
        $('#total').val($('#nbrmois').val()*$('#tarif').val())
        $('#versement').val($('#nbrmois').val()*$('#tarif').val())
        $('#remise').val(0)


    
        var total =  $('#total').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc').val(ttc)


        var total =  $('#total').val()
        var versement =  $('#versement').val()
        var reste = total - versement
        $('#reste').val(reste)
        $('#versement').attr('max',total)



    })
    $('#remise').on('keyup',function(){
        var nbrmois = $('#nbrmois').val();
        var remise = this.value;
        var total =  $('#tarif').val()*nbrmois
        var ttc = total - remise 
        $('#total').val(ttc)
        $('#versement').val(ttc)
        $('#versement').attr('max',ttc)
        $('#reste').val(0)


    })

    $('#nbrmois').on('change',function(event){
    
        var value = this.value;
        var debut = new Date($('#debut').val());
        var fin  = debut.setMonth(debut.getMonth()+value); 
        var remise = $('#remise').val();
        $('#total').val(value*$('#tarif').val())
        $('#versement').val(value*$('#tarif').val())
        $('#remise').val(0)
        $('#reste').val(0)
        $('#versement').attr('max',value*$('#tarif').val())


        var total =  $('#total').val()
        console.log(ttc)
        var ttc = total - remise 
        $('#ttc').val(ttc)

    })

});

</script>
@endsection


