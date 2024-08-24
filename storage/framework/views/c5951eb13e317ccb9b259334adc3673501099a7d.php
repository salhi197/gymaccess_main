<?php $__env->startSection('header'); ?>
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des Présenses :   <h1>
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


                                      <form method="post" action="<?php echo e(route('presence.filter2')); ?>">
                                      <?php echo csrf_field(); ?>
                                      <div class="row">
                                          <div class="col-md-3">
                                              <div class="form-group">
                                                  <label>Date Début</label>
                                                  <input type="date" name="date_debut" value="<?php echo e($date_debut ?? ''); ?>" class="form-control">
                                              </div>                                     
                                          </div>
                                          <div class="col-md-3">
                                              <div class="form-group">
                                                  <label>Date Fin</label>
                                                  <input type="date" name="date_fin" value="<?php echo e($date_fin ?? ''); ?>" class="form-control">
                                              </div>                                     
                                          </div>

                                          <div class="col-sm-2">
                                              <label>&nbsp;</label>
                                              <button type="submit" id="valider" class="btn bubbly-button btn-block">filter</button>
                                          </div>
                                      </div>
                                  </form>



                                <h4 class="card-title">
                                </h4>                     
                                <table id="example1"  class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>Présnces Numéro</th>
                                                <th>Membre</th>
                                                <th>Date Entrée</th>     
                                                <th>Action</th>     
                                                                                        
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $presences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $presence): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($presence->id ?? ''); ?></td>
                                                <td>
                                                  <?php echo e($presence->getMembre()['nom'] ?? ''); ?>

                                                  <?php echo e($presence->getMembre()['prenom'] ?? ''); ?>

                                                  <?php echo e($presence->nom_prenom ?? ''); ?>



                                                </td>
                                                <td>
                                                  <h3>
                                                    <span class="badge badge-info">
                                                    <?php echo e($presence->created_at->format('Y/m/d') ?? ''); ?>

<?php echo e($presence->created_at->format('H')+2 ?? ''); ?>:<?php echo e($presence->created_at->format('i:s') ?? ''); ?>

                                                    </span>
                                                  </h3>
                                                </td>
                                                <td class="display-4">
                                                        <a class="btn bubbly-button" href="<?php echo e(route('presence.destroy',['presence'=>$presence->id])); ?>" 
                                                        onclick="return confirm('Etes vous sur ?')"
                                                        >
                                                        Supprimer
                                                                <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>                                                
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                        </tbody>
                                    </table>


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
<script src="<?php echo e(asset('adminlte/plugins/jszip/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/pdfmake/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/pdfmake/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>


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
        
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>