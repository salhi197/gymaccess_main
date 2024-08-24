<?php $__env->startSection('header'); ?>
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des Comtpes :  </h1>
          </div><!-- /.col -->          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



    <div class="content-header">    
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-4">
              
          <button type="button" class="btn  bubbly-button" data-toggle="modal" data-target="#exampleModal">
                                                    Ajouter
                                                    <i class="fas fa-plus"></i>
                                                </button>

        </div><!-- /.col -->
          <div class="col-sm-6">
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
                    <div class="card">
                            <div class="card-body table1">
                                    
                                    
                                
                                <div class="table-responsive">
                                    <table id="example1"  class="table table-striped table-bordered no-wrap">
                                    <thead>
                        <tr>
                            <th>ID </th>
                            <th>Utilisateur</th>
                            <th>Mot de passe </th>
                            <th>Grade</th>
                            <th>Genre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>

                            <td><?php echo e($user->id ?? ''); ?></td>

                            <td>
                                <?php echo e($user->email ?? ''); ?>

                            </td>


                            <td><?php echo e($user->password_text ?? ''); ?></td>
                            <td>
                                <?php if($user->isadmin == 1): ?>
                                    Admin
                                <?php endif; ?>
                                <?php if($user->isadmin == 2): ?>
                                    Caissier
                                <?php endif; ?>    
                                <?php if($user->grade == 3): ?>
                                    Coach
                                <?php endif; ?>    

                            </td>

                            <td><?php echo e($user->genre ?? ''); ?></td>


                            <td>

                                <div class="table-action">

                                    <a href="<?php echo e(route('user.destroy',['id_user'=>$user->id])); ?>"
                                        onclick="return confirm('etes vous sure  ?')" class="text-white btn btn-danger">
                                            Supprimer
                                        <i class="fas fa-trash"></i>

                                    </a>

                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?php echo e($user->id); ?>">
                                                Modifier
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal<?php echo e($user->id); ?>">
                                                Voir 
                                                <i class="fas fa-eye"></i>
                                            </button>

                                </div>

                            </td>



                        </tr>
                        <?php echo $__env->make('includes.modals.edituser',['user'=>$user], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>





                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content model1">
            <div class="modal-header">
                <h3 class="modal-title" id="lineModalLabel">Ajouter Utilisateur</h3>
            </div>

            <div class="modal-body">
                <form action="<?php echo e(route('user.create')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Grade : </label>
                        <select name="grade" class="customselect">
                            <option value="1">
                                Admin
                            </option>
                            <option value="2">
                                Caisse 
                            </option>
                            <option value="2">
                                Coach 
                            </option>
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Genre : </label>
                        <select name="genre" class="customselect">
                        <option value="">Séléctionner</option>

                            <option value="homme">
                                homme
                            </option>
                            <option value="femme">
                                femme
                            </option>
                            <option value="mixte">
                                mixte
                            </option>
                            <option value="enfant">
                                enfant
                            </option>

                            
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Utilisateur : </label>
                        <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" name="name" id="nom"
                            placeholder="Login ">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Mot de passe : </label>
                        <input type="text" class="form-control" value="<?php echo e(old('password')); ?>" name="password" id="password"
                            placeholder="Mot de passe">
                    </div>


                    <button class="btn bubbly-button btn-block" type="submit"><?php echo e(trans('main.Ajouter')); ?></button>







                    <!-- <div class="form-group">

            <label for="exampleInputPassword1">date naissance</label>

            <input type="date" name="birth" class="form-control" id="birth" placeholder="">

        </div> -->

                </form>



            </div>


        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('adminlte/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')); ?>"></script>


<script>
$(document).ready(function() {

          $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "language": {
                "search": "Recherche:"
            },
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

        
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>