@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des commandes  </h1>
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
                                        <div class="col-lg-4 col-12">
                                            <div class="small-box bg-info">
                                              <div class="inner">
                                                <?php $Total =0; ?>
                                                @foreach($commandes as $commande)
                                                    <?php $Total =$Total+$commande->net(); ?>
                                                @endforeach
                                                <h3>Total net : {{$Total}} DA </h3>
                                                <p>
                                                </p>
                                              </div>
                                              <div class="icon">
                                                <i class="ion ion-bag"></i>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="small-box bg-info">
                                              <div class="inner">
                                                <?php $Total =0; ?>
                                                  @foreach($commandes as $commande)
                                                      <?php $Total =$Total+$commande->montant(); ?>
                                                  @endforeach
                                                <h3>Total commande : {{$Total}} DA </h3>
                                                <p>
                                                </p>
                                              </div>
                                              <div class="icon">
                                                <i class="ion ion-bag"></i>
                                              </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <form method="post" action="{{route('commande.filter')}}">                                                    
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
                                                        <label class="m-0 text-white" style="">Caissier:</label><br>
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
                                                          <i class="fa fa-filter"></i>
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
                                                <th>Caissier</th>
                                                <th>Montant</th>
                                                <th>Remise</th>
                                                
                                                <th>net</th>
                                          
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-white">
                                            @foreach($commandes as $commande)
                                            <tr>
                                                <td>
                                                    {{$commande->id ?? ''}}
                                                </td>
                                                <td>{{$commande->membre()['nom'] ?? ''}}</td>

                                                <td>
                                                    {{$commande->user()['name'] ?? ''}}
                                                </td>
                                                <td>{{$commande->montant() ?? ''}} DA</td>
                                                <td>{{$commande->remise ?? '0'}} DA</td>
                                                <td>{{$commande->net()-$commande->remise ?? ''}} DA</td>

                                                
                                                <td>
                                                  @if(Auth::user()->isadmin == 1)
                                                    <a href="{{route('commande.destroy',['commande'=>$commande->id])}}"
                                                            onclick="return confirm('Etes vous sure?')"
                                                      class="btn btn-danger">
                                                        <i class="fa fa-trash"></i> Supprimer
                                                    </a>

                                                  @endif

                                                  <a href="{{route('commande.print',['commande'=>$commande->id])}}"
                                                      class="btn btn-success">
                                                        <i class="fa fa-print"></i> Bon De Commande
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