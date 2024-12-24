@extends('layouts.master')

@section('page_wrapper')
        <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 right">
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item text-muted active" aria-current="page">RÉFÉRENCES</li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">RÉSULTATS</li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">ORGANO</li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">RÉSULTATS</li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">PARAMETRES</li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">ECHANTILLONS</li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">UNITÉS</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    
                </div>
            </div>


@endsection

@section('content')

<div class="container-fluid">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="card mt-2">
                                    <div class="card-header"><h3 class="font-weight-light my-4"> Nouveau Paramètres  </h3></div>
                                    <div class="card-body">
                                        <form role="form" action="{{route('setting.store')}}" method="post">
                                        @csrf
                                            <div class="well sm">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Paremètre</label>
                                                            <input type="text" name="determination" class="form-control" required="true">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Durée</label>
                                                            <input type="text" name="duree" class="form-control">
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Aspect</label>
                                                            <input type="checkbox" name="aspect" class="form-control">
                                                        </div> 
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>&nbsp;</label>
                                                        <button type="submit" id="valider" class="btn btn-info btn-block">Valider</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>                                        
                                        





                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    









@endsection



