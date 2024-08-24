@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body b-l calender-sidebar">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('modals')

        <div id="fullCalModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Ajouter Crénau
                    </div>

                    <div class="modal-body">
                        
                        <!-- content goes here -->
                        <form method="post" action="{{route('reservation.store')}}" >
                            @csrf
                            <input type="hidden" readonly class="form-control" name="stade" value="{{$stade}}" placeholder="Enter email">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Date evenemts</label>
                                <input type="date" readonly class="form-control" id="eventdate" name="date" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Heure</label>
                                <input type="number" readonly class="form-control" name="crenau" id="crenau" name="crenau" placeholder="Enter email">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">nom prénom</label>
                                <input type="text" class="form-control" id="fullname" name="fullname" >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" >
                            </div>


                            <div class="form-group">
                                <label for="exampleInputPassword1">Prix</label>
                                <input type="text" class="form-control" id="fullname" name="prix" value="6000">
                            </div>


                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="state" id="state1" value="1" >
                                <label class="form-check-label" for="state1">
                                    Payé
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="state" id="state2" value="0" checked>
                                <label class="form-check-label" for="state2">
                                    Non Payé
                                </label>
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                            

                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>



        <div id="showEvent" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                        Modifier Crénau
                    </div>

                    <div class="modal-body">
                        <form method="post" action="" id="EditForm" >
                            @csrf

                            <input type="hidden" readonly class="form-control" name="stade" value="{{$stade}}" placeholder="Enter email">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Date evenemts</label>
                                <input type="date"  class="form-control"  name="_eventdate" id="_eventdate" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Heure</label>
                                <input type="number"  class="form-control" name="_crenau" id="_crenau" name="crenau" placeholder="Enter email">
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputPassword1">nom prénom</label>
                                <input type="text" class="form-control" name="_fullname" id="_fullname"  >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Phone</label>
                                <input type="text" class="form-control" name="_phone" id="_phone"  >
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Prix</label>
                                <input type="text" class="form-control" name="_prix" id="_prix"  >
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="_state" id="_state1" value="1" >
                                <label class="form-check-label" for="_state1">
                                    Payé
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="_state" id="_state2" value="0" checked>
                                <label class="form-check-label" for="_state2">
                                    Non Payé
                                </label>
                            </div>

                            <button type="submit" id="EditButton" class="btn btn-info">Submit</button>
                            <a 
                            id="id_reservation"
                            class="btn btn-danger text-white"
                            onclick="return confirm('etes vous sure de vouloir supprimer ?')"   
                            > Supprimer</a>
                        </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection


@section('scripts')

     
<script>
        
! function($) {
    "use strict";
    $('b').hide()
    $('br').hide()
    
    var CalendarApp = function() {
        this.$body = $("body")
        this.$calendar = $('#calendar'),
        this.$event = ('#calendar-events div.calendar-events'),
        this.$categoryForm = $('#add-new-event form'),
        this.$extEvents = $('#calendar-events'),
        this.$modal = $('#my-event'),
        this.$saveCategoryBtn = $('.save-category'),
        this.$calendarObj = null
    };


    /* on drop */
    CalendarApp.prototype.onDrop = function(eventObj, date) {
            var $this = this;
            // retrieve the dropped element's stored Event Object
            var originalEventObject = eventObj.data('eventObject');
            var $categoryClass = eventObj.attr('data-class');
            // we need to copy it, so that multiple events don't have a reference to the same object
            var copiedEventObject = $.extend({}, originalEventObject);
            // assign it the date that was reported
            copiedEventObject.start = date;
            if ($categoryClass)
                copiedEventObject['className'] = [$categoryClass];
            // render the event on the calendar
            $this.$calendar.fullCalendar('renderEvent', copiedEventObject, true);
            // is the "remove after drop" checkbox checked?
            if ($('#drop-remove').is(':checked')) {
                // if so, remove the element from the "Draggable Events" list
                eventObj.remove();
            }
        },
        CalendarApp.prototype.enableDrag = function() {
            //init events
            $(this.$event).each(function() {
                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                };
                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);
                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 999,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0 //  original position after the drag
                });
            });
        }
    /* Initializing */
    CalendarApp.prototype.init = function() {
            this.enableDrag();
            /*  Initialize the calendar  */
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var form = '';
            var today = new Date($.now());
            var defaultEvents = [];
            var event,evt;
            

            var evts = <?php echo json_encode($reservations); ?>;
            for(evt of evts){
                var dc= evt['crenau']
                var fc= parseInt(evt['crenau'])+1         
                var color = "bg-danger";       
                dc = parseInt(dc)
                if(dc<10){
                    dc="0"+dc
                }
                if(fc<10){
                    fc="0"+fc
                }
                if(evt['state'] == 1){
                    color = "bg-success"
                }
                event = {
                    id:evt['id'],
                    title: evt[""],
                    start: evt['date']+'T'+dc+':00:00',
                    end: evt['date']+'T'+fc+':00:00',
                    _eventdate:evt['eventdate'],
                    _crenau:evt['crenau'],
                    _eventdate:evt['date'],
                    _fullname:evt['fullname'],
                    _phone:evt['phone'],
                    _prix:evt['prix'],
                    className: color

                },
                defaultEvents.push(event)
            }
            console.log(defaultEvents)

            var $this = this;
            $this.$calendarObj = $this.$calendar.fullCalendar({
                slotDuration: '01:00:00',
                minTime: '08:00:00',
                maxTime: '19:00:00',
                defaultView: 'agendaWeek',
                handleWindowResize: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'agendaWeek,agendaDay'
                },
                events: defaultEvents,
                droppable: true, // this allows things to be dropped onto the calendar !!!
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                drop: function(date) { $this.onDrop($(this), date); },
                select: function(start, end, allDay) { 
                    console.log(start._i)
                    var month = parseInt(start._i[1]+1)
                    var crenau = parseInt(start._i[3])
                    
                    var day = start._i[2]
                    
                    if(month<10){
                        month ='0'+month
                    }

                    if(day<10){
                        day ='0'+day
                    }

                    var d = start._i[0]+'-'+month+'-'+day;      
                    console.log(start)              
                    console.log(d)              
                    $('#eventdate').val(d)
                    $('#crenau').val(crenau)
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();
                    today = yyyy+'-'+ mm + '-' + dd;
                    console.log(d, today)

                    if(d == today || d > today){
                        $('#fullCalModal').modal();
                    }
                 },
                eventClick: function(calEvent, jsEvent, view) { 
                    console.log(calEvent)
                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, '0');
                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                    var yyyy = today.getFullYear();

                    today = yyyy+'-'+ mm + '-' + dd;
                    console.log(calEvent,today)

                    $('#_eventdate').val(calEvent._eventdate)
                    $('#_crenau').val(calEvent._crenau)
                    $('#_fullname').val(calEvent._fullname)
                    $('#_phone').val(calEvent._phone)
                    $('#_prix').val(calEvent._prix)
                    if(calEvent._eventdate < today ){
                        $('#EditButton').hide();
                        console.log()
                    }else{
                        var id = calEvent.id
                        var url = '/reservation/update/'+id
                        console.log(url)
                        $('#EditForm').attr('action','/reservation/update/'+id)
                        $('#EditButton').show();
                    }
                    $('#showEvent').modal();

                }

            });
            
        },

        //init CalendarApp
        $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

}(window.jQuery),

//initializing CalendarApp
$(window).on('load', function() {

    $.CalendarApp.init()
});


        
        
        
        
    </script>

@endsection