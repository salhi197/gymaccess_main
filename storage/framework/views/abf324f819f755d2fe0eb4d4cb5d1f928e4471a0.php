<div class="modal fade " id="squarespaceModal<?php echo e($produit->id); ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content model1">
            <div class="modal-header">
                <h3 class="modal-title" id="lineModalLabel">Ajouter Produit : </h3>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('produit.update',['produit'=>$produit->id])); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nom Produit</label>
                        <input type="text" value="<?php echo e($produit->nom ?? ''); ?>" name="nom2" class="form-control"
                            id="exampleInputEmail1" placeholder=" ">
                    </div>
                    

                    <div class="form-group">
                        <label for="exampleInputEmail1">prix Achat :</label>
                        <input type="text" value="<?php echo e($produit->prix_achat ?? ''); ?>" name="prix_achat2" class="form-control" id=""
                            placeholder=" ">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Prix Vente : </label>
                        <input type="text" value="<?php echo e($produit->prix_vente ?? ''); ?>" name="prix_vente2" class="form-control" id="prix_vente"
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Qte : </label>
                        <input type="text" value="<?php echo e(old('qte')); ?>" name="qte2" class="form-control" id="qte"
                            placeholder="">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">Photo : </label>
                        <input type="file" value="<?php echo e($produit->photo ?? ''); ?>" name="photoedit2" class="form-control" id="photo"
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