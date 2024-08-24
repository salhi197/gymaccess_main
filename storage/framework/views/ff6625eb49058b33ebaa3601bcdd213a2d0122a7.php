<?php $__env->startSection('header'); ?>
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> <?php echo e(trans('main.Liste de Inscriptions')); ?> ,  Total <?php echo e(count($inscriptions)); ?>  </h1>
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
                                        <form method="post" action="<?php echo e(route('inscription.filter.excel')); ?>">                                                    
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

                                                    



                                                    <div class="col-md-4" >
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
                                            <tr>
                                                <th><?php echo e(trans('main.Membre')); ?></th>
                                                <th><?php echo e(trans('main.debut')); ?></th>
                                                <th><?php echo e(trans('main.fin')); ?></th>
                                                <th><?php echo e(trans('main.Nombre seance reste')); ?> </th>
                                                <th> Nbr seances </th>
                                                <th>Abonnement</th>
                                                <th><?php echo e(trans('main.etat')); ?></th>
                                                <th><?php echo e(trans('main.total')); ?></th>
                                                <th><?php echo e(trans('main.remise')); ?></th>
                                                <th><?php echo e(trans('main.nbrmois')); ?></th>
                                                <th><?php echo e(trans('main.versement')); ?></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="text-dark">
                                            <?php $__currentLoopData = $inscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="
                                                <?php if($inscription->etat == 1): ?>
                                                td-success
                                                <?php else: ?>
                                                td-error
                                                <?php endif; ?>
                                            ">
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
                                                        <?php echo e(trans('main.active')); ?>

                                                    <?php else: ?>
                                                        Expiré
                                                    <?php endif; ?>

                                                    </span>
                                                </td>
                                                <td><?php echo e($inscription->total ?? ''); ?>DA</td>
                                                <td><?php echo e($inscription->remise ?? ''); ?></td>

                                                <td style="text-align:center;">
                                                    <?php echo e($inscription->nbrmois ?? ''); ?>

                                                </td>                                            
                                                <td><?php echo e($inscription->versement ?? ''); ?> DA</td>

                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter Inscription</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" action="<?php echo e(route('inscription.store')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="hidden" value="<?php echo e($membre->id ?? ''); ?>" name="membre" />
                                                <div class="form-group">
                                                    <label>Abonnement</label>
                                                    <select class="form-control" id="abonnement" name="abonnement">
                                                        <option value="">séléctionner un abonnement</option>
                                                        <?php $__currentLoopData = $abonnements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $abonnement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($abonnement); ?>"><?php echo e($abonnement->label); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Date début</label>
                                                    <input type="date" id="debut"  value="<?php echo e(Date('Y-m-d')); ?>" name="debut" class="form-control">
                                                </div>

                                            </div>

                                            <div class ="col-sm-4">
                                                <div class="form-group">
                                                    <label>Tarification:</label>
                                                    <input type="number"  name="tarif" value="0" id="tarif" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>date fin</label>
                                                    <input id="fin" type="date" value="<?php echo e(old('fin')); ?>" name="fin" class="form-control">
                                                </div>
                                            </div>

                                            <div class ="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nombre de mois</label>
                                                    <input type="number"  value="<?php echo e(old('nbrmois') ?? 1); ?>" min="1" id="nbrmois" name="nbrmois" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Total</label>
                                                    <input type="number" id="total" value="<?php echo e(old('total')); ?>" name="total" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Remise</label>
                                                    <input type="number" value="<?php echo e(old('remise') ?? 0); ?>" id="remise" name="remise" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Versement</label>
                                                    <input type="number" value="<?php echo e(old('versement') ?? 0); ?>" id="versement" name="versement" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>T.T.C : </label>
                                                    <input type="number" value="<?php echo e(old('ttc') ?? 0); ?>" id="ttc" name="ttc" class="form-control">
                                                </div>
                                                

                                            </div>

                                        </div>


                                    <div class="col-sm-12">
                                        <button type="submit" id="valider"  class="btn btn-info btn-block">Valider</button>
                                    </div>


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
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(asset('js/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js')); ?>"></script>



<script>
$(document).ready(function() {

        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "order": [[ 0, "desc" ]],
            "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ],
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print','colvis'
            ]

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