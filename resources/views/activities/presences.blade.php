
<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href="{{asset('css/fullcalendar.css')}}" rel='stylesheet' />
<link href="{{asset('css/fullcalendar.print.css')}}" rel='stylesheet' media='print' />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
<link href="{{asset('adminlte/plugins/toastr/toastr.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">

</head>
<body class="hold-transition layout-top-nav">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <span class="brand-text font-weight-light">Salle du sport</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{route('membre.index')}}" class="nav-link">Membres</a>
          </li>

          <li class="nav-item">
            <a href="{{route('abonnement.index')}}" class="nav-link">Abonnement</a>
          </li>
          <li class="nav-item">
            <a href="{{route('inscription.index')}}" class="nav-link">Inscriptions</a>
          </li>
          <li class="nav-item">
            <a href="{{route('abonnement.index')}}" class="nav-link">Paramètres</a>
          </li>

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">Contact</a>
          </li> -->
        </ul>

        <!-- SEARCH FORM -->
      </div>

      <!-- Right navbar links -->

    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <div id='calendar'></div>
                </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io"></a>.</strong> 
  </footer>
</div>


<div id="fullCalModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Ajouter Crénau
                    </div>

                    <div class="modal-body">
                        
                        <!-- content goes here -->
                        <form method="post" action="http://elitesoccer-dz.com/reservation/create" >
                            <input type="hidden" name="_token" value="EYGIJvztmICgfRWJIitdlfBWLwZs6UsQSWIinlIr">                            <input type="hidden" readonly class="form-control" name="stade" value="1" placeholder="Enter email">

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
                        
                        </form>

                    </div>
                </div>
            </div>
        </div>


</body>
</html>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/fullcalendar.min.js')}}"></script>

<script>

! function($) {




var CalendarApp = function() {
    this.$body = $("body")
    this.$calendar = $('#calendar'),
    this.$event = ('#calendar-events div.calendar-events'),
    this.$categoryForm = $('#add-new-event form'),
    this.$extEvents = $('#calendar-events'),
    this.$saveCategoryBtn = $('.save-category'),
    this.$calendarObj = null
};


/* on drop */
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
        var beofreoneweek = new Date(Date.now() + 604800000);
        var event,evt;
        var today = new Date();
        var prevweek = new Date(today.getFullYear(), today.getMonth(), today.getDate()-7);
        console.log(beofreoneweek)
        

        
        
        var evts = <?php echo json_encode($presences); ?>
        //[{"id":53,"created_at":"2021-03-16 11:09:05","updated_at":"2021-03-16 11:09:05","fullname":"salhi haider","phone":"0551515151","stade":"1","prix":"6000","crenau":"14","date":"2021-03-30","state":"0","abonnement":"9"},{"id":52,"created_at":"2021-03-16 11:09:05","updated_at":"2021-03-16 11:09:05","fullname":"salhi haider","phone":"0551515151","stade":"1","prix":"6000","crenau":"14","date":"2021-03-23","state":"0","abonnement":"9"},{"id":51,"created_at":"2021-03-16 11:09:05","updated_at":"2021-03-16 11:09:05","fullname":"salhi haider","phone":"0551515151","stade":"1","prix":"6000","crenau":"14","date":"2021-03-16","state":"0","abonnement":"9"},{"id":58,"created_at":"2021-03-16 11:09:05","updated_at":"2021-03-16 11:09:05","fullname":"salhi haider","phone":"0551515151","stade":"1","prix":"6000","crenau":"14","date":"2021-05-04","state":"0","abonnement":"9"},{"id":55,"created_at":"2021-03-16 11:09:05","updated_at":"2021-03-16 11:09:05","fullname":"salhi haider","phone":"0551515151","stade":"1","prix":"6000","crenau":"14","date":"2021-04-13","state":"0","abonnement":"9"},{"id":54,"created_at":"2021-03-16 11:09:05","updated_at":"2021-03-16 11:09:05","fullname":"salhi haider","phone":"0551515151","stade":"1","prix":"6000","crenau":"14","date":"2021-04-06","state":"0","abonnement":"9"},{"id":29,"created_at":"2021-02-24 16:45:49","updated_at":"2021-02-24 16:45:49","fullname":"merounae","phone":"3456789","stade":"1","prix":"6000","crenau":"9","date":"2021-03-04","state":"0","abonnement":null},{"id":30,"created_at":"2021-02-24 16:46:10","updated_at":"2021-02-24 16:46:10","fullname":"uta","phone":"890","stade":"1","prix":"6000","crenau":"10","date":"2021-03-04","state":"0","abonnement":null},{"id":56,"created_at":"2021-03-16 11:09:05","updated_at":"2021-03-16 11:09:05","fullname":"salhi haider","phone":"0551515151","stade":"1","prix":"6000","crenau":"14","date":"2021-04-20","state":"0","abonnement":"9"},{"id":57,"created_at":"2021-03-16 11:09:05","updated_at":"2021-03-16 11:09:05","fullname":"salhi haider","phone":"0551515151","stade":"1","prix":"6000","crenau":"14","date":"2021-04-27","state":"0","abonnement":"9"}];
        for(evt of evts){
            var dc= evt['crenau']
            var fc= parseInt(evt['crenau'])+1         
            var color = "bg-danger";       
            dc = parseInt(dc)
            if(evt['abonnement']){
                color = "bg-warning";
            }
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
                title: evt["fullname"],
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
            defaultView: 'agendaWeek',
            defaultDate: prevweek,
            handleWindowResize: true,
            header: {
                left: 'prev,next today',
                right: 'agendaWeek,agendaDay'
            },
            titleFormat: '2021',
            allDaySlot: false,
            locale: 'fr', // the initial locale. of not specified, uses the first one
            events: defaultEvents,
            droppable: true, 
            eventLimit: true, 
            selectable: true,
            eventRender: function (event, element) {
                element.find('.fc-title').html(event.title);/*For Month,Day and Week Views*/
                element.find('.fc-list-item-title').html(event.title);/*For List view*/
            },                
            drop: function(date) { $this.onDrop($(this), date); },
            select: function(start, end, allDay) { 
                console.log("calEvent")

            },
            eventClick: function(calEvent, jsEvent, view) { 
                console.log("calEvent")
            }
        });
    },
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp
}(window.jQuery),

//initializing CalendarApp
$(window).on('load', function() {
    $.CalendarApp.init()
    $("#calendar").fullCalendar("rerenderEvents");
$("body button.fc-today-button").trigger('click');   

});

</script>
