<?php $__env->startSection('header'); ?>
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des commandes  </h1>
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
                                        <div class="col-lg-4 col-12">
                                            <div class="small-box bg-info">
                                              <div class="inner">
                                                <?php $Total =0; ?>
                                                <?php $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $Total =$Total+$commande->net(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <h3>Total net : <?php echo e($Total); ?> DA </h3>
                                                <p>
                                                </p>
                                              </div>
                                              <div class="icon">
                                                <i class="ion ion-bag"></i>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="small-box bg-info">
                                              <div class="inner">
                                                <?php $Total =0; ?>
                                                  <?php $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                      <?php $Total =$Total+$commande->montant(); ?>
                                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <h3>Total commande : <?php echo e($Total); ?> DA </h3>
                                                <p>
                                                </p>
                                              </div>
                                              <div class="icon">
                                                <i class="ion ion-bag"></i>
                                              </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <form method="post" action="<?php echo e(route('commande.filter')); ?>">                                                    
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
                                                        <label class="m-0 text-white" style="">Caissier:</label><br>
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
                                                          <i class="fa fa-filter"></i>
                                                            <?php echo e(trans('main.Filtrer')); ?>

                                                        </button>                                                                                                        
                                                    </div>


                                        </form>

                                    </div>
                                
                                <div class="table-responsive">
                                    <table id="example1"  class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Membre</th>
                                                <th>Caissier</th>
                                                <th>Montant</th>
                                                <th>Remise</th>
                                                
                                                <th>net</th>
                                          
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-white">
                                            <?php $__currentLoopData = $commandes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commande): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <?php echo e($commande->id ?? ''); ?>

                                                </td>
                                                <td><?php echo e($commande->membre()['nom'] ?? ''); ?></td>

                                                <td>
                                                    <?php echo e($commande->user()['name'] ?? ''); ?>

                                                </td>
                                                <td><?php echo e($commande->montant() ?? ''); ?> DA</td>
                                                <td><?php echo e($commande->remise ?? '0'); ?> DA</td>
                                                <td><?php echo e($commande->net()-$commande->remise ?? ''); ?> DA</td>

                                                
                                                <td>
                                                  <?php if(Auth::user()->isadmin == 1): ?>
                                                    <a href="<?php echo e(route('commande.destroy',['commande'=>$commande->id])); ?>"
                                                            onclick="return confirm('Etes vous sure?')"
                                                      class="btn btn-danger">
                                                        <i class="fa fa-trash"></i> Supprimer
                                                    </a>

                                                  <?php endif; ?>

                                                  <a href="<?php echo e(route('commande.print',['commande'=>$commande->id])); ?>"
                                                      class="btn btn-success">
                                                        <i class="fa fa-print"></i> Bon De Commande
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