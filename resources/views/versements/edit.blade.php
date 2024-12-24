@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Client  </h3></div>
                                    <div class="card-body">
                                        <form role="form" action="{{route('client.update',['client'=>$client->id])}}" method="post">
                                            @csrf
                                            <div class ="row">
                                                <div class ="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Famille</label>
                                                        <select class="form-control" name="categorie">
                                                            @foreach($categories as $categorie)
                                                            <option value="{{$categorie->id}}" @if($client->categorie==$categorie->id) selected @endif>{{$categorie->label}}</option>						 
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                </div>

                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>Raison sociale</label>
                                                        <input type="text" required value="{{$client->raison_sociale}}" name="raison_sociale" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Nom</label>
                                                        <input type="text" required value="{{$client->nom}}" name="nom" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adresse</label>
                                                        <input type="text" value="{{$client->adresse}}" name="adresse" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Wilaya</label>
                                                        <select class="form-control" value="{{old('wilaya')}}" name="wilaya">
                                                        @foreach($wilayas as $wilaya)
                                                            <option value="{{$wilaya->code}}" @if($client->wilaya == $wilaya->code) selected @endif>{{$wilaya->name ?? ''}}</option>	
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class ="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Tél</label>
                                                        <input type="text" value="{{$client->telephone}}" name="telephone" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Fax</label>
                                                        <input type="text" value="{{$client->fax}}" name="fax" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>N° Registre</label>
                                                        <input type="text" value="{{$client->n_registre}}" name="n_registre" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>N° Nif</label>
                                                        <input type="text" value="{{$client->nif}}" name="nif" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>N° Nis</label>
                                                        <input type="text" value="{{$client->nis}}" name="nis" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>N° Article</label>
                                                        <input type="text" value="{{$client->n_article}}" name="n_article" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>e-mail</label>
                                                    <input type="text" value="{{$client->email}}" name="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Mot de passe</label>
                                                    <input type="text"  name="password" value="{{$client->password_text}}"  class="form-control">
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" id="valider"  class="btn btn-info btn-block">Valider</button>
                                            </div>
                                        </div>

                                        </form>


                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    









@endsection



