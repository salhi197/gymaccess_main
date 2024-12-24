@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row ">
          <div class="col-md-6">
            <h1 class="m-0 text-white"> Liste de Inscriptions </h1>
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
                            <div class="card-body">
                                    
                                
                                <div class="table-responsive">
                                    <table  class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th><h3>id</h3></th>
                                                <th><h3>Nom Prenom</h3></th>
                                                <th><h3>debut</h3></th>
                                                <th><h3>fin</h3></th>
                                                <th><h3>Nombre seance reste</h3></th>
                                                <th><h3>nbr seances</h3></th>
                                                <th><h3>abonnements</h3></th>

                                                <th><h3>total</h3></th>
                                                <th><h3>remise</h3></th>
                                                <th><h3>nbrmois</h3></th>
                                                <th><h3>versement</h3></th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($inscriptions as $inscription)
                                            <tr class="
                                            @if($inscription->etat == 1)
                                            td-success
                                            @else
                                            td-error
                                            @endif
                                            ">
                                                <td style="font-size:25px;">{{$inscription->id ?? ''}}</td>

                                                <td style="font-size:25px;">
                                                    {{$inscription->getMembre()['nom'] ?? ''}}
                                                    {{$inscription->getMembre()['prenom'] ?? ''}}
                                                </td>
                                                <td style="font-size:25px;">{{$inscription->debut ?? ''}}</td>
                                                <td style="font-size:25px;">{{$inscription->fin ?? ''}}</td>
                                                <td style="font-size:25px;">{{$inscription->reste ?? ''}}</td>
                                                <td style="font-size:25px;">{{$inscription->nbsseance ?? ''}}</td>
                                                <td style="font-size:25px;">{{$inscription->getAbonnement() ?? ''}}</td>
                                                <td style="font-size:25px;">{{$inscription->total ?? ''}}DA</td>
                                                <td style="font-size:25px;">{{$inscription->remise ?? ''}}</td>

                                                <td style="font-size:25px;" >
                                                    {{$inscription->nbrmois ?? ''}}
                                                </td>                                            
                                                <td style="font-size:25px;">{{$inscription->versement ?? ''}} DA</td>

                                            </tr>
                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter Inscription</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="{{route('inscription.store')}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="hidden" value="{{$membre->id ?? ''}}" name="membre" />
                                                <div class="form-group">
                                                    <label>Abonnement</label>
                                                    <select class="form-control" id="abonnement" name="abonnement">
                                                        <option value="">séléctionner un abonnement</option>
                                                        @foreach($abonnements as $abonnement)
                                                        <option value="{{$abonnement}}">{{$abonnement->label}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Date début</label>
                                                    <input type="date" id="debut"  value="{{Date('Y-m-d')}}" name="debut" class="form-control">
                                                </div>

                                            </div>

                                            <div class ="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tarification:</label>
                                                    <input type="number"  name="tarif" value="0" id="tarif" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>date fin</label>
                                                    <input id="fin" type="date" value="{{old('fin')}}" name="fin" class="form-control">
                                                </div>
                                            </div>

                                            <div class ="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nombre de mois</label>
                                                    <input type="number"  value="{{old('nbrmois') ?? 1}}" min="1" id="nbrmois" name="nbrmois" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Total</label>
                                                    <input type="number" id="total" value="{{old('total')}}" name="total" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Remise</label>
                                                    <input type="number" value="{{old('remise') ?? 0}}" id="remise" name="remise" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Versement</label>
                                                    <input type="number" value="{{old('versement') ?? 0}}" id="versement" name="versement" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>T.T.C : </label>
                                                    <input type="number" value="{{old('ttc') ?? 0}}" id="ttc" name="ttc" class="form-control">
                                                </div>
                                                

                                            </div>

                                        </div>


                                    <div class="col-sm-12">
                                        <button type="submit" id="valider"  class="btn btn-info btn-block">Valider</button>
                                    </div>


                                    </form>
                                </div>
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
            "language": {
                'loadingRecords': 'Processing...',
            },
            "processing": true, // for show progress bar,
            retrieve: true,
            "language": {
                        'processing': '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading..n.</span>'
            },            
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