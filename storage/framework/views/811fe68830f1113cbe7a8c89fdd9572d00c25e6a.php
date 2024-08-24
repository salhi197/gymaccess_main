<div class="modal fade" id="exampleModal<?php echo e($abonnement->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content model1">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(trans('main.Modifier Abonnement')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="abonnementFform" action="<?php echo e(route('abonnement.update',['abonnement'=>$abonnement->id])); ?>" method="post" enctype="multipart/form-data">
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
                
                <?php if($abonnement->id != 1): ?>

                <div class="form-group">
                <label class="small mb-1" for="inputFirstName"><?php echo e(trans('main.Titre Abonnement')); ?>: </label>
                    <input type="text" value="<?php echo e($abonnement->label); ?>" name="label"  class="form-control"/>
                </div>  
                <div class="form-group">
                    <label class="small mb-1" for="inputFirstName"><?php echo e(trans('main.Nombre de fois par semaine')); ?>: </label>
                    <input type="number" value="<?php echo e($abonnement->nbrsemaine); ?>" name="nbrsemaine"  class="form-control"/>
                </div>  
                <?php endif; ?>
                <div class="form-group">
                    <label class="small mb-1" for="inputFirstName"><?php echo e(trans('main.Tarif')); ?>: </label>
                    <input type="number" value="<?php echo e($abonnement->tarif); ?>" name="tarif"  class="form-control"/>
                </div>  
                <button class="btn bubbly-button btn-block" type="submit" id="ajax_abonnement"><?php echo e(trans('main.Modifier')); ?></button>
            </form>
      </div>
    </div>
  </div>
</div>
