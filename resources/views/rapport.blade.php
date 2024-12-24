@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des Inscriptions :  </h1>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection
@section('styles')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
                    <div class="card">
                            <div class="card-body table1">
                                    <div class="row">
                                    <form method="post" action="{{route('rapport.filter')}}">                                                    
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-3" >
                                                        <label class="control-label">{{ trans('main.debut') }}: </label>
                                                        <input class="form-control" value="{{$date_debut ?? ''}}" name="date_debut" type="date" />
                                                    </div>

                                                    <div class="col-md-3" >
                                                        <label class="control-label">{{ trans('main.fin') }}: </label>
                                                        <input class="form-control" value="{{$date_fin ?? ''}}" name="date_fin" type="date" />
                                                    </div>
                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" >{{trans('main.Abonnement')}}:</label><br>
                                                        <select class="customselect" id="abonnement" name="abonnement">
                                                            <option value="" >{{trans('main.Séléctionner un Abonnement')}}:</option>
                                                                @foreach($abonnements as $abonnement)
                                                                    <option
                                                                        @if($_abonnement==$abonnement->id) selected @endif
                                                                     value="{{$abonnement->id}}">{{$abonnement->label}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" >Caissier:</label><br>
                                                        <select class="customselect" id="user" name="user">
                                                            <option value="" >Séléctionner un user:</option>
                                                                @foreach($users as $user)
                                                                    <option
                                                                        @if($_user==$user->id) selected @endif
                                                                     value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                        </select>

                                                    </div>

                                                    <div class="col-md-2" style="padding:16px">
                                                        <button type="submit" class="row btn bubbly-button" >
                                                            {{ trans('main.Filtrer') }}
                                                        </button>                                                                                                        
                                                    </div>


                                        </form>

                                    </div>
                                
                                <div class="table-responsive">
                                    <table id="example1"  class="table table-striped table-bordered no-wrap">
                                    <thead>
                                            <tr class="text-white">
                                                <th>Date Inscription</th>
                                                <th>Membre</th>
                                                <th>debut</th>
                                                <th>fin</th>
                                                <th>Reste  </th>
                                                <th>Séances</th>
                                                <th>abonnement</th>
                                                <th>etat</th>
                                                <th>total</th>
                                                <th>remise</th>
                                                <th>nbrmois</th>
                                                <th>versement</th>
                                                <th>actions</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($inscriptions as $inscription)
                                            <tr 
                                            class="
                                            @if($inscription->etat == 1)
                                            td-success
                                            @else
                                            td-error
                                            @endif"
                                            >

                                                <td>
                                                    {{$inscription->created_at ?? ''}}
                                                </td>
                                                <td>
                                                    {{$inscription->getMembre()['nom'] ?? ''}}
                                                    {{$inscription->getMembre()['prenom'] ?? ''}}
                                                </td>
                                                <td>{{$inscription->debut ?? ''}}</td>
                                                <td>{{$inscription->fin ?? ''}}</td>
                                                <td>{{$inscription->reste ?? ''}}</td>
                                                <td style="text-align:center;">{{$inscription->nbsseance ?? ''}}</td>
                                                <td>{{$inscription->getAbonnement() ?? ''}}</td>
                                                <td>
                                                    <span class="badge badge-info"> 

                                                    @if($inscription->etat == 1)
                                                        Active
                                                    @else
                                                        Expirer
                                                    @endif

                                                    </span>
                                                </td>
                                                <td>{{$inscription->total ?? ''}}DA</td>
                                                <td>{{$inscription->remise ?? ''}}</td>

                                                <td style="text-align:center;">
                                                    {{$inscription->nbrmois ?? ''}}
                                                </td>                                            
                                                <td>{{$inscription->versement ?? ''}} DA</td>

                                                <td>
                                                    <a class="btn bubbly-button text-white" href="{{route('inscription.presence',['inscription'=>$inscription->id])}}">
                                                        <i class="fa fa-list"></i>
                                                        Présences
                                                    </a>

                                                    

                                                </td>
                                            </tr>
                                            @endforeach                                            
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>




@endsection

@section('scripts')
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>


<script>
$(document).ready(function() {

          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "order": [[ 0, "desc" ]],
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });



        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        
});

</script>
@endsection