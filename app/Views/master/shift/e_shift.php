<!-- Begin Page Content -->
<div class="container-fluid mb-3">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= esc($title); ?></h1>

  <a href="<?= base_url('master/shift'); ?>" class="btn btn-light bg-gradient-light border rounded-0 btn-icon-split mb-4">
    <span class="icon text-white">
      <i class="fas fa-chevron-left"></i>
    </span>
    <span class="text">Back</span>
  </a>

  <div class="row justify-content-center">
    <form action="<?= current_url(); ?>" method="POST" class="col-lg-5 p-0">
      <div class="card rounded-0">
        <h5 class="card-header">Shift Master Data</h5>
        <div class="card-body">
          <?= session()->getFlashdata('message'); ?>
          <h5 class="card-title">Edit Shift</h5>
          <p class="card-text">Form to edit shift in the system</p>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label col-form-label-lg">Shift Number</label>
            <div class="col-sm-4">
              <input type="text" readonly class="form-control-plaintext form-control-lg" value="<?= esc($s_id); ?>">
            </div>
          </div>
          <?= isset($validation) ? '<small class="text-danger">' . $validation->getError('s_id') . '</small>' : '' ?>

          <div class="form-group">
            <label for="s_start_h" class="col-form-label-lg">Shift Start Time</label>
            <div class="row">
              <div class="col-sm-4">
                <input type="number" class="form-control form-control-lg" name="s_start_h" id="s_start_h" max="23" min="0" value="<?= esc(old('s_start_h', $s_sh)); ?>">
                <?= isset($validation) ? '<small class="text-danger">' . $validation->getError('s_start_h') . '</small>' : '' ?>
              </div>
              <div class="col-sm-4">
                <input type="number" class="form-control form-control-lg" name="s_start_m" id="s_start_m" max="59" min="0" value="<?= esc(old('s_start_m', $s_sm)); ?>">
                <?= isset($validation) ? '<small class="text-danger">' . $validation->getError('s_start_m') . '</small>' : '' ?>
              </div>
              <div class="col-sm-4">
                <input type="number" class="form-control form-control-lg" name="s_start_s" id="s_start_s" max="59" min="0" value="<?= esc(old('s_start_s', $s_ss)); ?>">
                <?= isset($validation) ? '<small class="text-danger">' . $validation->getError('s_start_s') . '</small>' : '' ?>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="s_end_h" class="col-form-label-lg">Shift End Time</label>
            <div class="row">
              <div class="col-sm-4">
                <input type="number" class="form-control form-control-lg" name="s_end_h" id="s_end_h" max="23" min="0" value="<?= esc(old('s_end_h', $s_eh)); ?>">
                <?= isset($validation) ? '<small class="text-danger">' . $validation->getError('s_end_h') . '</small>' : '' ?>
              </div>
              <div class="col-sm-4">
                <input type="number" class="form-control form-control-lg" name="s_end_m" id="s_end_m" max="59" min="0" value="<?= esc(old('s_end_m', $s_em)); ?>">
                <?= isset($validation) ? '<small class="text-danger">' . $validation->getError('s_end_m') . '</small>' : '' ?>
              </div>
              <div class="col-sm-4">
                <input type="number" class="form-control form-control-lg" name="s_end_s" id="s_end_s" max="59" min="0" value="<?= esc(old('s_end_s', $s_es)); ?>">
                <?= isset($validation) ? '<small class="text-danger">' . $validation->getError('s_end_s') . '</small>' : '' ?>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0">
            <span class="icon text-white">
              <i class="fas fa-check"></i>
            </span>
            <span class="text">Save Change</span>
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
