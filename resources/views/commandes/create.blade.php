@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Membre  </h3></div>
                                    <div class="card-body">
                                        <form role="form" action="{{route('membre.store')}}" method="post">
                                        @csrf

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Nom</label>
                                                        <input type="text" required value="{{old('nom')}}" name="nom" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Prénom</label>
                                                        <input type="text" required value="{{old('prenom')}}" name="prenom" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Adresse</label>
                                                        <input type="text" value="{{old('adresse')}}" name="adresse" class="form-control">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Téléphone</label>
                                                        <input type="text" value="{{old('telephone')}}" name="telephone" class="form-control">
                                                    </div>
                                                </div>

                                                <div class ="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Genre</label>
                                                        <select class="form-control" name="sexe">
                                                            <option value="homme">Homme</option>						 
                                                            <option value="femme">Femme</option>						                                                             
                                                        </select>
                                                    </div>
                                                    <!-- <div class="form-group">
                                                        <label>Fax</label>
                                                        <input type="text" value="{{old('fax')}}" name="fax" class="form-control">
                                                    </div> -->
                                                </div>


                                                <div class ="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Photo</label>
                                                        <input type="file" value="{{old('photo')}}" name="photo" 
                                                        class="form-control">
                                                    </div>
                                                </div>


                                            </div>
                                    </div>
                                </div>



                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Type d'abonnement  </h3></div>
                                    <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Abonnement</label>
                                                        <select class="form-control" name="abonnement">
                                                            @foreach($abonnements as $abonnement)
                                                            <option value="{{$abonnement->id}}">{{$abonnement->label}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>date fin</label>
                                                        <input type="date" value="{{old('fin')}}" name="fin" class="form-control">
                                                    </div>

                                                </div>

                                                <div class ="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Date début</label>
                                                        <input type="date"  value="{{Date('Y-m-d')}}" name="debut" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Total</label>
                                                        <input type="number" value="{{old('total')}}" name="total" class="form-control">
                                                    </div>
                                                </div>

                                                <div class ="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Nombre de mois</label>
                                                        <input type="number" value="{{old('nbrmois')}}" name="nbrmois" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Remise</label>
                                                        <input type="number" value="{{old('remise')}}" name="remise" class="form-control">
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

                    </div>
@endsection




