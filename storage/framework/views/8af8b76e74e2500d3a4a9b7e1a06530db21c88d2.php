<?php $__env->startSection('content'); ?>
<?php 
use App\Setting;

?>


<section class="content">
          <div class="row">
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">General</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputName">Project Name</label>
                    <input type="text" id="inputName" class="form-control" value="Gym Access">
                  </div>
                  <div class="form-group">
                    <label for="inputDescription"> Description</label>
                    <textarea id="inputDescription" class="form-control" rows="4">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</textarea>
                  </div>
                  <div class="form-group">
                    <label for="inputStatus">Status</label>
                    <select id="inputStatus" class="form-control custom-select">
                      <option disabled>Select one</option>
                      <option>On Hold</option>
                      <option>Canceled</option>
                      <option selected>Success</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="inputClientCompany">Logo</label>
                    <input type="file" id="logo" class="file-control" value="">
                  </div>
                  <div class="form-group">
                    <label for="inputProjectLeader">Téléphone</label>
                    <input type="text" id="inputProjectLeader" class="form-control" value="">
                  </div>
                  <div class="form-group">
                   <a href="<?php echo e(route('clear.records')); ?>" class="btn bubbly-button btn-lg">
                      Vider La liste des entrés
                    </a>

                  </div>

                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">Budget</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="inputEstimatedBudget">Séance Libre</label>
                    <input type="number" id="inputEstimatedBudget" class="form-control" value="2300" step="1">
                  </div>
                  <div class="form-group">
                    <label for="inputSpentBudget">Assurance</label>
                    <input type="number" id="inputSpentBudget" class="form-control" value="2000" step="1">
                  </div>
                  <div class="form-group">
                    <label for="inputEstimatedDuration">Tarif Puce</label>
                    <input type="number" id="inputEstimatedDuration" class="form-control" value="20" step="0.1">
                  </div>
                </div>
              </div>
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Files</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body p-0">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>File Name</th>
                        <th>File Size</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Stockage</td>
                        <td>49.8005 kb</td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info">
                              <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      <tr>
                        <td>Logo</td>
                        <td>28.4883 kb</td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info">
                              <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      <tr>
                        <td>Exporter BDD</td>
                        <td>57.9003 kb</td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info">
                              <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      <tr>
                        <td>Logo.png</td>
                        <td>50.5190 kb</td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info">
                              <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                        </td>
                      <tr>
                        <td>Contract-10_12_2014.docx</td>
                        <td>44.9715 kb</td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info">
                              <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
                            </a>
                          </div>
                        </td>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <a href="#" class="btn btn-secondary">Cancel</a>
              <input type="submit" value="Save Changes" class="btn btn-success float-right">
            </div>
          </div>
        </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>