
<div class="modal fade" id="assurance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content model1">
            <div class="modal-header">
                <h3 class="modal-title" id="lineModalLabel">Assurance : </h3>
            </div>

                                   
                            

            <div class="modal-body">
                <form action="<?php echo e(route('assurance.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" value="<?php echo e($membre->id ?? ''); ?>" name="membre4" />
                        <div class="form-group">
                            <label class="m-0 text-white" style="font-size:30px;">Date :</label>
                            <input type="date" id="date_assurance"  value="<?php echo e(Date('Y-m-d')); ?>" name="date_assurance" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="m-0 text-white" style="font-size:30px;">Montant:</label>
                            <input type="number"   name="montant"  value="0" id="montant" class="form-control">
                        </div>                                                    
                        <?php if($inscription->total-$inscription->assurance!=0): ?>
                            <button class="btn bubbly-button btn-block" type="submit"><?php echo e(trans('main.Ajouter')); ?></button>
                        <?php endif; ?>
                </form>



            </div>


        </div>

    </div>

</div>



