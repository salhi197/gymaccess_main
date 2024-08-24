<?php $__env->startSection('header'); ?>
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-white"> Liste des produits  </h1>
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
              
                        <button data-toggle="modal" data-target="#squarespaceModal" class="btn bubbly-button btn-lg">
                                    Ajouter Produit
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
                                                <th>ID produit</th>
                                                <th>Nom produit </th>
                                                <th> Qte </th>
                                                <th> Prix Achat </th>

                                                <th> Prix Vente </th>

                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $produits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                            

                                            <tr>

                                                <td><?php echo e($produit->id ?? ''); ?></td>
                                                <td>
                                                    <?php echo e($produit->nom ?? ''); ?> 
                                                </td>
                                                <td><?php echo e($produit->qte ?? ''); ?> </td>
                                                <td><?php echo e($produit->prix_achat ?? ''); ?> DA </td>
                                                <td><?php echo e($produit->prix_vente ?? ''); ?> DA </td>


                                                <td >

                                                    <div class="table-action">  
                                                        <a 
                                                        href="<?php echo e(route('produit.destroy',['produit'=>$produit->id])); ?>"
                                                        class="btn btn-danger   text-gradient px-3 mb-0" onclick="return confirm('etes vous sure  ?')" >
                                                            <i class="far fa-trash-alt me-2"></i>
                                                            Delete
                                                        </a>

                                                        <button data-toggle="modal" data-target="#squarespaceModal<?php echo e($produit->id); ?>" class="btn btn-info text-dark px-3 mb-0">
                                                            <i class="far fa-edit"></i>

                                                            Modifer
                                                        </button>       
          
                                                    </div>

                                                </td>



                                            </tr>

                                            <?php echo $__env->make('includes.modals.editproduit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>




<div class="modal fade " id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content model1">
            <div class="modal-header">
                <h3 class="modal-title" id="lineModalLabel">Ajouter Produit : </h3>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('produit.create')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom Produit</label>
                        <input type="text" value="<?php echo e(old('nom')); ?>" name="nom" class="form-control"
                            id="exampleInputEmail1" placeholder=" ">
                    </div>
                    

                    <div class="form-group">
                        <label for="exampleInputEmail1">prix Achat :</label>
                        <input type="text" value="<?php echo e(old('prix_achat')); ?>" name="prix_achat" class="form-control" id=""
                            placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Prix Vente : </label>
                        <input type="text" value="<?php echo e(old('prix_vente')); ?>" name="prix_vente" class="form-control" id="prix_vente"
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Qte : </label>
                        <input type="text" value="<?php echo e(old('qte')); ?>" name="qte" class="form-control" id="qte"
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Photo : </label>
                        <input type="file" value="<?php echo e(old('photo')); ?>" name="photo" class="form-control" id="photo"
                            placeholder="">
                    </div>



                    <div class="btn-group" role="group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" role="button">Fermer</button>
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