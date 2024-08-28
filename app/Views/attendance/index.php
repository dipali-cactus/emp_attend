<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= esc($title); ?></h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col">
      <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
          <div class="card shadow mb-4" style="min-height: 543px">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-dark">Stamp your Attendance!</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <?php if ($weekends === true) : ?>
                <h1 class="text-center my-3">THANK YOU FOR THIS WEEK!</h1>
                <h5 class="card-title text-center mb-4 px-4">Have a Good Rest this <b>WEEKEND</b></h5>
                <b><p class="text-center text-dark pt-3">See You on Monday!</p></b>
                <div class="row">
                  <button disabled class="btn btn-danger rounded-0 btn-sm text-xs mx-auto" style="font-size: 35px; width: 200px; height: 200px">
                    <i class="fas fa-fw fa-sign-out-alt fa-2x"></i>
                  </button>
                </div>
              <?php else : ?>
                <?php if ($in === false) : ?>
                  <?= form_open_multipart('attendance') ?>
                  <div class="row mb-3">
                    <div class="col-lg-5">
                      <input type="hidden" name="work_shift" value="<?= esc($account['shift']); ?>">
                      <label for="work_shift" class="col-form-label">Work Shift</label>
                      <input class="form-control" type="text" placeholder="<?= esc(date("h:i A", strtotime('2022-06-23 ' . $startTime))); ?> - <?= esc(date("h:i A", strtotime('2022-06-23 ' . $endTime))); ?>" value="<?= esc(date("h:i A", strtotime('2022-06-23 ' . $startTime))); ?> - <?= esc(date("h:i A", strtotime('2022-06-23 ' . $endTime))); ?>" readonly>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                      <label for="location" class="col-form-label">Time In Location</label>
                      <select class="form-control" name="location" id="location">
                        <?php foreach ($location as $lct) : ?>
                          <option value="<?= esc($lct['id']); ?>"><?= esc($lct['id']); ?> = <?= esc($lct['name']); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-lg-5 text-center">
                      <div class="ro
