<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <a href="<?= site_url('master/employee'); ?>" class="btn btn-light bg-gradient-light border btn-icon-split mb-4 rounded-0">
    <span class="icon text-white">
      <i class="fas fa-chevron-left"></i>
    </span>
    <span class="text">Back</span>
  </a>

  <form action="<?= site_url('master/e_employee/' . $employee['id']) ?>" method="post" enctype="multipart/form-data">
  <div class="col-lg p-0">
    <?= session()->getFlashdata('message') ?>
    <div class="row justify-content-center">
      <div class="col-lg-3">
        <div class="card rounded-0 shadow" style="width: 100%; height: 100%">
          <img src="<?= site_url('images/pp/' . $employee['image']); ?>" class="card-img-top w-75 mx-auto pt-3">
          <div class="card-body mt-3">
            <label for="image">Change Employee Image</label>
            <input type="file" name="image" id="image" class="mt-2">
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card rounded-0 shadow">
          <h5 class="card-header">Employee Master Data</h5>
          <div class="card-body">
            <h5 class="card-title">Edit Employee</h5>
            <p class="card-text">Form to edit employee in the system</p>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="employee_id" class="col-form-label">Employee ID</label>
                  <input type="text" readonly class="form-control-plaintext" name="e_id" value="<?= $employee['id']; ?>">
                </div>
              </div>
              <div class="col-lg-8">
                <div class="form-group">
                  <label for="e_name" class="col-form-label">Employee Name</label>
                  <input type="text" class="form-control" name="e_name" id="e_name" value="<?= $employee['name']; ?>">
                  <?php if (isset($validation) && $validation->hasError('e_name')): ?>
                      <small class="text-danger"><?= $validation->getError('e_name'); ?></small>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="e_gender" class="col-form-label">Gender</label>
                  <div class="row col-lg">
                    <div class="form-check form-check-inline my-0">
                      <input class="form-check-input" type="radio" name="e_gender" id="m" value="M" <?= $employee['gender'] == 'M' ? 'checked' : ''; ?>>
                      <label class="form-check-label" for="m">
                        Male
                      </label>
                      <?php if (isset($validation) && $validation->hasError('e_gender')): ?>
                          <small class="text-danger"><?= $validation->getError('e_gender'); ?></small>
                      <?php endif; ?>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="e_gender" id="f" value="F" <?= $employee['gender'] == 'F' ? 'checked' : ''; ?>>
                      <label class="form-check-label" for="f">
                        Female
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="e_birth_date" class="col-form-label">Employee D.O.B</label>
                  <div class="col-lg p-0">
                    <input type="date" class="form-control" name="e_birth_date" id="e_birth_date" min="1990-01-01" max="2002-01-01" value="<?= $employee['birth_date']; ?>">
                    <?php if (isset($validation) && $validation->hasError('e_birth_date')): ?>
                        <small class="text-danger"><?= $validation->getError('e_birth_date'); ?></small>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label for="e_hire_date" class="col-form-label">Hire Date</label>
                  <div class="col-lg p-0">
                    <input type="date" class="form-control" name="e_hire_date" id="e_hire_date" min="2004-04-16" max="<?= date('Y-m-d'); ?>" value="<?= $employee['hire_date']; ?>">
                    <?php if (isset($validation) && $validation->hasError('e_hire_date')): ?>
                        <small class="text-danger"><?= $validation->getError('e_hire_date'); ?></small>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="s_id" class="col-form-label">Shift</label>
                  <select class="form-control" name="s_id" id="s_id">
                    <?php foreach ($shift as $sft): ?>
                      <option value="<?= $sft['id']; ?>" <?= $sft['id'] == $employee['shift_id'] ? 'selected' : ''; ?>>
                        <?= $sft['id']; ?> <small>(<?= date("h:i A", strtotime('2022-06-23 ' . $sft['start'])); ?> - <?= date("h:i A", strtotime('2022-06-23 ' . $sft['end'])); ?>)</small>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="d_id" class="col-form-label">Department</label>
                  <select class="form-control" name="d_id" id="d_id">
                    <?php foreach ($department as $dpt): ?>
                      <option value="<?= $dpt['id']; ?>" <?= $dpt['id'] == $department_current['department_id'] ? 'selected' : ''; ?>>
                        <?= $dpt['id']; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0">
              <span class="icon text-white">
                <i class="fas fa-check"></i>
              </span>
              <span class="text">Save Changes</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
