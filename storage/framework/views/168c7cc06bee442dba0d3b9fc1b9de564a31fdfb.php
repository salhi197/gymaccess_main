<?php $__env->startSection('header'); ?>
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des Inscriptions :  </h1>
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

<?php $__env->startSection('content'); ?>
                    <div class="card">
                            <div class="card-body table1">
                                    <div class="row">
                                    <form method="post" action="<?php echo e(route('rapport.filter')); ?>">                                                    
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-md-4" >
                                                        <label class="control-label"><?php echo e(trans('main.debut')); ?>: </label>
                                                        <input class="form-control" value="<?php echo e($date_debut ?? ''); ?>" name="date_debut" type="date" />
                                                    </div>

                                                    <div class="col-md-4" >
                                                        <label class="control-label"><?php echo e(trans('main.fin')); ?>: </label>
                                                        <input class="form-control" value="<?php echo e($date_fin ?? ''); ?>" name="date_fin" type="date" />
                                                    </div>
                                                    <div class="col-md-4" >
                                                        <label class="m-0 text-white" >Caissier:</label><br>
                                                        <select class="customselect" id="user" name="user">
                                                            <option value="" >Séléctionner un user:</option>
                                                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option
                                                                        <?php if($_user==$user->id): ?> selected <?php endif; ?>
                                                                     value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>

                                                    </div>

                                                    <div class="col-md-2" style="padding:16px">
                                                        <button type="submit" class="row btn bubbly-button" >
                                                            <?php echo e(trans('main.Filtrer')); ?>

                                                        </button>                                                                                                        
                                                    </div>


                                        </form>

                                    </div>
                                
                                <div class="table-responsive">
                                    <table id="example1"  class="table table-striped table-bordered no-wrap">
                                    <thead>
                                            <tr class="text-white">
                                                <th>Date Inscription</th>
                                                <th>Membre</th>
                                                <th>debut</th>
                                                <th>fin</th>
                                                <th>Reste  </th>
                                                <th>Séances</th>
                                                <th>abonnement</th>
                                                <th>etat</th>
                                                <th>total</th>
                                                <th>remise</th>
                                                <th>nbrmois</th>
                                                <th>versement</th>
                                                <th>actions</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $inscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr 
                                            class="
                                            <?php if($inscription->etat == 1): ?>
                                            td-success
                                            <?php else: ?>
                                            td-error
                                            <?php endif; ?>"
                                            >

                                                <td>
                                                    <?php echo e($inscription->created_at ?? ''); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($inscription->getMembre()['nom'] ?? ''); ?>

                                                    <?php echo e($inscription->getMembre()['prenom'] ?? ''); ?>

                                                </td>
                                                <td><?php echo e($inscription->debut ?? ''); ?></td>
                                                <td><?php echo e($inscription->fin ?? ''); ?></td>
                                                <td><?php echo e($inscription->reste ?? ''); ?></td>
                                                <td style="text-align:center;"><?php echo e($inscription->nbsseance ?? ''); ?></td>
                                                <td><?php echo e($inscription->getAbonnement() ?? ''); ?></td>
                                                <td>
                                                    <span class="badge badge-info"> 

                                                    <?php if($inscription->etat == 1): ?>
                                                        Active
                                                    <?php else: ?>
                                                        Expirer
                                                    <?php endif; ?>

                                                    </span>
                                                </td>
                                                <td><?php echo e($inscription->total ?? ''); ?>DA</td>
                                                <td><?php echo e($inscription->remise ?? ''); ?></td>

                                                <td style="text-align:center;">
                                                    <?php echo e($inscription->nbrmois ?? ''); ?>

                                                </td>                                            
                                                <td><?php echo e($inscription->versement ?? ''); ?> DA</td>

                                                <td>
                                                    <a class="btn bubbly-button text-white" href="<?php echo e(route('inscription.presence',['inscription'=>$inscription->id])); ?>">
                                                        <i class="fa fa-list"></i>
                                                        Présences
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                        </tbody>

                                    </table>
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