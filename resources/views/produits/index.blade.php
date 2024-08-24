@extends('layouts.master')
@section('header')
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des produits  </h1>
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
              
                        <button data-toggle="modal" data-target="#squarespaceModal" class="btn bubbly-button btn-lg">
                                    Ajouter Produit
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
                                    <table id="example1"  class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>ID produit</th>
                                                <th>Nom produit </th>
                                                <th> Qte </th>
                                                <th> Prix Achat </th>

                                                <th> Prix Vente </th>

                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($produits as $produit)                                            

                                            <tr>

                                                <td>{{$produit->id ?? ''}}</td>
                                                <td>
                                                    {{$produit->nom ?? ''}} 
                                                </td>
                                                <td>{{$produit->qte ?? ''}} </td>
                                                <td>{{$produit->prix_achat ?? ''}} DA </td>
                                                <td>{{$produit->prix_vente ?? ''}} DA </td>


                                                <td >

                                                    <div class="table-action">  
                                                        <a 
                                                        href="{{route('produit.destroy',['produit'=>$produit->id])}}"
                                                        class="btn btn-danger   text-gradient px-3 mb-0" onclick="return confirm('etes vous sure  ?')" >
                                                            <i class="far fa-trash-alt me-2"></i>
                                                            Delete
                                                        </a>

                                                        <button data-toggle="modal" data-target="#squarespaceModal{{$produit->id}}" class="btn btn-info text-dark px-3 mb-0">
                                                            <i class="far fa-edit"></i>

                                                            Modifer
                                                        </button>       
          
                                                    </div>

                                                </td>



                                            </tr>

                                            @include('includes.modals.editproduit')


                                            @endforeach





                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>




<div class="modal fade " id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content model1">
            <div class="modal-header">
                <h3 class="modal-title" id="lineModalLabel">Ajouter Produit : </h3>
            </div>
            <div class="modal-body">
                <form action="{{route('produit.create')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom Produit</label>
                        <input type="text" value="{{ old('nom') }}" name="nom" class="form-control"
                            id="exampleInputEmail1" placeholder=" ">
                    </div>
                    

                    <div class="form-group">
                        <label for="exampleInputEmail1">prix Achat :</label>
                        <input type="text" value="{{ old('prix_achat') }}" name="prix_achat" class="form-control" id=""
                            placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Prix Vente : </label>
                        <input type="text" value="{{ old('prix_vente') }}" name="prix_vente" class="form-control" id="prix_vente"
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Qte : </label>
                        <input type="text" value="{{ old('qte') }}" name="qte" class="form-control" id="qte"
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Photo : </label>
                        <input type="file" value="{{ old('photo') }}" name="photo" class="form-control" id="photo"
                            placeholder="">
                    </div>



                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" role="button">Fermer</button>
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

        
});

</script>
@endsection