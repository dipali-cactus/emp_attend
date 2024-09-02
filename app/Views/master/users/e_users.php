<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= esc($title); ?></h1>

  <a href="<?= base_url('master/users'); ?>" class="btn btn-light bg-gradient-light border btn-icon-split mb-4 rounded-0">
    <span class="icon text-white">
      <i class="fas fa-chevron-left"></i>
    </span>
    <span class="text">Back</span>
  </a>

  <?php
    //echo "<br><br> User <br><br>";
    //echo var_dump($users);exit;
  ?>

  <div class="row justify-content-center">
    <form action="<?= base_url('master/e_users/' . esc($users['username'])); ?>" method="POST" class="col-lg-5 col-md-6 col-sm-12 p-0">
      <div class="card rounded-0">
        <h5 class="card-header">Users Master Data</h5>
        <div class="card-body">
          <h5 class="card-title">Edit Users</h5>
          <p class="card-text">Form to edit users in system</p>

          <!-- CSRF Token -->
          <?= csrf_field(); ?>

          <div class="form-group">
            <label for="u_username" class="col-form-label-lg">Username</label>
            <input type="text" readonly class="form-control-plaintext form-control-lg" name="u_username" id="u_username" value="<?= esc($users['username']); ?>">
          </div>

          <div class="form-group">
            <label for="password" class="col-form-label-lg">Reset Password</label>
            <input type="password" class="form-control form-control-lg" name="password" id="password">
            <?php if (isset($validation) && $validation->getError('password')): ?>
              <small class="text-danger"><?= $validation->getError('password'); ?></small>
            <?php endif; ?>
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
