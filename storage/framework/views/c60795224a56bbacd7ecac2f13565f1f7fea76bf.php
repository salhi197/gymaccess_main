<?php $__env->startSection('content'); ?>

<?php 
use App\Setting;
?>
        <div class="container emp-profile  table2 membreProfile "
            style="margin-top:-4%;"
        >
            <form method="post">
                <div class="row " >
                    <div class="col-md-6" style="text-align:center;">
                        <div class="profile-img">
                            <?php if(strlen($membre->photo)>0): ?>
                            <img src="<?php echo e(asset($membre->photo)); ?>" width="400px" alt=""/>
                            <?php else: ?>
                            <img src="<?php echo e(asset('img/gymA.svg')); ?>" width="400px" alt=""/>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6 pad-20">
                        <div class="profile-head">
                                    <div class='corner2'></div>
                                    <div class='corner2'></div>
                                    <div class='corner2'></div>
                                    <div class='corner2'></div>

                                    <h1 style="text-align:center;">
                                        <?php echo e($membre->nom); ?>  
                                    </h1>
                                    <h1 style="text-align:center;">

                                        <?php echo e($membre->prenom); ?> 
                                    </h1>
                                    <p style="text-align:center;">


                                            <?php if($inscription->reste==0 or $inscription->fin<date('Y-m-d')) {?>
                                                <span id="loading2" class="btn btn-danger">
                                                    Expiré
                                                </span>

                                            <?php }else { ?>
                                                <span id="loading" class="btn btn-success">
                                                    Active
                                                </span>


                                            <?php } ?>


                                    </p>

                                    <div class="">
                                    <!-- <p class="proile-rating"> Poids : <span>70kg</span></p>
                                    <p class="proile-rating">Taille  : <span>188cm</span></p> -->
                                    </div>
<!--                             <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Profile</a>
                                </li>
                            </ul> -->
                        </div>
<div class="col-md-6 pad-20">
                  
                    </div>
                    </div>

                    <!-- <div class="col-md-2 editbutton">
                        <a href="<?php echo e(route('membre.edit',['membre'=>$membre->matricule])); ?>"  class="bubbly-button">
                            Modifier 
                        </a>
                    </div> -->
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="profile-work">
                        </div>
                    </div>
                    <div class="col-md-10 profileTab pad-50 marg-50">
                                <div class='corner'></div>
                                <div class='corner'></div>
                                <div class='corner'></div>
                                <div class='corner'></div>
                        <div class="tab-content profile-tab " id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <?php if($inscription->abonnement != 1): ?>                                               
                                            <div class="col-md-12">
                                                <p style="font-size:60px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"> 

                                            <?php if($inscription->reste==0 or $inscription->fin<date('Y-m-d')) {?>
                                                    0
                                            <?php }else { ?>
                                                <?php echo e($inscription->reste ?? ''); ?>

                                            <?php } ?>

                                                 <label>Séances</label></p>
                                            </div>
                                            <?php else: ?>
                                            <div class="col-md-12">
                                                <p style="font-size:60px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"> Accées Libre </p>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                  <!--       <div class="row">
                                            <div class="col-md-6">
                                                <label>Inscription : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 style="font-size:40px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"><?php echo e($inscription->getAbonnement()['label'] ?? '  '); ?></h5>
                                            </div>
                                        </div> -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date Début : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 style="font-size:50px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center"><?php echo e($inscription->debut); ?></h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date Fin : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 style="font-size:50px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center" id="datefin"><?php echo e($inscription->fin); ?></h1>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label> Abonnement : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 style="font-size:50px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center" ><?php echo e($inscription->getAbonnement() ?? ''); ?></h1>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Crédit : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 style="font-size:50px;
                                                font-family:'Orbitron', sans-serif !important;" class="text-white mb-1 font-weight-medium text-center">

                                                    <?php echo e($inscription->total-$inscription->versement); ?> DA                                                
                                                    
                                                </h1>
                                            </div>
                                        </div>
                                        
                                        

                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
                                        <input id="reste22" type="hidden" value="<?php echo e($inscription->reste ?? ''); ?>"/>
                                        <input id="nom" type="hidden" value="<?php echo e($membre->nom ?? ''); ?>"/>
                                        <input id="prenom" type="hidden" value="<?php echo e($membre->prenom ?? ''); ?>"/>
                                        <input id="reste" type="hidden" value="<?php echo e($inscription->total-$inscription->versement); ?>"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('adminlte/plugins/jquery/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/select2.min.js')); ?>"></script>

<script src="<?php echo e(asset('adminlte/plugins/toastr/toastr.min.js')); ?>"></script>

<script src="<?php echo e(asset('js/responsivevoice.js')); ?>"></script>

<script type="text/javascript">
             var host = <?php echo json_encode(url('/')); ?>         
            var envurl = <?php echo json_encode(Setting::getSetting('lien')); ?>         
            console.log(host)
            setInterval(function(){ 
                    window.location.href = envurl+':8000/membre/default';

            }, 10000);
</script>
<script type="text/javascript">
    $(document).ready(function() {
        var reste = $('#reste22').val();     
        var nom = $('#nom').val();     
        var prenom = $('#prenom').val();     
        var fin = $('#datefin').text();     
        var reste = $('#reste22').val();     
        var credit = $('#reste').val();     
        console.log(credit)
        responsiveVoice.speak("Bienvenue , Vous Avez déja utilsé Votre séance", "French Female");

    })


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>