@extends('layouts.master')
@section('header')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-white"> Liste des Charges : </h1>
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

@section('header')

@endsection

@section('content')



<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-4">

                <button type="button" class="btn  bubbly-button" data-toggle="modal" data-target="#exampleModal">
                    Ajouter
                    <i class="fas fa-plus"></i>
                </button>

            </div><!-- /.col -->
            <div class="col-sm-6">
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="card">
    <div class="card-body table1">



        <div class="table-responsive">
            <table id="example1" class="table table-striped table-bordered no-wrap">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Date Décharge</th>
                        <th>Designation</th>
                        <th>Montant</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($decharges as $key=>$decharge)
                        <tr>
                            <?php $index = $key+1; ?>
                            <td class="display-4">{{$index ?? '' }}</td>
                            <td class="display-4">
                                {{ Carbon\Carbon::parse($decharge->date_decharge)->format('Y-m-d') }}
                            </td>
                            <td class="display-4">{{$decharge->designation ?? '' }}</td>
                            <td class="display-4">{{$decharge->montant ?? '' }} DA</td>
                            <td class="display-4">
                            <a href="{{route('decharge.destroy',['id_decharge'=>$decharge->id])}}"
                                        onclick="return confirm('etes vous sure  ?')" class="text-white btn btn-danger">
                                            Supprimer
                                        <i class="fas fa-trash"></i>

                                    </a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>
</div>






@section('modals')

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content model1">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une décharge</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('decharge.create')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" class="form-control" 
                                                            name="facture"
                                                            value="{{$facture->id ?? ''}}" >

                                                        <div class="form-group">
                                                            <label class="form-label">Montant :  </label>
                                                            <input type="number" class="form-control" 
                                                            name="montant"
                                                            placeholder="Montant e.g : 230.000,00 DA" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Date de décharge :  </label>
                                                            <input type="date" class="form-control" 
                                                            name="date_decharge"
                                                            value="{{date('Y-m-d')}}"
                                                            placeholder="" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="form-label">Désignation:  </label>
                                                            <input type="text" class="form-control" 
                                                            name="designation"
                                                            placeholder="" >
                                                        </div>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                        <button type="submit" class="btn btn-primary">Sauvegarder</button>

                                                    </form>

                                                </div>
                                                </div>
                                            </div>
                                        </div>


@endsection

@endsection

@section('scripts')
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>


<script>
    $(document).ready(function () {

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "order": [
                [0, "desc"]
            ],
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