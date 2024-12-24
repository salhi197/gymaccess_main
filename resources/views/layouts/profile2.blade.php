 
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
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <link href="{{asset('adminlte/plugins/toastr/toastr.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.css')}}">
  <link rel="stylesheet" href="{{asset('css/ares.css')}}">
  @yield('styles')
</head>

<body class="hold-transition layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <!-- Content Header (Page header) -->
    @yield('header')
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            @yield('content')
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- footer -->
<footer class="bg-dark text-center text-white footerbg">
  <!-- Grid container -->
  <div class="container p-4 pb-0">
    <!-- Section: Social media -->
    <section class="mb-4">
      <!-- Facebook -->
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    
  </div>
  <!-- Copyright -->
</footer>   
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/toastr/toastr.min.js')}}"></script>

@yield('scripts')
@yield('modals')


<script>
$(window).on("load",function(){
  $(".loader-wrapper").fadeOut("slow");
});
      var profile = 0;
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          var host = {!! json_encode(url('/')) !!}         
          console.log(host)   
          console.log("host2")
          setInterval(function(){         
            myObject = {}; 
            $.get('/logs3.txt', function(myContentFile) {
                var lines = myContentFile.split("\r\n");
                console.log(lines)
                for(var i  in lines){
                  if(lines[i] != '0'){                    
                    $.ajax({  
                      type: 'POST',
                      data: {line: lines[i], _token: CSRF_TOKEN},
                      dataType: 'JSON', 
                      url: "/write3",
                        success: function(success){
                        console.log("success")
                          var str = lines[i];//.substring(0, lines[i].length-2);

                          if(str.length>0){
                              window.location.replace("http://192.168.0.4:8081/membre/membre/"+str);
                              console.log("------------"+str)                            
                          }                      },
                      error:function(err){
                        console.log(err)
                      }
                    });
                  }
                  console.log("line : " + i + " :" + lines[i]);
                }
            }, 'text');
          }, 500);
          

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
