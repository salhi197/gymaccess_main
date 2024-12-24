@extends('layouts.master')

@section('content')
        <div class="container-fluid">

            <div class="card-header">
                <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                      <div class="inner">
                                      
                                        <h3>{{count($presences) ?? ''}}</h3>
                                        <p>
                                            Nombre Total
                                        </p>
                                      </div>
                                      <div class="icon">
                                        <i class="ion ion-bag"></i>
                                      </div>
                                    </div>
                                </div>
                                

                                  
                            </div>

                </div>
            </div>
            <div class="card-group">
            </div> 
               <div class="card mb-4">
                        <div class="card-group">
                                    
                                    <form method="post" action="{{route('activities.filter')}}">                                                    
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4" >
                                                        <label class="control-label">{{ __('Début') }}: </label>
                                                        <input class="form-control" value="{{$date_debut ?? ''}}" name="date_debut" type="date" />
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <label class="control-label"    >{{ __('Activity') }}: </label>
                                                        <select class="form-control" name="a">
                                                            <option value="">Séléctionner Activité</option>
                                                            <option value="1">Fitness_dance</option>
                                                            <option value="10">Fitness</option>

                                                            <option value="2">Ventre plat</option>
                                                            <option value="5">Yoga</option>
                                                            <option value="7">Box Musculation</option>
                                                            <option value="6">Cross fit</option>
                                                            <option value="11">Body_sculpt</option>

                                                            <option value="9">Circuit_training</option>
                                                            <option value="Cardio">Cardio</option>
                                                            <option value="F_A_C">F_A_C</option>
                                                            <option value="Gym_douce">Gym_douce</option>
                                                            <option value="4">Zumba</option>
                                                            <option value="8">Zumba Kids</option>

                                                            <option value="3">Step</option>

                                                            


                                                        </select>
                                                    </div>

                                                    

                                                    <div class="col-md-2" style="padding:35px;">
                                                        <button type="submit" class="row btn btn-primary" >
                                                            Filtrer
                                                        </button>                                                                                                        
                                                    </div>


                                        </form>
                                       
                    </div>
                    <div class="table-responsive">
                                            <table id="example1"  class="table table-striped table-bordered no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th>id</th>
                                                        <th>nom Prénom</th>
                                                        <th>Date & Heure</th>
                                                        <th>Activité</th>
                                                        </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($presences as $presence)

                                                    <tr>
                                                        <td>{{$presence->getMembre()['id'] ?? 'libre'}}</td>
                                                        <td>{{$presence->getMembre()['nom'] ?? 'libre '}} {{$presence->getMembre()['prenom'] ?? 'libre'}}</td>
                                                        <td>{{$presence->created_at ?? ''}}</td>

                                                        <td>
                                                            <span class="badge badge-info">
                                                                {{$presence->activity ?? 'Non Mentioné'}}
                                                            </span>
                                                        </td>                                            
                                                    </tr>

                                                    @endforeach                                            
                                                </tbody>
                                            </table>
                                        </div>
                </div> 
        </div>


@endsection


@section('scripts')
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/chart.js')}}"></script>
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