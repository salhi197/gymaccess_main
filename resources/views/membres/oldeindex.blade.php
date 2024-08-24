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
          <div class="col-sm-6">
          <a href="{{route('membre.create')}}" class="btn bubbly-button btn-lg"><i class="fa fa-plus"></i> Ajouter</a>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')
                        <div class="card ">
                            <div class="card-body table1">
                                <div class="table-responsive">
                                    <table id="example1" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Matricule</th>
                                                <th>nom</th>
                                                <th>Prénom</th>
                                                <th>Téléphone</th>
                                                
                                                <th>Abonnement</th>
                                                <th>Fin</th>
                                                <th>Ajouté le</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($membres as $membre)
                                                @if($membre->matricule != 0)
                                                    <tr>
                                                        <td>{{$membre->matricule }}</td>
                                                        <td>{{$membre->nom ?? ''}}</td>
                                                        <td>{{$membre->prenom ?? ''}}</td>
                                                        <td>{{$membre->telephone ?? ''}}</td>                                            
                                                        <td>
                                                            <span class="btn bubbly-button" >
                                                                {{$membre->getAbonnement()['label'] ?? '' }}
                                                            </span>
                                                        </td>                                            
                                                        <td>
                                                                {{$membre->getActiveInscription()['fin'] ?? '' }}
                                                        </td>                                            

                                                        <td>
                                                            {{$membre->created_at ?? ''}}
                                                        </td>                                            
                                                        <td>
                                                            <a class="btn bubbly-button text-white" href="{{route('membre.edit',['membre'=>$membre->matricule])}}">Modifier <i class="fa fa-edit"></i></a>
                                                            <a class="btn bubbly-button text-white" onclick="return confirm('Etes vous sure ?')" href="{{route('membre.destroy',['membre'=>$membre->matricule])}}"><i class="fa fa-trash"></i> Supprimer</a>
                                                            <a class="btn bubbly-button text-white" href="{{route('membre.membre',['membre'=>$membre->matricule])}}">
                                                            Profile
                                                            </a>
                                                        </td>
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
    //   $('#MembersTable').DataTable({
    //         language: {
    //             lengthMenu: "Display _MENU_ records per page",
    //             zeroRecords: "Pas de Résultat   ",
    //             info: "Showing page _PAGE_ of _PAGES_",
    //             infoEmpty: "No records available",
    //             infoFiltered: "(filtered from _MAX_ total records)"
    //         },
    //         processing: true,
    //         serverSide: true,
    //         ajax: "{{route('members.getMembers')}}",
    //         columns: [
    //             { data:'matricule'},
    //             { data:'nom'},
    //             { data:'prenom'},
             
    //             { data:'label'},
    //             { data:'fin'},
    //             { data:'created_at'},
    //             {data: 'action', name: 'action', orderable: false, searchable: false},

    //         ]
    //   });
      var oldSearchValue = '';
            $('#table_search').keyup(function () {
                var newValue = $(this).val();
                if (newValue !== oldSearchValue) {
                    dataTable.search(newValue).draw();
                    oldSearchValue = newValue;
                }
            });

        // @foreach($membres as $membre)
        //     @if($membre->matricule != 0)
        //         <tr>
        //             <td>{{$membre->matricule }}</td>
        //             <td>{{$membre->nom ?? ''}}</td>
        //             <td>{{$membre->prenom ?? ''}}</td>
        //             <td>{{$membre->telephone ?? ''}}</td>                                            
        //             <td>
        //                 <span class="btn bubbly-button" >
        //                     {{$membre->getAbonnement()['label'] ?? '' }}
        //                 </span>
        //             </td>                                            
        //             <td>
        //                     {{$membre->getActiveInscription()['fin'] ?? '' }}
        //             </td>                                            

        //             <td>
        //                 {{$membre->created_at ?? ''}}
        //             </td>                                            
        //             <td>
        //                 <a class="btn bubbly-button text-white" href="{{route('membre.edit',['membre'=>$membre->matricule])}}">Modifier <i class="fa fa-edit"></i></a>
        //                 <!-- <a href="{{route('membre.destroy',['membre'=>$membre->matricule])}}" onclick="return confirm('Etes vous sure ?')"  class="btn btn-danger text-white"><i class="fa fa-window-close"></i></a> -->
        //                 <a class="btn bubbly-button text-white" onclick="return confirm('Etes vous sure ?')" href="{{route('membre.destroy',['membre'=>$membre->matricule])}}"><i class="fa fa-trash"></i> Supprimer</a>
        //                 <a class="btn bubbly-button text-white" href="{{route('membre.membre',['membre'=>$membre->matricule])}}">
        //                 Profile
        //                 </a>
        //             </td>
        //         </tr>

        //     @endif
        // @endforeach                                            

        
        // $('.state').on('change',function(e){
        //     var id = this.id
        //     console.log(id)

        //     $.ajax({
        //         type: 'GET', //THIS NEEDS TO BE GET
        //         url: '/membre/state/'+id,
        //         dataType: 'JSON',
        //         success: function (data) {
        //             console.log(data)
        //             toastr.success('état changé');
        //         },
        //         error: function(err) { 
        //             console.log(err)
        //             toastr.error(err)
        //         }
        //     });
        // })
});

</script>
@endsection