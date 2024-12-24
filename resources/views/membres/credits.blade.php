@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
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
                                    <!-- Entrer Count Card -->
                                    <div class="col-md-6 col-12">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3>Nombre total</h3>
                                                <h3 id="totalEntrer">{{ count($membres) ?? 0 }}</h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-log-in"></i>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Sortie Count Card -->
                                    <div class="col-md-6 col-12">
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3>Total Crédit</h3>
                                                <h3 id="totalSortie">{{$total ?? ''}} DA</h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-log-out"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4">
                                        <a href="{{route('exportCredits')}}" class="btn btn-success btn-lg"><i class="fa fa-download"></i> Excel</a>
                                    </div><!-- /.col -->
                                </div>

                                
                                <div class="table-responsive">
                                    <table id="example1"  class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th style="font-size:27px;">{{trans('main.id')}}</th>
                                                <th style="font-size:27px;">{{trans('main.Matricule')}}</th>
                                                <th style="font-size:27px;">{{trans('main.nom')}}</th>
                                                <th style="font-size:27px;">{{trans('main.Prénom')}}</th>
                                                <th style="font-size:27px;">{{trans('main.Téléphone')}}</th>                                                
                                                <th style="font-size:27px;">Crédit</th>                                                
                                                <th style="font-size:27px;">{{trans('main.Action')}}</th>                                                
                                            </tr>

                                        </thead>
                                        <tbody class="">

                                            <?php 
                                                $total = 0;

                                            ?>
                                            
                                            @foreach($membres as $membre)
                                            <?php 
                                                $total = $total+$membre->credit();                                                
                                            ?>

                                                <tr >
                                                    <td>{{$membre->id ?? ''}}</td>
                                                    <td>{{$membre->matricule ?? ''}}</td>
                                                    <td>{{$membre->nom ?? ''}}</td>
                                                    <td>{{$membre->prenom ?? ''}}</td>
                                                    <td>{{$membre->telephone ?? '#'}}</td>
                                                    <td>{{$membre->credit() ?? ''}} DA </td>
                                                    <td>
                                                        <a href="/gym/membre/membre/{{$membre->matricule ?? ''}}" class="btn bubbly-button text-white">{{trans("main.Profile")}} </a>
                                                        <a href="/gym/membre/edit/{{$membre->matricule ?? ''}}" class="btn btn-primary text-white">Principal <i class="fa fa-edit"></i></a>
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
            language: {
                search: "Recherche "
            }

          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            language: {
                search: "Recherche :"

            },

            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });



        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        
        $('.state').on('change',function(e){
            var id = this.id
            console.log(id)

            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/membre/state/'+id,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data)
                    toastr.success('état changé');
                },
                error: function(err) { 
                    console.log(err)
                    toastr.error(err)
                }
            });
        })
});

</script>
@endsection
