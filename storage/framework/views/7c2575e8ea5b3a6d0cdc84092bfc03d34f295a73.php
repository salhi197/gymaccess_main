<?php $__env->startSection('header'); ?>
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des Membre Actifs , Total <?php echo e(count($membres)); ?>  </h1>
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

                                    </div>
                                
                                <div class="table-responsive">
                                    <table id="example1"  class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(trans('main.id')); ?></th>
                                                <th><?php echo e(trans('main.Matricule')); ?></th>
                                                <th><?php echo e(trans('main.nom')); ?></th>
                                                <th><?php echo e(trans('main.Prénom')); ?></th>
                                                <th><?php echo e(trans('main.Téléphone')); ?></th>                                                
                                                <th><?php echo e(trans('main.Action')); ?></th>                                                
                                            </tr>

                                        </thead>
                                        <tbody class="">
                                            <?php $__currentLoopData = $membres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $membre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr >
                                                    <td><?php echo e($membre->id ?? ''); ?></td>
                                                    <td><?php echo e($membre->matricule ?? ''); ?></td>
                                                    <td><?php echo e($membre->nom ?? ''); ?></td>
                                                    <td><?php echo e($membre->prenom ?? ''); ?></td>
                                                    <td><?php echo e($membre->telephone ?? ''); ?></td>
                                                    <td>
                                                        <a href="/membre/membre/<?php echo e($membre->matricule ?? ''); ?>" class="btn bubbly-button text-white"><?php echo e(trans("main.Profile")); ?> </a>
                                                        <a href="/membre/edit/<?php echo e($membre->matricule ?? ''); ?>" class="btn bubbly-button text-white"><?php echo e(trans("main.Modifier")); ?> <i class="fa fa-edit"></i></a>
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

        
        $('.state').on('change',function(e){
            var id = this.id
            console.log(id)

            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/membre/state/'+id,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data)
                    toastr.success('état changé');
                },
                error: function(err) { 
                    console.log(err)
                    toastr.error(err)
                }
            });
        })
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>