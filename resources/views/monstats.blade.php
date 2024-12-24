@extends('layouts.master')

@section('content')
                <div class="container-fluid">
                    <div class="card-header">                
                    </div>
                </div>
                <div class="card-group">
                        <form method="post" action="{{route('stats.filter')}}">                                                    
                            @csrf
                            <div class="row">
                                <div class="col-md-3" >
                                    <label class="control-label">{{ trans('main.Début') }}: </label>
                                    <input class="form-control" value="{{$date_debut ?? ''}}" name="date_debut" type="date" />
                                </div>
                                <div class="col-md-3" >
                                    <label class="control-label">{{ trans('main.Fin') }}: </label>
                                    <input class="form-control" value="{{$date_fin ?? ''}}" name="date_fin" type="date" />
                                </div>


                                <div class="col-md-4" >
                                    <label class="m-0 text-white" >Caissier:</label><br>
                                    <select class="customselect" id="user" name="user">
                                        <option value="" >Séléctionner un user:</option>
                                            @foreach($users as $user)
                                                <option
                                                    @if($_user==$user->id) selected @endif
                                                 value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach
                                    </select>

                                </div>

                                <div class="col-md-4" style="padding:35px;">
                                    <button type="submit" class="row btn bubbly-button" >
                                        {{ trans('main.Filter') }}
                                    </button>                                                                                                        
                                </div>
                        </form>
                </div> 
               <div class="card mb-4">
                        <div class="card-group table1">
                                    
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">{{ trans('main.Type') }}</th>
                          <th scope="col">{{ trans('main.Nombre') }}</th>
                          <th scope="col">{{ trans('main.Montant') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">{{ trans('main.Inscriptions') }}</th>
                          <td><h1>{{$countInscriptions ?? ''}}</h1></td>
                          <td>
                                <h1>
                                    {{$benefice}} DA
                              
                                </h1>
                            </td>
                        </tr>


                        <tr>
                          <th scope="row">Versement </th>
                          <td><h1>{{$versements ?? ''}}</h1></td>
                          <td>
                                <h1>
                                    {{$versementsSolde}} DA
                              
                                </h1>
                            </td>
                        </tr>
                        <tr>
                          <th scope="row">{{ trans('main.Séance Libre') }} </th>
                            <td><h1>{{count($libres) ?? ''}}</h1></td>
                          <td>
                                    <h1>
                                        {{$beneficeLibres ?? ''}} DA
                                    </h1>
                            </td>
                        </tr>
                        <tr>
                          <th scope="row">Assurance</th>
                          <td><h1>{{$assurances ?? ''}}</h1></td>
                          <td><h1>{{$assurancesSolde ?? ''}} DA</h1></td>
                        </tr>

                        <tr>
                          <th scope="row">Puce</th>
                          <td><h1>{{$puces ?? ''}}</h1></td>
                          <td><h1>{{$pucesSolde ?? ''}} DA</h1></td>
                        </tr>


                        <tr>
                          <th scope="row">{{ trans('main.Charges') }}</th>
                          <td><h1>{{$countDecharges ?? ''}} 
                            
                          </h1></td>
                          <td><h1>{{$decharges ?? ''}} DA</h1></td>
                        </tr>

                        <tr>
                            <td colspan="2">{{ trans('main.Total Net') }}</td>
                            <td>
                                <h1>
                                    {{$assurancesSolde+$beneficeLibres+$benefice+$pucesSolde-$decharges}} DA
                                </h1>
                            </td>
                        </tr>
                      </tbody>
                    </table>

                                    
                    </div>
                    
                </div> 
        </div>


@endsection


@section('scripts')
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/chart.js')}}"></script>

<script>
$(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('YYYY MMMM DD') + ' '
                            + momentNow.format('dddd')
                             .substring(0,3).toUpperCase());
        $('#time-part').html(momentNow.format('A hh:mm:ss'));
    }, 100);
aDatasets1 = [65,59,80,81,56,55,40,47];  
aDatasets2 = [20,30,40,50,60,20,25,47];
var ctx = document.getElementById("myChart");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Samedi", "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi","vendredi"],
        
        datasets: [ {
              label: 'Homme',
              fill:false,
            data: aDatasets1,

            backgroundColor: '#E91E63',
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
            ],
            borderWidth: 1
        },
        
        {
            label: 'Femme',
              fill:false,
            data: aDatasets2,
            backgroundColor: 
                '#3F51B5'
            ,
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
                'rgba(255,99,132,1)',
            ],
            borderWidth: 1
        }
        
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        title: {
            display: true,
            text: 'Membre par semaine'
        },
        responsive: true,
        
       tooltips: {
            callbacks: {
                labelColor: function(tooltipItem, chart) {
                    return {
                        borderColor: 'rgb(255, 0, 20)',
                        backgroundColor: 'rgb(255,20, 0)'
                    }
                }
            }
        },
        legend: {
            labels: {
                // This more specific font property overrides the global property
                fontColor: 'red',
               
            }
        }
    }
});

});



</script>

@endsection