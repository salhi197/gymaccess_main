
<div class="modal fade" id="verser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content model1">
            <div class="modal-header">
                <h3 class="modal-title" id="lineModalLabel">Ajouter Versement</h3>
            </div>

                                   
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="exampleModalLabel">Crédit : <?php echo e($inscription->total-$inscription->versement); ?> DA</h5>
                                    </div>
                            

            <div class="modal-body">
                <form action="<?php echo e(route('versement.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" value="<?php echo e($membre->id ?? ''); ?>" name="membre3" />
                    <input type="hidden" value="<?php echo e($inscription->id ?? ''); ?>" name="inscription3" />
                        <div class="form-group">
                            <label class="m-0 text-white" style="font-size:30px;">Date Versement</label>
                            <input type="date" id="date_versement"  value="<?php echo e(Date('Y-m-d')); ?>" name="date_versement" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="m-0 text-white" style="font-size:30px;">Montant:</label>
                            <input type="number"   name="montant"  value="0" id="montant" class="form-control">
                        </div>                                                    

                    <?php if($inscription->total-$inscription->versement!=0): ?>
                    <button class="btn bubbly-button btn-block" type="submit"><?php echo e(trans('main.Ajouter')); ?></button>

                    <?php endif; ?>


                </form>



            </div>


        </div>

    </div>

</div>



