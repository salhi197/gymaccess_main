<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <div class="card-header">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">

                        <h3><?php echo e(count($assurances) ?? ''); ?> </h3>
                        <p>
                            Total Assurance Payés
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo e($assurancesSolde); ?> DA</h3>
                        <p>
                            Montant
                        </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="card mb-4">
    <div class="card-group">
        <h1 style="padding:10px;">
            Filtrer
        </h1>
    </div>
    <form method="post" action="<?php echo e(route('assurances.filter')); ?>">                                                    
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-3" >
                <label class="control-label"><?php echo e(__('Début')); ?>: </label>
                <input class="form-control" value="<?php echo e($date_debut ?? ''); ?>" name="date_debut" type="date" />
            </div>

            <div class="col-md-3" >
                <label class="control-label"><?php echo e(__('Fin')); ?>: </label>
                <input class="form-control" value="<?php echo e($date_fin ?? ''); ?>" name="date_fin" type="date" />
            </div>

            <div class="col-md-3" >
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

            <div class="col-md-3" style="padding:35px;">
                <button type="submit" class="row btn btn-primary" >
                    Filtrer
                </button>                                                                                                        
            </div>
    </form>

    <div class="table-responsive">
        <table id="example1" class="table table-striped table-bordered no-wrap">
            <thead>
                <tr>
                    <th>id</th>
                    <th>nom Prénom</th>
                    <th>Téléphone</th>
                    <th>Prix</th>
                    <th>Date & Heure</th>
                    <th>Agent</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $assurances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $assurance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr>
                    <td><?php echo e($assurance->id ?? 'assurance'); ?></td>
                    <td><?php echo e($assurance->membre()); ?> </td>
                    <td><?php echo e($assurance->telephone ?? ''); ?> </td>
                    <td><?php echo e($assurance->prix ?? 0); ?> DA</td>
                    <!-- <td><?php echo e($assurance->created_at ?? ''); ?></td> -->
                    <td><?php echo e($assurance->created_at ?? ''); ?></td>
                    <td><?php echo e($assurance->agent() ?? ''); ?></td>
                    <td class="display-4">
                        <a class="btn bubbly-button" href="<?php echo e(route('assurance.destroy',['assurance'=>$assurance->d])); ?>" 
                        onclick="return confirm('Etes vous sur?')"
                        >
                                <i class="fa fa-trash"></i> Supprimer
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
<script src="<?php echo e(asset('js/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/chart.js')); ?>"></script>
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
    $(document).ready(function () {

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "order": [
                [0, "desc"]
            ],
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