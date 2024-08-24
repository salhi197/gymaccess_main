@extends('layouts.master')

@section('content')
      

<div class="card mb-4">

<h1 style="text-align: center; color: black; "  ><B>Liste Des Documents a Traduire</B></h1>

<br>

 <!-- Button Ajout du document -->
 <div class="card-header">
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Ajouter Un Document
                    </button>
</div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifier le document</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                        <form action="/AddPapier" method="post" enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nom document  : </label>

                                                <input type="text" class="form-control"  value="{{ old('name') }}" name="name" id="nom" >

                                            </div>

                                            <div class="form-group">

                                                <label for="exampleInputEmail1">Description  : </label>

                                                <input type="text" class="form-control"  value="{{ old('prenom') }}" name="description" id="description" >

                                              </div>

            


                            

                                            <div class="btn-group" role="group">

                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"  role="button">Fermer</button>

                                                </div>
                                            

                                     </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            
                        </div>
                        </div>
                    </div>
                    </div>

                    <!-- Button Fin Ajout du document -->

<div class="card-body">
    <div class="table-responsive">

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

    <thead>
        <tr>
            <th>Document</th>

            <th>Description </th>

            <th>Date D'ajout</th>

            <th>Action</th>

        </tr>

    </thead>

    <tbody>

                                         
    @foreach($produits as $produit) 
        <tr>

            <td>{{$produit->nom }}</td>

            <td>{{$produit->description }}</td>

            <td>{{$produit->created_at }}</td>

            

            <td>

                        <!-- Button Detail du document -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$produit->id }}">
                    Modifier
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$produit->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$produit->id  }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel{{$produit->id  }}">Modifier le document</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            
                        <form action="/ModifierPapier/{{$produit->id}}" method="post" enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nom document  : </label>

                                                <input type="text" class="form-control"  value="{{ $produit->nom }}" name="name" id="nom" >

                                            </div>

                                            <div class="form-group">

                                                <label for="exampleInputEmail1">Description  : </label>

                                                <input type="text" class="form-control"  value="{{ $produit->description  }}" name="description" id="description" >

                                              </div>

            


                            

                                            <div class="btn-group" role="group">

                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal"  role="button">Fermer</button>

                                                </div>
                                            

                                     </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            
                        </div>
                    </div>
                    </div>

                    <!-- Button Fin Detail du document -->

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