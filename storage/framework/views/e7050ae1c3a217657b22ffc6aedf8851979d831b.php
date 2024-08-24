 

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
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestion Salle du sport</title>

<!-- Google Font: Source Sans Pro -->
<!--   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
<link href="<?php echo e(asset('fonts/css3.css')); ?>" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/fontawesome-free/css/all.min.css')); ?>">
  <link href="<?php echo e(asset('adminlte/plugins/toastr/toastr.css')); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/adminlte.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/ares.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/select2.min.css')); ?>">
  <link href="<?php echo e(asset('css/sweetalert.css')); ?>" rel="stylesheet" />

  <style>
    table.dataTable td {
      font-size: 30px;
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
  <?php echo $__env->yieldContent('styles'); ?>
</head>

<body class="hold-transition layout-navbar-fixed">


    <div id="global-loader">
      <img src="<?php echo e(asset('img/gymA.svg')); ?>" class="loader-img" width="150px" alt="Loader">
    </div>

<div class="wrapper" id="all-body">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light">
    <div class="container"> 


      <a href="/home" class="navbar-brand">        
          <img src="<?php echo e(asset('img/gymA.svg')); ?>" class="logo logo-display" alt="">
      </a>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?php echo e(route('membre.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-user"></i>
            <?php echo e(trans('main.membres')); ?>

            </a>
          </li>
          <?php if(Auth::user()->isadmin == 1): ?>

          <li class="nav-item">
            <a href="<?php echo e(route('abonnement.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-calendar"></i>
              
              Tarifs
              </a>
          </li>

          <?php endif; ?>
          <li class="nav-item dropdown">
            <a style="font-size:20px" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <i class="fas fa-cart-arrow-down" style="font-size: 15px;"> </i>
            Stock
          </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                  <?php if(Auth::user()->isadmin == 1): ?>

              <li><a href="<?php echo e(route('produit.index')); ?>" class="dropdown-item">Produits </a></li>
              <li><a href="<?php echo e(route('commande.index')); ?>" class="dropdown-item">Commandes </a></li>
                          <?php endif; ?>
              <li><a href="<?php echo e(route('produit.pos')); ?>" class="dropdown-item">POS </a></li>
            </ul>
          </li>


          <!-- <li class="nav-item">
            <a href="<?php echo e(route('crenau.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-bicycle"></i>
            Planing
            </a>
          </li> -->
          <?php if(Auth::user()->isadmin == 1): ?>

          <li class="nav-item dropdown">
            <a style="font-size:20px" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <?php echo e(trans('main.rapport')); ?>


          </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <li><a href="<?php echo e(route('stats')); ?>" class="dropdown-item"><?php echo e(trans('main.statistique')); ?> </a></li>
            <li><a href="<?php echo e(route('versement.index')); ?>" class="dropdown-item">Versement </a></li>
            <li><a href="<?php echo e(route('inscription.index')); ?>" class="dropdown-item"><?php echo e(trans('main.rapport_inscriptions')); ?> </a></li>
            <li><a href="<?php echo e(route('presence.index')); ?>" class="dropdown-item">Rapport Présence </a></li>
            <li><a href="<?php echo e(route('libres')); ?>" class="dropdown-item"> <?php echo e(trans('main.rapport_seance_libre')); ?>  </a></li>
            <li><a href="<?php echo e(route('assurances')); ?>" class="dropdown-item"><?php echo e(trans('main.rapport_assurance')); ?> </a></li>
            <li><a href="<?php echo e(route('decharge.index')); ?>" class="dropdown-item"><?php echo e(trans('main.charges')); ?>  </a></li>
            <li><a href="<?php echo e(route('inscription.excel')); ?>" class="dropdown-item"> Excel   </a></li>
            <li><a href="<?php echo e(route('puces')); ?>" class="dropdown-item"> Rapport Puces</a></li>
            <li><a href="<?php echo e(route('setting.index')); ?>" class="dropdown-item">Paramètres </a></li>

            <!-- <li><a href="<?php echo e(route('setting.index')); ?>" class="dropdown-item">Paramètres </a></li> -->




              <!-- Level two dropdown-->
             
              <!-- End Level two -->
            </ul>
          </li>

          <!-- <li class="nav-item">
            <a href="<?php echo e(route('setting.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-checkout"></i>
            
            <?php echo e(trans('main.paramètres')); ?>

            
            </a>
          </li> -->
          
          <li class="nav-item dropdown">
            <a style="font-size:20px" id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <i class="  fas fa-user-shield" > </i>
            Stafs
          </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="<?php echo e(route('user.index')); ?>" class="dropdown-item">Utilisateurs </a></li>
                <!-- <li><a href="<?php echo e(route('user.coachs')); ?>" class="dropdown-item">Coachs </a></li> -->
            </ul>
          </li>
          <?php endif; ?>
          <?php if(Auth::user()->isadmin == 2): ?>
          <li class="nav-item">
            <a href="<?php echo e(route('mon.rapport',['user'=>Auth::user()->id])); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-list"></i>
            Mon Rapport
            </a>
          </li>

          <?php endif; ?>



          <li class="nav-item">
            <a
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                             href="<?php echo e(route('logout')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-sliders"></i>
                               
 <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                                Déconnexion
            </a>
          </li>




          <!-- <li class="nav-item">
            <a href="<?php echo e(route('setting.index')); ?>" class="nav-link" style="font-size:20px">
            <i class="fa fa-sliders"></i>
            Paramètres
            </a>
          </li> -->
        </ul>


      </div>
      
    </div>
    <?php if(Setting::getSetting('nbrtourniquet')==1): ?>
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

    <?php endif; ?> 
    <?php if(Setting::getSetting('nbrtourniquet')==2): ?>
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


    <?php endif; ?> 



    <div class="col-md-2">
        <input class="form-control" id="input_id" placeholder="<?php echo e(trans('main.scanner')); ?>" autofocus/>
      </div>    
  </nav>

  <div class="content-wrapper" >
    <?php echo $__env->yieldContent('header'); ?>
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <?php echo $__env->yieldContent('content'); ?>
          </div>
        </div>
      </div>
    </div>
    
  </div>  
</div>
<!-- ./wrapper -->

<script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>

<script src="<?php echo e(asset('adminlte/plugins/toastr/toastr.min.js')); ?>"></script>

<?php echo $__env->yieldContent('scripts'); ?>
<?php echo $__env->yieldContent('modals'); ?>


<script>
$(window).on("load",function(){
  var envurl = <?php echo json_encode(Setting::getSetting('lien')); ?>         
  var addres = <?php echo json_encode($adress); ?>;
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
          let matricules = <?php echo json_encode(Config::get('matricules')); ?>;
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
            <?php if(Setting::getSetting('minus')==1): ?>
            window.location.href = envurl+':8000/membre/compte/'+number;
            <?php else: ?>
            window.location.href = envurl+':8000/membre/edit/'+number;
            <?php endif; ?>
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


// on load abda diiiir kolch


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

var profile = 0;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var host = window.location.host;
        var host = <?php echo json_encode(url('/')); ?>         
        var u = window.location.href   

        

        



        <?php if(session('success')): ?>
            $(function(){
                toastr.success('<?php echo e(Session::get("success")); ?>')
            })
        <?php endif; ?>
        <?php if($errors->any()): ?>
            $(function(){
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        toastr.error('<?php echo e($error); ?>')
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            })
        <?php endif; ?>
        <?php if(session('error')): ?>
            $(function(){
                toastr.error('<?php echo e(Session::get("error")); ?>')
            })
        <?php endif; ?>


        



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

</body>
</html>
