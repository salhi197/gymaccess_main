@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des Membre Actifs , Total {{count($membres)}}  </h1>
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

                                    </div>
                                
                                <div class="table-responsive">
                                    <table id="example1"  class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>{{trans('main.id')}}</th>
                                                <th>{{trans('main.Matricule')}}</th>
                                                <th>{{trans('main.nom')}}</th>
                                                <th>{{trans('main.Prénom')}}</th>
                                                <th>{{trans('main.Téléphone')}}</th>                                                
                                                <th>{{trans('main.Action')}}</th>                                                
                                            </tr>

                                        </thead>
                                        <tbody class="">
                                            @foreach($membres as $membre)
                                                <tr >
                                                    <td>{{$membre->id ?? ''}}</td>
                                                    <td>{{$membre->matricule ?? ''}}</td>
                                                    <td>{{$membre->nom ?? ''}}</td>
                                                    <td>{{$membre->prenom ?? ''}}</td>
                                                    <td>{{$membre->telephone ?? ''}}</td>
                                                    <td>
                                                        <a href="/membre/membre/{{$membre->matricule ?? ''}}" class="btn bubbly-button text-white">{{trans("main.Profile")}} </a>
                                                        <a href="/membre/edit/{{$membre->matricule ?? ''}}" class="btn bubbly-button text-white">{{trans("main.Modifier")}} <i class="fa fa-edit"></i></a>
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