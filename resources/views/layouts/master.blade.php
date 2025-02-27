 

<?php 
$adress = $_SERVER['REMOTE_ADDR'];
use App\Setting;
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion Salle du sport</title>

<!-- Google Font: Source Sans Pro -->
<!--   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
<link href="{{asset('fonts/css3.css')}}" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <link href="{{asset('adminlte/plugins/toastr/toastr.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('css/ares.css')}}">
  <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
  <link href="{{asset('css/sweetalert.css')}}" rel="stylesheet" />

  <style>
    table.dataTable td {
      font-size: 30px;
    }

        canvas {
            background-color: #ffffff; /* White background for the charts */
        }





#global-loader {
    position: fixed;
    z-index: 50000;
    background: #fff;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    height: 100%;
    width: 100%;
    margin: 0 auto;
    overflow: hidden;
}

.loader-img {
    position: absolute;
    left: 0;
    right: 0;
    text-align: center;
    top: 45%;
    margin: 0 auto;
}

  </style>
  @yield('styles')
</head>

<body class="hold-transition layout-navbar-fixed">


    <div id="global-loader">
      <img src="{{asset('img/gymA.svg')}}" class="loader-img" width="150px" alt="Loader">
    </div>

<div class="wrapper" id="all-body">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light">
    <div class="container"> 


      <a href="/home" class="navbar-brand">        
          <img src="{{asset('img/gymA.svg')}}" class="logo logo-display" alt="">
      </a>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{route('membre.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-user"></i>
            {{trans('main.membres')}}
            </a>
          </li>
          @if(Auth::user()->isadmin == 1)

          <li class="nav-item">
            <a href="{{route('abonnement.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-calendar"></i>
              
              Tarifs
              </a>
          </li>

          @endif
          <li class="nav-item dropdown">
            <a style="font-size:20px" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <i class="fas fa-cart-arrow-down" style="font-size: 15px;"> </i>
            Stock
          </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  @if(Auth::user()->isadmin == 1)

              <li><a href="{{route('produit.index')}}" class="dropdown-item">Produits </a></li>
              <li><a href="{{route('commande.index')}}" class="dropdown-item">Commandes </a></li>
                          @endif
              <li><a href="{{route('produit.pos')}}" class="dropdown-item">POS </a></li>
            </ul>
          </li>


          <!-- <li class="nav-item">
            <a href="{{route('crenau.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-bicycle"></i>
            Planing
            </a>
          </li> -->
          @if(Auth::user()->isadmin == 1)

          <li class="nav-item dropdown">
            <a style="font-size:20px" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            {{trans('main.rapport')}}

          </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="{{route('stats')}}" class="dropdown-item">{{trans('main.statistique')}} </a></li>
            <li><a href="{{route('versement.index')}}" class="dropdown-item">Versement </a></li>
            <li><a href="{{route('inscription.index')}}" class="dropdown-item">{{trans('main.rapport_inscriptions')}} </a></li>
            <li><a href="{{route('presence.index')}}" class="dropdown-item">Rapport Présence </a></li>
            <li><a href="{{route('libres')}}" class="dropdown-item"> {{trans('main.rapport_seance_libre')}}  </a></li>
            <li><a href="{{route('assurances')}}" class="dropdown-item">{{trans('main.rapport_assurance')}} </a></li>
            <li><a href="{{route('decharge.index')}}" class="dropdown-item">{{trans('main.charges')}}  </a></li>
            <li><a href="{{route('inscription.excel')}}" class="dropdown-item"> Excel   </a></li>
            <li><a href="{{route('puces')}}" class="dropdown-item"> Rapport Puces</a></li>
            <li><a href="{{route('setting.index')}}" class="dropdown-item">Paramètres </a></li>

            <!-- <li><a href="{{route('setting.index')}}" class="dropdown-item">Paramètres </a></li> -->




              <!-- Level two dropdown-->
             
              <!-- End Level two -->
            </ul>
          </li>

          <!-- <li class="nav-item">
            <a href="{{route('setting.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-checkout"></i>
            
            {{trans('main.paramètres')}}
            
            </a>
          </li> -->
          
          <li class="nav-item dropdown">
            <a style="font-size:20px" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <i class="  fas fa-user-shield" > </i>
            Stafs
          </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="{{route('user.index')}}" class="dropdown-item">Utilisateurs </a></li>
                <!-- <li><a href="{{route('user.coachs')}}" class="dropdown-item">Coachs </a></li> -->
            </ul>
          </li>
          @endif
          @if(Auth::user()->isadmin == 2)
          <li class="nav-item">
            <a href="{{route('mon.rapport',['user'=>Auth::user()->id])}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-list"></i>
            Mon Rapport
            </a>
          </li>

          @endif



          <li class="nav-item">
            <a
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                             href="{{ route('logout') }}" class="nav-link" style="font-size:20px">
            <i class="fa fa-sliders"></i>
                               
 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                Déconnexion
            </a>
          </li>




          <!-- <li class="nav-item">
            <a href="{{route('setting.index')}}" class="nav-link" style="font-size:20px">
            <i class="fa fa-sliders"></i>
            Paramètres
            </a>
          </li> -->
        </ul>


      </div>
      
    </div>
    @if(Setting::getSetting('nbrtourniquet')==1)
    <div class="col-md-1">
        <span id="btnopen1" style="cursor: pointer" class="btn btn-success">
          <i class="fa fa-door-open"></i> Ouvrir 
        </span>
      </div>   

      <div class="col-md-1">
        <span id="btnclose1" style="cursor: pointer" class="btn btn-danger">
          <i class="fa fa-door-open"></i> Sorite 
        </span>
      </div>   

    @endif 
    @if(Setting::getSetting('nbrtourniquet')==2)
    <div class="col-md-1">
        <span id="btnopen1" style="cursor: pointer" class="btn btn-success">
          <i class="fa fa-door-open"></i> Ouvrir 1
        </span>
        <span id="btnclose1" style="cursor: pointer" class="btn btn-danger">
          <i class="fa fa-door-open"></i> Sortie 1
        </span>

      </div>   
      <div class="col-md-1">
        <span id="btnopen2" style="cursor: pointer" class="btn btn-success">
          <i class="fa fa-door-open"></i> Ouvrir 2
        </span>
        <span id="btnclose2" style="cursor: pointer" class="btn btn-danger">
          <i class="fa fa-door-open"></i> Sortie 2
        </span>

      </div>   

      <div class="col-md-1">
        <span id="btnopen3" style="cursor: pointer" class="btn btn-success">
          <i class="fa fa-door-open"></i> Ouvrir 3
        </span>
        <span id="btnclose3" style="cursor: pointer" class="btn btn-danger">
          <i class="fa fa-door-open"></i> Sortie 3
        </span>

      </div>   


    @endif 



    <div class="col-md-2">
        <input class="form-control" id="input_id" placeholder="{{trans('main.scanner')}}" autofocus/>
      </div>    
  </nav>

  <div class="content-wrapper" >
    @yield('header')
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
    
  </div>  
</div>
<!-- ./wrapper -->

<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/select2.min.js')}}"></script>

<script src="{{asset('adminlte/plugins/toastr/toastr.min.js')}}"></script>

@yield('scripts')
@yield('modals')



<script>
        const output = document.getElementById('command-output');

        // Initialize the Speech Recognition API
        const recognition = new (window.SpeechRecognition || window.webkitSpeechRecognition)();
        recognition.lang = 'fr-FR'; // Set the language to French
        recognition.interimResults = false; // Show only final results (not interim)

        // This event is fired when the recognition system gets a result
        recognition.onresult = function (event) {
            const command = event.results[0][0].transcript.toLowerCase(); // Get the voice command
            output.textContent = `You said: ${command}`; // Display the command

            // Handle the command
            handleVoiceCommand(command);
        };

        // This event is fired when the recognition system encounters an error
        recognition.onerror = function (event) {
            console.error('Speech recognition error:', event);
            output.textContent = "Sorry, I couldn't understand that. Please try again.";
        };

        // Automatically start listening when the page loads
        recognition.start();

        // Function to handle voice commands
        function handleVoiceCommand(command) {
            switch (command) {
                case 'open':
                    fetch('/open', {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        output.textContent = 'Open command processed.';
                        console.log(data);
                    })
                    .catch(error => {
                        output.textContent = "Sorry, there was an error with the open command.";
                        console.error(error);
                    });
                    break;

                case 'close':
                    fetch('/close', {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        output.textContent = 'Close command processed.';
                        console.log(data);
                    })
                    .catch(error => {
                        output.textContent = "Sorry, there was an error with the close command.";
                        console.error(error);
                    });
                    break;

                case 'liste membres':
                    window.location.href = '/membre';
                    break;

                case 'ajouter membre':
                    window.location.href = '/membre/create';
                    break;

                case 'vider la liste':
                    window.location.href = '/clear';
                    break;

                default:
                    output.textContent = "Command not recognized. Please try again.";
                    break;
            }
        }
    </script>

<script>
$(window).on("load",function(){
  var envurl = {!! json_encode(Setting::getSetting('lien')) !!}         
  var addres = {!! json_encode($adress) !!};
  toastr.options.timeOut = 20
  $('.js-example-basic-single').select2({
    'width':"100%",
    dropdownCssClass:'increasezindex'

  });
  $("#global-loader").fadeOut("slow");
  $('#input_id').on('change',function(){
      console.log('saz')
      if($('#input_id').val().length >0){
          let number = parseInt($('#input_id').val(), 10);
          let matricules = {!! json_encode(Config::get('matricules')) !!};
          //console.log(matricules);
          var res = false;
          matricules.map(function (matricule) {
              res = res || matricule.matricule == number;
          });          
          console.log(res)
          if(res==false){
            toastr.error('Carte Non valide')
            $('#input_id').val("")
          }else{
            @if(Setting::getSetting('minus')==1)
            window.location.href = envurl+':8000/membre/compte/'+number;
            @else
            window.location.href = envurl+':8000/membre/edit/'+number;
            @endif
          }
      }
  });



  $(window).keydown(function(event){
    if(event.keyCode == 113) {
      fetch('http://192.168.0.177/open',{
            method:'GET',
            headers:{
              'Content-type':'application/json',
              'Accept':'application/json',
              'url':'http://192.168.0.177/open',
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
            }
          }).then(()=>{

          })
          .catch((err)=>{
            fetch('http://192.168.0.4:8000/api/ouverture',{
                  method:'POST',
                  headers:{
                    'Content-type':'application/json',
                    'Accept':'application/json',
                    'url':'http://192.168.0.177/open',
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
                  }
                }).then(()=>{
                  $('#nbrouv').html(parseInt($('#nbrouv').html())+1)

                })
                .catch((err)=>{
                })

          })

    }
  })

        $('#btnopen3').on('click',function(){
          fetch('http://192.168.0.179/open',{
            method:'GET',
            headers:{
              'Content-type':'application/json',
              'Accept':'application/json',
              'url':'http://192.168.0.179/open',
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
            }
          }).then(()=>{
          })
          .catch((err)=>{
            fetch('http://192.168.0.4:8000/api/ouverture',{
                  method:'POST',
                  headers:{
                    'Content-type':'application/json',
                    'Accept':'application/json',
                    'url':'http://192.168.0.179/open',
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
                  }
                }).then(()=>{
                  $('#nbrouv').html(parseInt($('#nbrouv').html())+1)
                })
                .catch((err)=>{
                })

          })
        })


        $('#btnclose3').on('click',function(){
          fetch('http://192.168.0.179/close',{
            method:'GET',
            headers:{
              'Content-type':'application/json',
              'Accept':'application/json',
              'url':'http://192.168.0.179/close',
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
            }
          }).then(()=>{
          })
          .catch((err)=>{

          })
        })



        $('#btnopen1').on('click',function(){
          fetch('http://192.168.0.177/open',{
            method:'GET',
            headers:{
              'Content-type':'application/json',
              'Accept':'application/json',
              'url':'http://192.168.0.177/open',
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
            }
          }).then(()=>{
          })
          .catch((err)=>{
            fetch('http://192.168.0.4:8000/api/ouverture',{
                  method:'POST',
                  headers:{
                    'Content-type':'application/json',
                    'Accept':'application/json',
                    'url':'http://192.168.0.177/open',
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
                  }
                }).then(()=>{
                  $('#nbrouv').html(parseInt($('#nbrouv').html())+1)
                })
                .catch((err)=>{
                })

          })
        })


        $('#btnclose1').on('click',function(){
          fetch('http://192.168.0.177/close',{
            method:'GET',
            headers:{
              'Content-type':'application/json',
              'Accept':'application/json',
              'url':'http://192.168.0.177/close',
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
            }
          }).then(()=>{
          })
          .catch((err)=>{

          })
        })



        $('#btnopen2').on('click',function(){
          fetch('http://192.168.0.178/open',{
            method:'GET',
            headers:{
              'Content-type':'application/json',
              'Accept':'application/json',
              'url':'http://192.168.0.178/open',
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
            }
          }).then(()=>{
          })
          .catch((err)=>{
          })
        })

        
        $('#btnclose2').on('click',function(){
          fetch('http://192.168.0.178/close',{
            method:'GET',
            headers:{
              'Content-type':'application/json',
              'Accept':'application/json',
              'url':'http://192.168.0.178/close',
              'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content') 
            }
          }).then(()=>{
          })
          .catch((err)=>{

          })
        })
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var host = window.location.host;
        var host = {!! json_encode(url('/')) !!}         
        var u = window.location.href   

        @if(session('success'))
            $(function(){
                toastr.success('{{Session::get("success")}}')
            })
        @endif
        @if ($errors->any())
            $(function(){
                @foreach ($errors->all() as $error)
                        toastr.error('{{$error}}')
                @endforeach
            })
        @endif
        @if(session('error'))
            $(function(){
                toastr.error('{{Session::get("error")}}')
            })
        @endif

});

        


</script>
<script type="text/javascript">
var animateButton = function(e) {
  e.preventDefault;
  //reset animation
  e.target.classList.remove('animate');
  
  e.target.classList.add('animate');
  setTimeout(function(){
    e.target.classList.remove('animate');
  },700);
};

var bubblyButtons = document.getElementsByClassName("bubbly-button");

for (var i = 0; i < bubblyButtons.length; i++) {
  bubblyButtons[i].addEventListener('click', animateButton, false);
}
</script>
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/6767278f49e2fd8dfefba3a2/1iflf52kk';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
</script>


</body>
</html>
