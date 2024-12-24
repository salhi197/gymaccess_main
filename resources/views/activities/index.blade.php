@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Liste de Activités </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')
                    <div class="card">
                            <div class="card-body table1">
                                <h4 class="card-title">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fa fa-plus"></i> Ajouter Activité
                                    </button>

                                </h4>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ajouter abonnement</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                                <form id="abonnementFform" action="{{route('activitie.create')}}" method="post" enctype="multipart/form-data">
                                                @csrf

                                                <div class="form-group">
                                                    <label>Actvité: </label>
                                                    <select class="form-control" name="activity">
                                                       
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Type: </label>

                                                        <div class="form-check">
                                                            <input class="form-check-input" value="femme" type="radio" name="type" id="type2" checked>
                                                            <label class="form-check-label" for="type2">
                                                                Femme
                                                            </label>
                                                        </div>
                                                    </div>


                                                    
                                                    <button class="btn btn-primary btn-block" type="submit" id="ajax_abonnement">ajouter l'abonnement</button>
                                                </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="table-responsive">
                                    <table id="zero_config" id="DataTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom</th>
                                                <th>Tarifs</th>
                                                <th>Planing</th>                                                
                                                <th>actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($activities as $activitie)
                                            <tr>
                                                <td>{{$activitie->id ?? ''}}</td>
                                                <td>
                                                    <span class="btn btn-info">
                                                        {{$activitie->type ?? ''}}                                                    
                                                    </span>                                                
                                                </td>
                                                <td>{{$activitie->jour ?? ''}}</td>

                                                
                                                <td>
                                                    <span class="badge badge-primary">
                                                        {{$activitie->debut ?? ''}}
                                                            -
                                                        {{$activitie->fin ?? ''}}            
                                                    </span>
                                             
                                                    
                                                </td>
                                                <td>
                                                <a class="btn btn-danger text-white"  onclick="return confirm('Are you sure?')"  href="{{route('activitie.destroy',['activitie'=>$activitie->id])}}">Supprimer</a>
                                                <a class="btn btn-info text-white"  href="{{route('activitie.edit',['activitie'=>$activitie->id])}}">Edit</a>
                                                </td>
                                            </tr>
                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter activitie</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="{{route('activitie.store')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="hidden" value="{{$membre->id ?? ''}}" name="membre" />
                                                <div class="form-group">
                                                    <label>Abonnement</label>
                                                    <select class="form-control" id="abonnement" name="abonnement">
                                                        <option value="">séléctionner un abonnement</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Date début</label>
                                                    <input type="date" id="debut"  value="{{Date('Y-m-d')}}" name="debut" class="form-control">
                                                </div>

                                            </div>

                                            <div class ="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tarification:</label>
                                                    <input type="number"  name="tarif" value="0" id="tarif" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>date fin</label>
                                                    <input id="fin" type="date" value="{{old('fin')}}" name="fin" class="form-control">
                                                </div>
                                            </div>

                                            <div class ="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nombre de mois</label>
                                                    <input type="number"  value="{{old('nbrmois') ?? 1}}" min="1" id="nbrmois" name="nbrmois" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Total</label>
                                                    <input type="number" id="total" value="{{old('total')}}" name="total" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Remise</label>
                                                    <input type="number" value="{{old('remise') ?? 0}}" id="remise" name="remise" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Versement</label>
                                                    <input type="number" value="{{old('versement') ?? 0}}" id="versement" name="versement" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>T.T.C : </label>
                                                    <input type="number" value="{{old('ttc') ?? 0}}" id="ttc" name="ttc" class="form-control">
                                                </div>
                                                

                                            </div>

                                        </div>


                                    <div class="col-sm-12">
                                        <button type="submit" id="valider"  class="btn btn-info btn-block">Valider</button>
                                    </div>


                                    </form>
                                </div>
                            </div>
                </div>
                </div>

@endsection

@section('scripts')
<script>

$(document).ready(function() {
    $('#abonnement').on('change',function(event){
        var value = JSON.parse(this.value);
        $('#tarif').val(value.tarif)
        $('#total').val($('#nbrmois').val()*$('#tarif').val())
        $('#versement').val($('#nbrmois').val()*$('#tarif').val())

    })
    $('#nbrmois').on('change',function(event){
        var value = this.value;
        var debut = new Date($('#debut').val());
        var fin  = debut.setMonth(debut.getMonth()+value); 
        $('#total').val(value*$('#tarif').val())
        $('#versement').val(value*$('#tarif').val())
        $('#fin').val(fin)
    })

});

</script>
@endsection