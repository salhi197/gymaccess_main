<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
                                <div class="card ">
                                    <div class="card-body table1">
                                        <div class="row">
                                            <form method="post" action="<?php echo e(route('rapport.filter')); ?>">                                                    
                                                <?php echo csrf_field(); ?>
                                                <div class="row">
                                                    <div class="col-md-3" >
                                                        <label class="control-label"><?php echo e(trans('main.debut')); ?>: </label>
                                                        <input class="form-control" value="<?php echo e($date_debut ?? ''); ?>" name="date_debut" type="date" />
                                                    </div>

                                                    <div class="col-md-3" >
                                                        <label class="control-label"><?php echo e(trans('main.fin')); ?>: </label>
                                                        <input class="form-control" value="<?php echo e($date_fin ?? ''); ?>" name="date_fin" type="date" />
                                                    </div>
                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" ><?php echo e(trans('main.Abonnement')); ?>:</label><br>
                                                        <select class="customselect" id="abonnement" name="abonnement">
                                                            <option value="" ><?php echo e(trans('main.Séléctionner un Abonnement')); ?>:</option>
                                                                <?php $__currentLoopData = $abonnements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abonnement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option
                                                                        <?php if($_abonnement==$abonnement->id): ?> selected <?php endif; ?>
                                                                     value="<?php echo e($abonnement->id); ?>"><?php echo e($abonnement->label); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" >Age Min:</label><br>
                                                        <input class="form-control" value="<?php echo e($agemin ?? ''); ?>" name="agemin" type="number" />
                                                    </div>

                                                    <div class="col-md-3" >
                                                        <label class="m-0 text-white" >Age Max:</label><br>
                                                        <input class="form-control" value="<?php echo e($agemax ?? ''); ?>" name="agemax" type="number" />
                                                    </div>

                                                    <div class="col-md-2" style="padding:16px">
                                                        <button type="submit" class="row btn bubbly-button" >
                                                            <?php echo e(trans('main.Filtrer')); ?>

                                                        </button>                                                                                                        
                                                    </div>
                                                </div>
                                            </form>
                                        

                                
                                

                                        <div class="table-responsive">
                                            <table id="InscriptionsTable" class="table table-striped table-bordered no-wrap">
                                                <thead>
                                                    <tr>
                                                        <th>Id</th>
                                                        <th><?php echo e(trans('main.debut')); ?></th>
                                                        <th><?php echo e(trans('main.fin')); ?></th>
                                                        <th><?php echo e(trans('main.Nombre seance reste')); ?> </th>
                                                        <th>Nbr Seances </th>
                                                        <th>Abonnement</th>
                                                        <th>Membre</th>
                                                        <th><?php echo e(trans('main.etat')); ?></th>
                                                        <th><?php echo e(trans('main.total')); ?></th>
                                                        <th><?php echo e(trans('main.remise')); ?></th>
                                                        <th><?php echo e(trans('main.nbrmois')); ?></th>
                                                        <th><?php echo e(trans('main.versement')); ?></th>
                                                        <th><?php echo e(trans('main.actions')); ?></th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
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
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>


<script>
    $(document).ready(function() {

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $('#InscriptionsTable').DataTable({
            searching: true,


            language: {
                lengthMenu: "Display _MENU_ records per page",
                zeroRecords: "Pas de Résultat   ",
                info: "Showing page _PAGE_ of _PAGES_",
                infoEmpty: "No records available",
                infoFiltered: "(filtered from _MAX_ total records)"
            },
            processing: true,
            lengthMenu: [
                [10, 25, 50,100,200,500, -1],
                [10, 25, 50,100,200,500],
            ],
            serverSide: true,
            ajax: "<?php echo e(route('inscriptions.getInscriptions')); ?>",
            columns: [
                {data:"id"},
                {data:"debut"},
                {data:"fin"},
                {data:"reste"},
                {data:"nbsseance"},
                {data:"abonnement"},
                {data:"membre"},
                {data:"etat"},
                {data:"total"},
                {data:"remise"},
                {data:"nbrmois"},
                {data:"versement"},
                {
                        className: 'action-buttons',
                        orderable: false,
                        mRender: function (data, type, row) {
                            var view = '<a href="/inscription/presence/' + row.id + ' " class="btn bubbly-button text-white">Présences <i class="fa fa-user"></i> </a>';
                            view += ' <a href="/inscription/destroy/' + row.id + ' " onclick="return confirm(\'Etes vous sur ?\')" class="btn bubbly-button text-white">Supprimer <i class="fa fa-trash"></i></a>';


                            return view

                        },
                }                

            ]
      });
      var oldSearchValue = '';
            $('#table_search').keyup(function () {
                var newValue = $(this).val();
                if (newValue !== oldSearchValue) {
                    dataTable.search(newValue).draw();
                    oldSearchValue = newValue;
                }
            });

});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>