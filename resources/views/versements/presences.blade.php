@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des Présenses :   <h1>
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
                                        <form method="post" action="{{route('presence.filter',['membre'=>$membre->id ?? ''])}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Date Début</label>
                                                    <input type="date" name="date_debut" value="{{$date_debut ?? ''}}" class="form-control">
                                                </div>                                     
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Date Fin</label>
                                                    <input type="date" name="date_fin" value="{{$date_fin ?? ''}}" class="form-control">
                                                </div>                                     
                                            </div>

                                            <div class="col-sm-2">
                                                <label>&nbsp;</label>
                                                <button type="submit" id="valider" class="btn bubbly-button btn-block">filter</button>
                                            </div>
                                        </div>
                                    </form>

                                <h4 class="card-title">
                                </h4>                     
                                <table id="example1"  class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Présnces Numéro</th>
                                                <th>Date Entrée</th>                                             
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($presences as $presence)
                                            <tr>
                                                <td>{{$presence->id ?? ''}}</td>
                                                <td>
                                                  <h3>
                                                    <span class="badge badge-info">

                                                    {{$presence->created_at->format('Y-m-d')  ?? ''}}

                                                    </span>
                                                  </h3>
                                                </td>
                                                
                                            </tr>
                                            @endforeach                                            
                                        </tbody>
                                    </table>


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
        
});

</script>
@endsection