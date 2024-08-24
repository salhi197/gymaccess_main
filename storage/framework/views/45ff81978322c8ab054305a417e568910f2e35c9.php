<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gym Access   </title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/fontawesome-free/css/all.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('adminlte/dist/css/adminlte.min.css?v=3.2.0')); ?>">
    <link href="<?php echo e(asset('adminlte/plugins/toastr/toastr.css')); ?>" rel="stylesheet" />

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html">
                <img src="<?php echo e(asset('img/gymA.svg')); ?>" class="logo logo-display" alt="">            
            </a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Saisir les données Pour Authentifier</p>
                <form action="/login" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="input-group mb-3">
                        <input type="text" name="email" class="form-control" placeholder="Login">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Mot de Passe">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                        </div>

                    </div>
                </form>

            </div>

        </div>
    </div>


    <script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>

    <script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <script src="<?php echo e(asset('adminlte/dist/js/adminlte.min.js?v=3.2.0')); ?>"></script>
    <script src="<?php echo e(asset('adminlte/plugins/toastr/toastr.min.js')); ?>"></script>
    <script>
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

</body>

</html>
