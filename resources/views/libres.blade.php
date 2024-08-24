@extends('layouts.master')

@section('content')
<div class="container-fluid">

    <div class="card-header">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">

                        <h3>{{$benefice ?? ''}} DA</h3>
                        <p>
                            Bénéfice Total
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{count($libres) }}</h3>
                        <p>
                            Séances Libre
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="card mb-4">
    <div class="card-group">
        <h1 style="padding:10px;">
            Filtrer
        </h1>
    </div>
    <form method="post" action="{{route('libre.filter')}}">                                                    
        @csrf
        <div class="row">
            <div class="col-md-3" >
                <label class="control-label">{{ __('Début') }}: </label>
                <input class="form-control" value="{{$date_debut ?? ''}}" name="date_debut" type="date" />
            </div>

            <div class="col-md-3" >
                <label class="control-label">{{ __('Fin') }}: </label>
                <input class="form-control" value="{{$date_fin ?? ''}}" name="date_fin" type="date" />
            </div>

            <div class="col-md-3" style="padding:35px;">
                <button type="submit" class="row btn btn-primary" >
                    Filtrer
                </button>                                                                                                        
            </div>
    </form>

    <div class="table-responsive">
        <table id="example1" class="table table-striped table-bordered no-wrap">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nom Prénom</th>
                    <th>Téléphone</th>
                    <th>Prix</th>
                    <th>Date & Heure</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                @foreach($libres as $libre)

                <tr>
                    <td>{{$libre->id ?? 'libre'}}</td>
                    <td>{{$libre->nom_prenom ?? '//'}} </td>
                    <td>{{$libre->telephone ?? '//'}} </td>
                    <td>{{$libre->prix ?? ''}} DA </td>
                    <td>{{$libre->created_at ?? ''}}</td>
                    <td class="display-4">
                                                        <a class="btn bubbly-button" href="{{route('presence.destroy',['presence'=>$libre->id])}}" 
                                                        onclick="return confirm('Etes vous sur?')"
                                                        >
                                                        Supprimer
                                                                <i class="fa fa-trash"></i>
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
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/chart.js')}}"></script>
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