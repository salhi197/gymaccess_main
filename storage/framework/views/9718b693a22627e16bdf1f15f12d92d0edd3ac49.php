<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header'); ?>
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-4">
              <a href="<?php echo e(route('membre.create')); ?>" class="btn bubbly-button btn-lg"><i class="fa fa-plus"></i>Ajouter</a>
          </div><!-- /.col -->
            <?php if(Auth::user()->isadmin == 1): ?>

          <div class="col-sm-6">
              <h1 class="m-0 text-white"><?php echo e(trans('main.Nombre Total')); ?> : <?php echo e(count($membres)); ?><h1>
              <h1 class="m-0 text-white"><a class="text-white" href="<?php echo e(route('membre.actifs')); ?>">Nombre Total Actifs : <?php echo e(count($actifs)); ?> </a> <h1>
              <h1 class="m-0 text-white"><a class="text-white" href="<?php echo e(route('membre.expirer')); ?>">Nombre Total Expiré : <?php echo e(count($membres)-count($actifs)); ?> </a> <h1>
              <h1 class="m-0 text-white"><a class="text-white" href="<?php echo e(route('membre.credits')); ?>">Nombre Total Endettés : <?php echo e(count($credits)); ?> </a> <h1>
          </div><!-- /.col -->
          <?php endif; ?>

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
                        <div class="card ">
                            <div class="card-body table1">
                                <div class="row text-right">
                                    <div class="col-md-3">
                                    </div>
                                </div>
                                <br>


                                
                                

                                <div class="table-responsive">
                                    <table id="MembersTable" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(trans('main.id')); ?></th>
                                                <th><?php echo e(trans('main.Matricule')); ?></th>
                                                <th><?php echo e(trans('main.nom')); ?></th>
                                                <th><?php echo e(trans('main.Prénom')); ?></th>
                                                <th><?php echo e(trans('main.Téléphone')); ?></th>                                                
                                                <th><?php echo e(trans('main.Action')); ?></th>                                                
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
        // $('#input_id').on('change',function(){
        //     if($('#input_id').val().length >0){
        //         let number = parseInt($('#input_id').val(), 10);
        //         console.log(number);
        //         window.location.href = 'http://localhost:8000/membre/compte/'+number;
        //     }o
        // });

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $('#MembersTable').DataTable({
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
            ajax: "<?php echo e(route('members.getMembers')); ?>",
            columns: [
                { data:'id'},
                { data:'matricule'},
                { data:'nom'},
                { data:'prenom'},
                { data:'telephone'},
                {
                        className: 'action-buttons',
                        orderable: false,
                        mRender: function (data, type, row) {
                            var view = '<a href="/membre/membre/' + row.matricule + ' " class="btn bubbly-button text-white"><?php echo e(trans("main.Profile")); ?> <i class="fa fa-user"></i> </a>';
                            view += ' <a href="/membre/edit/' + row.matricule + ' " class="btn bubbly-button text-white"><?php echo e(trans("main.Modifier")); ?> <i class="fa fa-edit"></i></a>';
                            view += ' <a href="/membre/oublier/' + row.matricule + ' " class="btn btn-success text-white">Puce Oubliée</a>';

                            <?php if(Auth::user()->isadmin==1): ?>
                            view += ' <a href="/membre/destroy/' + row.matricule + ' " onclick="return confirm(\'Etes vous sur ?\')" class="btn bubbly-button text-white"><?php echo e(trans("main.Supprimer")); ?> <i class="fa fa-trash"></i></a>';

                            <?php endif; ?>
                            return view
                        },
                }
                
                // {data: 'action', name: 'action', orderable: false, searchable: false},

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