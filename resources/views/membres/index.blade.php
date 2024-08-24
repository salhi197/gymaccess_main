@extends('layouts.master')
@section('styles')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('header')
    <div class="content-header">
      <div class="container">


      
      <div class="row">
    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{count($membres)}}</h3>
                <p>Nombre Total</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{count($actifs)}}</h3>
                <p>Total Actifs</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('membre.actifs')}}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{count($membres)-count($actifs)}}</h3>
                <p>Total Expiré</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('membre.expirer')}}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{count($credits)}}</h3>
                <p> Endettés </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('membre.credits')}}" class="small-box-footer">Plus d'info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>


    @if(Auth::user()->isadmin == 1 and Auth::user()->genre=="mixte")
        <div class="row mb-2">
          <div class="col-sm-4">
              <a href="{{route('membre.create')}}" class="btn bubbly-button btn-lg"><i class="fa fa-plus"></i> Ajouter</a>
          </div><!-- /.col -->
          
<!--           <div class="col-sm-4">
              <h1 class="m-0 text-white">{{trans('main.Nombre Total')}} : {{count($membres)}}<h1>
              <h1 class="m-0 text-white"><a class="text-white" href="{{route('membre.actifs')}}">Actifs : {{count($actifs)}} </a> <h1>
              <h1 class="m-0 text-white"><a class="text-white" href="{{route('membre.expirer')}}">Expiré : {{count($membres)-count($actifs)}} </a> <h1>
              <h1 class="m-0 text-white"><a class="text-white" href="{{route('membre.credits')}}">Endettés : {{count($credits)}} </a> <h1>
          </div>
          <div class="col-sm-3">
              <h1 class="m-0 text-white">Crédit : {{$credit}}  DA<h1>
          </div>
 -->
        </div><!-- /.row -->
    @endif

        <div class="row mb-2">
        @if(Auth::user()->genre == "homme" and Auth::user()->isadmin !=1)
        <div class="row mb-2">
          <div class="col-sm-4">
              <a href="{{route('membre.create')}}" class="btn bubbly-button btn-lg"><i class="fa fa-plus"></i> Ajouter</a>
          </div><!-- /.col -->
          

          <div class="col-sm-4">
              <h1 class="m-0 text-white">Total Homme : {{count($hommes)}}<h1>
          </div><!-- /.col -->

        </div><!-- /.row -->

        @endif
        @if(Auth::user()->genre == "femme" and Auth::user()->isadmin !=1)
        <div class="row mb-2">
          <div class="col-sm-4">
              <a href="{{route('membre.create')}}" class="btn bubbly-button btn-lg"><i class="fa fa-plus"></i> Ajouter</a>
          </div><!-- /.col -->
          

          <div class="col-sm-4">
              <h1 class="m-0 text-white">Total Homme : {{count($hommes)}}<h1>
          </div><!-- /.col -->

        </div><!-- /.row -->

        @endif


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


                                
                                

                                <div class="table-responsive">
                                    <table id="MembersTable" class="table table-striped table-bordered no-wrap">
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
        // $('#input_id').on('change',function(){
        //     if($('#input_id').val().length >0){
        //         let number = parseInt($('#input_id').val(), 10);
        //         console.log(number);
        //         window.location.href = 'http://localhost:8000/membre/compte/'+number;
        //     }o
        // });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $('#MembersTable').DataTable({
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
            ajax: "{{route('members.getMembers')}}",
            columns: [
                { data:'id'},
                { data:'matricule'},
                { data:'nom'},
                { data:'prenom'},
                { data:'telephone'},
                {
                        className: 'action-buttons',
                        orderable: false,
                        mRender: function (data, type, row) {
                            var view = '<a href="/membre/membre/' + row.matricule + ' " class="btn bubbly-button text-white">{{trans("main.Profile")}} <i class="fa fa-user"></i> </a>';
                            view += ' <a href="/membre/edit/' + row.matricule + ' " class="btn bubbly-button text-white">{{trans("main.Modifier")}} <i class="fa fa-edit"></i></a>';
                            view += ' <a href="/membre/oublier/' + row.matricule + ' " class="btn btn-success text-white">Puce Oubliée</a>';

                            @if(Auth::user()->isadmin==1)
                            view += ' <a href="/membre/destroy/' + row.matricule + ' " onclick="return confirm(\'Etes vous sur ?\')" class="btn bubbly-button text-white">{{trans("main.Supprimer")}} <i class="fa fa-trash"></i></a>';

                            @endif
                            return view
                        },
                }
                
                // {data: 'action', name: 'action', orderable: false, searchable: false},

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