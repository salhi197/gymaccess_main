
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('mart/assets/images/favicon.png')}}">
    <title>Adminmart Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="{{asset('mart/assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('mart/assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('mart/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{asset('mart/dist/css/style.min.css')}}" rel="stylesheet">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <div class="navbar-brand">
                        <a href="index.html">
                            <b class="logo-icon">
                                <img src="{{asset('mart/assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                                <img src="{{asset('mart/assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" />
                            </b>
                            <span class="logo-text">
                                <img src="{{asset('mart/assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                                <img src="{{asset('mart/assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" />
                            </span>
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                                id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge badge-primary notify-no rounded-circle">5</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="navbar-nav float-right">
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form>
                                    <div class="customize-input">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                            type="search" placeholder="Search" aria-label="Search">
                                        <i class="form-control-icon" data-feather="search"></i>
                                    </div>
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">

            <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white hidden-xs" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{asset('img/lsrapide.jpg')}}" alt="...">
          <h3>
            
                </h3>

        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            @auth('admin')
            <li class="nav-item">
              <a class="nav-link active" href="{{route('coliers')}}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Arrivé</span>
              </a>
            </li>



            <li class="nav-item">
              <a class="nav-link" href="{{route('commande.index')}}">
                <i class="ni ni-box-2 text-orange"></i>
                <span class="nav-link-text">Colis</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link button" data-toggle="modal" data-target="#livreurModal">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Affiche Livreur</span>
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link button" data-toggle="modal" data-target="#journal">
                <i class="ni ni-align-left-2 text-red"></i>
                <span class="nav-link-text">Journal</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('commande.retour.list.ls')}}">
                <i class="ni ni-box-2 text-orange"></i>
                <span class="nav-link-text">Retour</span>
              </a>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="ni ni-pin-3 text-primary"></i>
                <span class="nav-link-text">Utilisateur</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('livreur.index')}}">Livreur</a>
                    <a class="dropdown-item" href="{{route('fournisseur.index')}}">Fournisseur</a>
                    <a class="dropdown-item" href="{{route('admin.index')}}">Personnel</a>
                    
                </div>
            </li>




            <li class="nav-item">
              <a class="nav-link" href="{{route('wilaya.fournisseurs')}}">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">T.Fournisseur</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('wilaya.livreurs')}}">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">T.Livreur</span>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a class="nav-link" href="{{route('wilaya.aboutis')}}">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">T.Non Abouti</span>
              </a>
            </li> -->

            <li class="nav-item">
              <a class="nav-link" href="{{route('stock.index')}}">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Stock</span>
              </a>
            </li>
        @endif   
        @auth('livreur')
            <?php 
                $livreur =$livreur = Auth::guard('livreur')->user();
            ?>
            <li class="nav-item">
              <a class="nav-link active" href="/home">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Tableau de bord</span>
              </a>
            </li>

            <li class="nav-item ">
            <a class="nav-link active" href="/home">
                <i class="ni ni-bullet-list-67 text-primary"></i>
                <span class="nav-link-text">Mes Coliers</span>
              </a>
            </li>

            <li class="nav-item ">
                <a class="nav-link" href="#">
                <i class="ni ni-circle-08 text-pink"></i>
                <span>Historique </span>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{route('livreur.journal',['livreur'=>$livreur->id])}}">
                    <i class="ni ni-circle-08 text-info"></i>
                    <span>Journal </span>
                </a>
            </li>


          @endif


      @auth('fournisseur')
          <?php 
                $fournisseur = Auth::guard('fournisseur')->user();
            ?>
            <li class="nav-item">
              <a class="nav-link active" href="/home">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Mes Colis   </span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('produit.index')}}">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Produits</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('fournisseur.journal',['fournisseur'=>$fournisseur->id])}}">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Mon Journal</span>
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="{{route('fournisseur.stock')}}">
                <i class="ni ni-circle-08 text-pink"></i>
                <span class="nav-link-text">Stock</span>
              </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{route('wilaya.fournisseurs')}}">
                <i class="ni ni-key-25 text-info"></i>
                <span class="nav-link-text">T.Fournisseur</span>
              </a>
            </li>

      @endif


      <li class="nav-item active">
          <a class="nav-link" href="{{ route('logout') }}" 
            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="fa fa-door-open"></i>
          <span>déconnexion</span> 
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
      </li>

          </ul>
          <!-- Divider -->
          <hr class="my-3">
        </div>
      </div>
    </div>
  </nav>



            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Good Morning Jason!</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                @yield('content')
            </div>
            <footer class="footer text-center text-muted">
                All Rights Reserved by Adminmart. Designed and Developed by <a
                    href="https://wrappixel.com">WrapPixel</a>.
            </footer>
        </div>
        <div class="modal fade" id="livreurModal" tabindex="-1" role="dialog" aria-labelledby="livreurModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="livreurModalLabel">Séléctionner Livreur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Livreur: </label>
                    <select class="form-control affiche_livreurs js-example-basic-single" size="5"  name="livreur">
                        <option value="">{{ __('Séléctionner ...') }}</option>
                        @foreach ($_livreurs as $livreur)
                            <option value="{{$livreur->id}}" >
                            {{$livreur->name ?? ''}} {{$livreur->prenom ?? ''}} 
                            </option>

                        @endforeach

                    </select>
            </div>
            <a href="#" id="filter_livreur" class="btn btn-primary">Filtrer</a>
      </div>
    </div>
  </div>
</div>

        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

        <div class="modal fade" id="journal" tabindex="-1" role="dialog" aria-labelledby="journalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="journalLabel">Journal : </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            @csrf
            <div class="form-group">
                    <a  href="{{route('journal.livreur')}}" class="btn-icon-clipboard">
                            <i class="ni ni-badge"></i>
                            <span>Livreur</span>
                    </a>


                    <a  href="{{route('journal.fournisseur')}}" class="btn-icon-clipboard">
                            <i class="ni ni-badge"></i>
                            <span>Fournisseur</span>
                    </a>

                    <a  href="{{route('journal.personnel')}}" class="btn-icon-clipboard">
                            <i class="ni ni-badge"></i>
                            <span>personnel</span>
                    </a>


                    <a  href="{{route('journal.ls')}}" class="btn-icon-clipboard">
                            <i class="ni ni-badge"></i>
                            <span>Ls Rapide</span>
                    </a>

            </div>
      </div>
    </div>
  </div>
</div>

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('mart/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('mart/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('mart/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="{{asset('mart/dist/js/app-style-switcher.js')}}"></script>
    <script src="{{asset('mart/dist/js/feather.min.js')}}"></script>
    <script src="{{asset('mart/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('mart/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('mart/dist/js/custom.min.js')}}"></script>
    <script src="{{asset('js/dynamic-form.js')}}"></script>

    <script src="{{asset('js/toastr.min.js')}}"></script>

    <!--This page JavaScript -->
    <script src="{{asset('mart/assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('mart/assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{asset('mart/assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('mart/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('mart/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('mart/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('mart/dist/js/pages/dashboards/dashboard1.min.js')}}"></script>
    <script src="{{asset('js/datatables-demo.js')}}"></script>
    <script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
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

$('.affiche_livreurs').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    var lien = "/livreur/filter/"+valueSelected;
    $('#filter_livreur').attr('href',lien)
});

// setInterval(function(){

//   $('#ad-modal').modal('show');
// }, 30000); //This value is represented in mili seconds.


</script>

  @yield('scripts')

</body>

</html>