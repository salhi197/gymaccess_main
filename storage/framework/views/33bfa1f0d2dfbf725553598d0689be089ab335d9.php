<?php $__env->startSection('content'); ?>

<div class="container-fluid">

                        <h1 class="mt-4 text-white "> <?php echo e(trans('main.Liste de Tous Les Abonnements')); ?> : </h1>

                            <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn bubbly-button" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i> <?php echo e(trans('main.Ajouter Abonnement')); ?>

                                </button>
                            </div>
                                    <div class="card-body table1">
                                        <div class="table-responsive">
                                            <table class="table" id="example1">
                                            <thead class="">
                                                <tr>
                                                    <th><?php echo e(trans('main.ID')); ?></th>
                                                    <th><?php echo e(trans('main.label')); ?></th>
                                                    <th><?php echo e(trans('main.Tarif')); ?></th>
                                                    <th>Tripode</th>
                                                    <th>Nbr Total Actifs</th>
                                                    <th><?php echo e(trans('main.actions')); ?></th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $abonnements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abonnement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="display-4"><?php echo e($abonnement->id ?? ''); ?></td>
                                            <td class="display-4"><?php echo e($abonnement->label ?? ''); ?></td>
                                            <td class="display-4"><?php echo e($abonnement->tarif ?? ''); ?> DA</td>
                                            <td class="display-4">
                                                <?php if($abonnement->tripode == 3 ): ?>
                                                    Les Deux
                                                <?php else: ?>
                                                <?php echo e($abonnement->tripode ?? ''); ?>

                                                <?php endif; ?>

                                            </td>
                                            <td class="display-4"><?php echo e($abonnement->total() ?? ''); ?> </td>

                                            <td >
                                                <div class="table-action">  
                                                    <?php if($abonnement->id != 1): ?>
                                                    <a  href="<?php echo e(route('abonnement.destroy',['abonnement'=>$abonnement->id])); ?>"
                                                    onclick="return confirm('etes vous sure  ?')"
                                                    class="btn bubbly-button text-white"><i class="fa fa-trash"></i> &nbsp; </a>

                                                    <?php endif; ?>

                                                    <button type="button" class="btn bubbly-button" data-toggle="modal" data-target="#exampleModal<?php echo e($abonnement->id); ?>">
                                                        <i class="fa fa-plus"></i> <?php echo e(trans('main.Modifier')); ?>

                                                    </button>


                                                </div>
                                            </td>
                                        </tr>
                                        <?php echo $__env->make('includes.modals.editabo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>



                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content model1">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('main.Ajouter Abonnement')); ?>:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="abonnementFform" action="<?php echo e(route('abonnement.create')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>



                    <div class="form-group">
                        <label for="exampleInputEmail1">Tourniquet : </label>
                        <select name="tripode" class="customselect">
                            <option value="1">
                                1
                            </option>
                            <option value="2">
                                2
                            </option>
                            <option value="3">
                                Les Deux
                            </option>
                            
                        </select>
                    </div>
                


                <div class="form-group">
                    <label  for="inputFirstName"><?php echo e(trans('main.Titre Abonnement')); ?>: </label>
                    <input type="text" name="label"  class="form-control"/>
                </div>  
                <div class="form-group">
                    <label  for="inputFirstName"><?php echo e(trans('main.Nombre de fois par semaine')); ?>: </label>
                    <input type="number" min="1" max="7" name="nbrsemaine"  class="form-control"/>
                </div>  
                
                
                <div class="form-group">
                    <label  for="inputFirstName"><?php echo e(trans('main.Tarif')); ?>: </label>
                    <input type="number" name="tarif"  class="form-control"/>
                </div>  
                <button class="btn bubbly-button btn-block" type="submit" id="ajax_abonnement"><?php echo e(trans('main.Ajouter')); ?></button>
            </form>
      </div>
    </div>
  </div>
</div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

<script>

$("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "order": [[ 0, "desc" ]],
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print','colvis'
            ]

          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>