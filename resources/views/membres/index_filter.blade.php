@extends('layouts.master')
@section('styles')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('header')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-4">
                <a href="{{route('membre.create')}}" class="btn bubbly-button btn-lg"><i class="fa fa-plus"></i>
                    {{trans('main.ajouter')}}</a>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <h1 class="m-0 text-white">{{trans('main.Nombre Total')}} : {{$total}}<h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection
@section('content')
<div class="card ">
    <div class="card-body table1">
        <div class="row text-right">
            <div class="col-md-3">
            </div>
        </div>
        <br>


        <div class="row">
                                    <div class="col-md-12">
                                        <form method="post" action="{{route('membre.filter')}}">                                                    
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" style="font-size:30px;">{{trans('main.Abonnement')}}:</label><br>
                                                        <select class="customselect" id="abonnement" name="abonnement">
                                                            <option value="" >{{trans('main.Séléctionner un Abonnement')}}:</option>
                                                                @foreach($abonnements as $abonnement)
                                                                    <option 
                                                                    @if($_abonnement==$abonnement->id) selected @endif
                                                                    value="{{$abonnement->id}}">{{$abonnement->label}}</option>
                                                                @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- <div class="col-md-3" >
                                                        <label class="m-0 text-white" style="font-size:30px;">Coach:</label><br>
                                                        <select class="customselect" id="coach" name="coach">
                                                            <option value="" >Séléctionner un Coach:</option>
                                                                @foreach($coachs as $coach)
                                                                    <option
                                                                     @if($_coach==$coach->id) selected @endif
                                                                     value="{{$coach->id}}">{{$coach->name}}</option>
                                                                @endforeach
                                                        </select>

                                                    </div> -->

                                                
                                                    <div class="col-md-4" style="padding: 20px;" >
                                                        <button type="submit" class="row btn bubbly-button" >
                                                            Filtrer
                                                        </button>                                                                                                        
                                                    </div>


                                                </form>
                                    </div>
        </div>


        <div class="table-responsive">
            <table id="example1" class="table table-striped table-bordered no-wrap">
                <thead>
                    <tr>
                        <th>{{trans('main.Matricule')}}</th>
                        <th>{{trans('main.nom')}} {{trans('main.Prénom')}}</th>
                        <th>téléphone </th>
                        <th>Abonnement</th>
                        <th>{{trans('main.Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($membres as $membre)
                    @if($membre->getAbonnement()['id'] == $_abonnement)
                        <tr>
                            <th>{{$membre->matricule }}</th>
                            <th>{{$membre->nom ?? ''}} {{$membre->prenom ?? ''}}</th>
                            <th>{{$membre->telephone ?? ''}}</th>
                            <th>
                                <span class="badge badge-success">
                                    {{$membre->getAbonnement()['label'] ?? '' }}
                                </span>
                            </th>

                            <th>
                                <a class="btn bubbly-button text-white"
                                    href="{{route('membre.edit',['membre'=>$membre->matricule])}}">Modifier <i class="fa fa-edit"></i></a>
                                <!-- <a href="{{route('membre.destroy',['membre'=>$membre->matricule])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a> -->
                                <a class="btn bubbly-button text-white" onclick="return confirm('Etes vous sure ?')"
                                    href="{{route('membre.destroy',['membre'=>$membre->matricule])}}"><i
                                        class="fa fa-trash"></i> Supprimer</a>
                                <a class="btn bubbly-button text-white"
                                    href="{{route('membre.membre',['membre'=>$membre->matricule])}}">
                                    Profile
                                </a>
                            </th>
                        </tr>

                    @endif

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
<script src="{{asset('adminlte/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


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