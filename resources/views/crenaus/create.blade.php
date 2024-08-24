@extends('layouts.master')


@section('styles')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<link href="{{asset('css/timepicker.css')}}" rel="stylesheet" />

@endsection
@section('content')

                <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Crénaux : </h3></div>
                                    <div class="card-body">
                                        <form role="form" action="{{route('crenau.store')}}" method="post">
                                        @csrf
                                            <div class="row">
                                            
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Type: </label>
                                                        <select class="form-control" name="type">
                                                            <option value="circuit-tarining">
                                                                circuit-tarining
                                                            </option>
                                                            <option value="fitness">
                                                                fitness
                                                            </option>
                                                            <option value="Rf-cardio">
                                                                Rf-cardio
                                                            </option>
                                                            <option value="zumba">
                                                                zumba
                                                            </option>
                                                            <option value="crossfit">
                                                                crossfit
                                                            </option>
                                                            <option value="zumba strong">
                                                                zumba strong
                                                            </option>
                                                            <option value="vovinam">
                                                                vovinam
                                                            </option>
                                                            <option value="ventre-plat">
                                                                ventre-plat
                                                            </option>
                                                            <option value="Yoga">
                                                                Yoga
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class ="col-sm-3">
                                                    <div class="form-group">
                                                        <label>
                                                            Jour : 
                                                        </label>
                                                        <select class="form-control" name="jour">
                                                            <option value="">Séléctionner un Jour</option>						 
                                                            <option value="samedi">Samedi</option>						 
                                                            <option value="dimanche">dimanche</option>						                                                             
                                                            <option value="lundi">lundi</option>						                                                             
                                                            <option value="mardi">mardi</option>						                                                             
                                                            <option value="mercredi">mercredi</option>						                                                             
                                                            <option value="jeudi">jeudi</option>                                                             
                                                            <option value="vendredi">vendredi</option>						                                                             
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>



                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="font-weight-light my-4"> 
                                            Plage Horraire  
                                        </h3>
                                    </div>
                                        <div class="card-body">
                                                <div class="form-group" >
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input  type="text" autocomplete="off" name="debut" id="debut" placeholder="Heure Début" class="form-control  debuts bs-timepicker">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input autocomplete="off" class="form-control  fins bs-timepicker" type="text" name="fin" id="fin" placeholder="Heure Fin " >
                                                        </div>

                                                        <!-- <div class="button-group">
                                                            <a href="javascript:void(0)" class="btn btn-primary" id="plus5"><i class="fa fa-plus"></i></a>
                                                            <a href="javascript:void(0)" class="btn btn-danger" id="minus5"><i class="fa fa-minus"></i></a>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <button type="submit" id="valider"  class="btn btn-info btn-block">Valider</button>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="reset" class="btn btn-danger btn-block">Annuler</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>



                            </div>

                        </div>

                    </div>
@endsection

@section('scripts')
<script src="{{asset('js/dynamic-form.js')}}"></script>
<script src="{{asset('js/timepicker.js')}}"></script>
<script src="{{asset('js/jquery.timepicker.min.js')}}"></script>


<script>
$(document).ready(function() {
        

    $('.bs-timepicker').timepicker();

    $('.timepicker').timepicker({
        timeFormat: 'h:mm p',
        interval: 30,
        minTime: '6',
        maxTime: '6:00pm',
        defaultTime: '11',
        startTime: '5:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

            

    var dynamic_form =  $("#dynamic_form").dynamicForm("#dynamic_form","#plus5", "#minus5", {
        limit:10,
        formPrefix : "dynamic_form",
        normalizeFullForm : false
    });

//    dynamic_form.inject([{p_name: 'Hemant',quantity: '123',remarks: 'testing remark'},{p_name: 'Harshal',quantity: '123',remarks: 'testing remark'}]);

    $("#dynamic_form #minus5").on('click', function(){
        var initDynamicId = $(this).closest('#dynamic_form').parent().find("[id^='dynamic_form']").length;
        if (initDynamicId === 2) {
            $(this).closest('#dynamic_form').next().find('#minus5').hide();
        }
        $(this).closest('#dynamic_form').remove();
    });

    $('form').on('submit', function(event){
        var values = {};
        $.each($('form').serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        // console.log(values)
        // event.preventDefault();
    })    
})


</script>
@endsection



