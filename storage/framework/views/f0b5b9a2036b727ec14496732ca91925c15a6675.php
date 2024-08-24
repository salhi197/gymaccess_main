 
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
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/fontawesome-free/css/all.min.css')); ?>">
  <link href="<?php echo e(asset('adminlte/plugins/toastr/toastr.css')); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/adminlte.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('css/ares.css')); ?>">
  <?php echo $__env->yieldContent('styles'); ?>
</head>

<body class="hold-transition layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <!-- Content Header (Page header) -->
    <?php echo $__env->yieldContent('header'); ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <?php echo $__env->yieldContent('content'); ?>
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

<script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/dist/js/adminlte.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/toastr/toastr.min.js')); ?>"></script>

<?php echo $__env->yieldContent('scripts'); ?>
<?php echo $__env->yieldContent('modals'); ?>


<script>
$(window).on("load",function(){
  $(".loader-wrapper").fadeOut("slow");
});
      var profile = 0;
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          var host = <?php echo json_encode(url('/')); ?>         
          console.log(host)   
          console.log("host2")
          setInterval(function(){         
            myObject = {}; 
            $.get('/logs2.txt', function(myContentFile) {
                var lines = myContentFile.split("\r\n");
                // console.log(lines)
                for(var i  in lines){
                  if(lines[i] != '0'){                    
                    $.ajax({  
                      type: 'POST',
                      data: {line: lines[i], _token: CSRF_TOKEN},
                      dataType: 'JSON', 
                      url: "/write2",
                        success: function(success){
                        console.log("success")
                          var str = lines[i];
                          if(str.length>0){
                            var lastletter = str.slice(-1);
                            console.log(lastletter,str.substr(0,str.length-1));
                              if(lastletter=="d"){
                                console.log("deja");
                                window.location.replace("http://192.168.0.4:8000/membre/deja/"+str.substr(0,str.length-1));
                              }else{
                                window.location.replace("http://192.168.0.4:8000/membre/membre/"+str);                                
                              }
                              console.log("------------"+str)                            
                          }
                        },
                      error:function(err){
                        console.log(err)
                      }
                    });
                  }
                  console.log("line : " + i + " :" + lines[i]);
                }
            }, 'text');
          }, 500);
          

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
