<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-flex w-100 align-items-center">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <h1 class="h3 mb-0 text-gray-800"><?= esc($title); ?></h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
      <a href="<?= base_url('admin') ?>" class="btn btn-md btn-light bg-gradient-light border rounded-0 mb-2 btn-icon-split">
        <span class="icon text-white-600">
          <i class="fas fa-angle-left"></i>
        </span>
        <span class="text">Add Back</span>
      </a>
    </div>
  </div>
  <hr>
  <div class="card rounded-0 shadow mb-3">
    <div class="card-body">
      <fieldset class="border rounded-0 px-2 pb-2">
        <legend class="ml-3 px-3 w-auto">Filter Report</legend>
        <form action="" method="GET">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
              <input type="date" name="start" class="form-control form-control-sm rounded-0" value="<?= isset($start) ? esc($start) : ''?>">
              <?= isset($validation) && $validation->getError('start') ? '<small class="text-danger pl-3">' . $validation->getError('start') . '</small>' : '' ?>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <input type="date" name="end" class="form-control form-control-sm rounded-0" value="<?= isset($end) ? esc($end) : ''?>">
              <?= isset($validation) && $validation->getError('end') ? '<small class="text-danger pl-3">' . $validation->getError('end') . '</small>' : '' ?>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <select class="form-control form-control-sm rounded-0" name="dept">
                <option disabled>Department</option>
                <?php foreach ($department as $d) : ?>
                  <option <?= esc($dept_code) == $d['id'] ? 'selected' : '' ?> value="<?= esc($d['id']); ?>"><?= esc($d['id']); ?></option>
                <?php endforeach; ?>
              </select>
              <?= isset($validation) && $validation->getError('dept') ? '<small class="text-danger pl-3">' . $validation->getError('dept') . '</small>' : '' ?>
            </div>
            <div class="col-2">
              <button type="submit" class="btn btn-primary btn-sm rounded-0 bg-gradient-primary "><i class="fa fa-file"></i> Show Report</button>
            </div>
          </div>
        </form>
      </fieldset>
    </div>
  </div>
  <!-- End of row show -->
  <?php if (empty($attendance)) : ?>
    <h3 class="text-center my-5">Please Choose Department and Dates. No Data found for this dates.</h3>
  <?php else : ?>
    <div class="card shadow mb-4 rounded-0">
      <div class="card-header py-3">
        <div class="d-flex w-100 align-items-center">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <h6 class="m-0 font-weight-bold text-dark">Data Attendance</h6>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 text-right">
            <a href="<?= base_url('report/print/' . esc($start) . '/' . esc($end) . '/' . esc($dept_code)) ?>" target="_blank" class="btn btn-sm btn-light bg-gradient-light border shadow-sm rounded-0">
              <i class="fas fa-download fa-sm text-dark"></i> Print Report
            </a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-gradient-primary text-white">
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Name</th>
                <th>Shift</th>
                <th>Time In</th>
                <th>Notes</th>
                <th>Lack Of</th>
                <th>In Status</th>
                <th>Time Out</th>
                <th>Out Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; foreach ($attendance as $atd) : ?>
                <tr>
                  <th class="p-1 align-middle text-center"><?= esc($i++) ?></th>
                  <td class="p-1 align-middle"><?= date('Y-m-d', esc($atd['date'])) ?></td>
                  <td class="p-1 align-middle"><?= esc($atd['name']) ?></td>
                  <td class="p-1 align-middle">
                    <div style="line-height:1em">
                      <div class="text-xs"><?= date("h:i A", strtotime('2022-06-23 ' . esc($atd['start']))) ?></div>
                      <div class="text-xs"><?= date("h:i A", strtotime('2022-06-23 ' . esc($atd['end']))) ?></div>
                    </div>
                  </td>
                  <td class="p-1 align-middle"><?= date('h:i:s A', esc($atd['date'])) ?></td>
                  <td class="p-1 align-middle"><?= empty($atd['notes']) ? 'Unfilled' : esc($atd['notes']) ?></td>
                  <td class="p-1 align-middle"><?= esc($atd['lack_of']); ?></td>
                  <td class="p-1 align-middle"><?= esc($atd['in_status']); ?></td>
                  <td class="p-1 align-middle"><?= $atd['out_time'] > 0 ? date('h:i:s A', esc($atd['out_time'])) : 'Haven\'t Checked Out'; ?></td>
                  <td class="p-1 align-middle"><?= esc($atd['out_status']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
