<?php $__env->startSection('content'); ?>
<?php 
use App\Setting;
?>
        <div class="container emp-profile  table2 membreProfile "
            style="margin-top:-4%;"
        >
            <form method="post">
                <div class="row " >
                    <div class="col-md-12" style="text-align:center;">
                    <?php if(strlen(Setting::getSetting('titre'))>0): ?>
                        <img  src="<?php echo e(asset(Setting::getSetting('logo'))); ?>" width="400px" />
                    <?php else: ?>
                        <img  src="<?php echo e(asset('img/gymA.svg')); ?>" width="400px" />
                    <?php endif; ?>
                    </div>
                </div>
                <br>

                
                <div class="row " >
                    <div class="col-md-12" style="text-align:center;">
                    <h1 class="cls_001">Bienvenue Chez <?php echo e(Setting::getSetting('titre')); ?> </h1>
                    </div>
                </div>
                <div class="row " >

                    <div class="col-md-12 pad-20">
                        <div class="profile-head">
                                    <p style="text-align:center;font-size: 60px">
                                        
                                    </p>

                                    

                        </div>
                    </div>
                   
                </div>
                <div class="row">
                   
                    
                </div>
            </form>           
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>