<?php $__env->startSection('content'); ?>
<?php 
use App\Setting;
?>
<div class="container">

    <div class="row">

        <div class="col-lg-12 table1">
            <div class="card mt-2 ">
                <div class="card-header">
                    <h3 class="font-weight-light my-4"> Paramètre de l'application: <h3>
                </div>
                <div class="card-body">
                    <form role="form" action="<?php echo e(route('setting.store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                      Communication : 
                                    </label>
                                    <span class="badge badge-success">
                                        Connecté
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label>
                                      Nom de la salle : 
                                    </label>
                                    <input value="<?php echo e(Setting::getSetting('titre')); ?>" name="titre" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                      Email : 
                                    </label>
                                    <input value="<?php echo e(Setting::getSetting('email')); ?>" name="email" type="email" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                        Telephone: 
                                    </label>
                                    <input value="<?php echo e(Setting::getSetting('telephone')); ?>" name="telephone" type="number" class="form-control"/>
                                </div>


               

                                <div class="form-group">
                                    <label>
                                        Adress :
                                    </label>
                                    <input value="<?php echo e(Setting::getSetting('adress')); ?>" name="adress"  class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <button class="btn bubbly-button" type="submit"> Sauvgarder </button>
                                </div>

                                



                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>
                                       Lien ( Paramètre System ): 
                                    </label>
                                    <input value="<?php echo e(Setting::getSetting('lien')); ?>" name="lien"  class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Nombre de Tourniquet : 
                                    </label>
                                    <input value="<?php echo e(Setting::getSetting('nbrtourniquet')); ?>" name="nbrtourniquet"  class="form-control"/>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Tarif Assurance : 
                                    </label>
                                    <input value="<?php echo e(Setting::getSetting('assurance')); ?>" name="assurance"  class="form-control"/>
                                </div>

                                <div class="form-group">
                                        <label>
                                            Voix Dans Modifier : 
                                        </label>
                                    <input value="<?php echo e(Setting::getSetting('voixedit')); ?>" name="voixedit"  class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label>
                                            Camera: 
                                        </label>
                                    <input value="<?php echo e(Setting::getSetting('camera')); ?>" name="camera"  class="form-control"/>

                                </div>
                                <div class="form-group">
                                    <label>
                                            Moins Seance Dans scanner : 
                                        </label>
                                    <input value="<?php echo e(Setting::getSetting('minus')); ?>" name="minus"  class="form-control"/>

                                </div>

                               
                            </div>


                            <div class="col-md-3">

                                <div class="form-group">
                                    <img  src="<?php echo e(asset(Setting::getSetting('logo'))); ?>" width="200px" />
                                </div>
                                <div class="form-group">
                                    <label>
                                        Logo :
                                    </label>
                                    <input value="<?php echo e(Setting::getSetting('logo')); ?>" name="logo"  type="file" class="file-control"/>
                                </div>


                                <div class="form-group">
                                        <a href="<?php echo e(route('clear.records')); ?>" class="btn  bubbly-button">
                                            Vider La Liste des Entrés
                                        </a>
                                    </div>
                                    <div class="form-group">


                                </div>

                            </div>

                        </div>




                    </form> 
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>