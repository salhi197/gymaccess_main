@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des Versements  </h1>
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
                                        <form method="post" action="{{route('versement.filter')}}">                                                    
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4" >
                                                        <label class="control-label">{{ trans('main.debut') }}: </label>
                                                        <input class="form-control" value="{{$date_debut ?? ''}}" name="date_debut" type="date" />
                                                    </div>

                                                    <div class="col-md-4" >
                                                        <label class="control-label">{{ trans('main.fin') }}: </label>
                                                        <input class="form-control" value="{{$date_fin ?? ''}}" name="date_fin" type="date" />
                                                    </div>
                                                    <div class="col-md-4" >
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
                                            <tr>
                                                <th>Id</th>
                                                <th>Membre</th>
                                                <th>Montant</th>
                                                <th>Inscription</th>
                                                <th>Agent </th>                                                
                                                <th>Date Versement</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-white">
                                            @foreach($versements as $versement)
                                            <tr>
                                                <td>
                                                    {{$versement->id ?? ''}}
                                                </td>
                                                <td>
                                                    {{$versement->getMembre()['prenom'] ?? ''}}
                                                    {{$versement->getMembre()['nom'] ?? ''}}
                                                </td>
                                                <td>{{$versement->montant ?? ''}} DA</td>
                                                <td>{{$versement->getAbonnement()['label'] ?? ''}}</td>
                                                <td>{{$versement->getUser()['name'] ?? ''}}</td>
                                                <td>{{$versement->date_versement ?? ''}}</td>
                                                <td>
                                                    <a href="{{route('versement.print',['versement'=>$versement->id])}}"  class="btn btn-success">
                                                        Imprimer
                                                    </a>

                                                    <a href="{{route('versement.destroy',['versement'=>$versement->id])}}"  class="btn btn-danger"
                                                    onclick="return confirm('etes vous sure  ?')"
                                                        >
                                                        <i class="fa fa-trash"> </i> Supprimer
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