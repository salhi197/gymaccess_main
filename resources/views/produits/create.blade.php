@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Produit  </h3></div>
                                    <div class="card-body">
                                        <form role="form" action="{{route('produit.store')}}" method="post">
                                        @csrf
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Famille Produits</label>
                                                        <select class="form-control" name="categorie">
                                                            @foreach($categories as $categorie)
                                                            <option value="{{$categorie->id}}">{{$categorie->label}}</option>						 
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Désignation Produit</label>
                                                        <input type="text" name="designation" required="" class="form-control">
                                                    </div>
                                                </div>
                                                <!-- <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>Paramètre</label>
                                                        <select class="form-control js-example-basic-multiple"" name="settings">
                                                            @foreach($settings as $setting)
                                                            <option value="{{$setting}}">{{$setting->determination}}</option>						 
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> -->

                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <button type="submit" id="valider" class="btn btn-info btn-block">Valider</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

@endsection


@section('scripts')
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

</script>
@endsection



