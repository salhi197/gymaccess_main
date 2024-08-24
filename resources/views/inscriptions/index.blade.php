@extends('layouts.master')
@section('styles')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
                                <div class="card ">
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" >Age Min:</label><br>
                                                        <input class="form-control" value="{{$agemin ?? ''}}" name="agemin" type="number" />
                                                    </div>

                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" >Age Max:</label><br>
                                                        <input class="form-control" value="{{$agemax ?? ''}}" name="agemax" type="number" />
                                                    </div>

                                                    <div class="col-md-2" style="padding:16px">
                                                        <button type="submit" class="row btn bubbly-button" >
                                                            {{ trans('main.Filtrer') }}
                                                        </button>                                                                                                        
                                                    </div>
                                                </div>
                                            </form>
                                        

                                
                                

                                        <div class="table-responsive">
                                            <table id="InscriptionsTable" class="table table-striped table-bordered no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>{{trans('main.debut')}}</th>
                                                        <th>{{trans('main.fin')}}</th>
                                                        <th>{{trans('main.Nombre seance reste')}} </th>
                                                        <th>Nbr Seances </th>
                                                        <th>Abonnement</th>
                                                        <th>Membre</th>
                                                        <th>{{trans('main.etat')}}</th>
                                                        <th>{{trans('main.total')}}</th>
                                                        <th>{{trans('main.remise')}}</th>
                                                        <th>{{trans('main.nbrmois')}}</th>
                                                        <th>{{trans('main.versement')}}</th>
                                                        <th>{{trans('main.actions')}}</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
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
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('js/pdfmake.min.js')}}"></script>
<script src="{{asset('js/vfs_fonts.js')}}"></script>
<script src="{{asset('js/jszip.min.js')}}"></script>
<script src="{{asset('js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>


<script>
    $(document).ready(function() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $('#InscriptionsTable').DataTable({
            searching: true,


            language: {
                lengthMenu: "Display _MENU_ records per page",
                zeroRecords: "Pas de Résultat   ",
                info: "Showing page _PAGE_ of _PAGES_",
                infoEmpty: "No records available",
                infoFiltered: "(filtered from _MAX_ total records)"
            },
            processing: true,
            lengthMenu: [
                [10, 25, 50,100,200,500, -1],
                [10, 25, 50,100,200,500],
            ],
            serverSide: true,
            ajax: "{{route('inscriptions.getInscriptions')}}",
            columns: [
                {data:"id"},
                {data:"debut"},
                {data:"fin"},
                {data:"reste"},
                {data:"nbsseance"},
                {data:"abonnement"},
                {data:"membre"},
                {data:"etat"},
                {data:"total"},
                {data:"remise"},
                {data:"nbrmois"},
                {data:"versement"},
                {
                        className: 'action-buttons',
                        orderable: false,
                        mRender: function (data, type, row) {
                            var view = '<a href="/inscription/presence/' + row.id + ' " class="btn bubbly-button text-white">Présences <i class="fa fa-user"></i> </a>';
                            view += ' <a href="/inscription/destroy/' + row.id + ' " onclick="return confirm(\'Etes vous sur ?\')" class="btn bubbly-button text-white">Supprimer <i class="fa fa-trash"></i></a>';


                            return view

                        },
                }                

            ]
      });
      var oldSearchValue = '';
            $('#table_search').keyup(function () {
                var newValue = $(this).val();
                if (newValue !== oldSearchValue) {
                    dataTable.search(newValue).draw();
                    oldSearchValue = newValue;
                }
            });

});

</script>
@endsection