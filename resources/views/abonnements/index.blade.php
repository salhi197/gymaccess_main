@extends('layouts.master')



@section('content')

<div class="container-fluid">

                        <h1 class="mt-4 text-white "> {{trans('main.Liste de Tous Les Abonnements')}} : </h1>

                            <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn bubbly-button" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i> {{trans('main.Ajouter Abonnement')}}
                                </button>
                            </div>
                                    <div class="card-body table1">
                                        <div class="table-responsive">
                                            <table class="table" id="example1">
                                            <thead class="">
                                                <tr>
                                                    <th>{{trans('main.ID')}}</th>
                                                    <th>{{trans('main.label')}}</th>
                                                    <th>{{trans('main.Tarif')}}</th>
                                                    <th>Tripode</th>
                                                    <th>Nbr Total Actifs</th>
                                                    <th>{{trans('main.actions')}}</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($abonnements as $abonnement)
                                        <tr>
                                            <td class="display-4">{{$abonnement->id ?? ''}}</td>
                                            <td class="display-4">{{$abonnement->label ?? ''}}</td>
                                            <td class="display-4">{{$abonnement->tarif ?? ''}} DA</td>
                                            <td class="display-4">
                                                @if($abonnement->tripode == 3 )
                                                    Les Deux
                                                @else
                                                {{$abonnement->tripode ?? ''}}
                                                @endif

                                            </td>
                                            <td class="display-4">{{$abonnement->total() ?? ''}} </td>

                                            <td >
                                                <div class="table-action">  
                                                    @if($abonnement->id != 1)
                                                    <a  href="{{route('abonnement.destroy',['abonnement'=>$abonnement->id])}}"
                                                    onclick="return confirm('etes vous sure  ?')"
                                                    class="btn bubbly-button text-white"><i class="fa fa-trash"></i> &nbsp; </a>

                                                    @endif

                                                    <button type="button" class="btn bubbly-button" data-toggle="modal" data-target="#exampleModal{{$abonnement->id}}">
                                                        <i class="fa fa-plus"></i> {{trans('main.Modifier')}}
                                                    </button>


                                                </div>
                                            </td>
                                        </tr>
                                        @include('includes.modals.editabo')
                                        @endforeach
                                        </tbody>



                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content model1">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{trans('main.Ajouter Abonnement')}}:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="abonnementFform" action="{{route('abonnement.create')}}" method="post" enctype="multipart/form-data">
            @csrf



                    <div class="form-group">
                        <label for="exampleInputEmail1">Tourniquet : </label>
                        <select name="tripode" class="customselect">
                            <option value="1">
                                1
                            </option>
                            <option value="2">
                                2
                            </option>
                            <option value="3">
                                Les Deux
                            </option>
                            
                        </select>
                    </div>
                


                <div class="form-group">
                    <label  for="inputFirstName">{{trans('main.Titre Abonnement')}}: </label>
                    <input type="text" name="label"  class="form-control"/>
                </div>  
                <div class="form-group">
                    <label  for="inputFirstName">{{trans('main.Nombre de fois par semaine')}}: </label>
                    <input type="number" min="1" max="7" name="nbrsemaine"  class="form-control"/>
                </div>  
                
                
                <div class="form-group">
                    <label  for="inputFirstName">{{trans('main.Tarif')}}: </label>
                    <input type="number" name="tarif"  class="form-control"/>
                </div>  
                <button class="btn bubbly-button btn-block" type="submit" id="ajax_abonnement">{{trans('main.Ajouter')}}</button>
            </form>
      </div>
    </div>
  </div>
</div>



@endsection


@section('scripts')

<script>

$("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "order": [[ 0, "desc" ]],
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print','colvis'
            ]

          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


</script>
@endsection
