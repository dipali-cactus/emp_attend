<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-flex w-100 align-items-center">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <h1 class="h3 mb-0 text-gray-800"><?= esc($title); ?></h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
      <!-- You can add additional buttons or content here if needed -->
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <?= session()->getFlashdata('message'); ?>
    </div>
  </div>

  <!-- Data Table Users-->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-dark">DataTables Users</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>EmpID</th>
              <th>Employee</th>
              <th>Dept.ID</th>
              <th>Username</th>
              <th>Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php
            $i = 1;
            foreach ($data as $dt) :
            ?>
              <tr>
                <td class="align-middle"><?= esc($i++); ?></td>
                <td class="align-middle"><?= esc($dt['e_id']); ?></td>
                <td class="align-middle"><?= esc($dt['e_name']); ?></td>
                <td class="align-middle"><?= esc($dt['d_id']); ?></td>
                <?php if (!empty($dt['u_username'])) : ?>
                  <td class="align-middle text-center"><?= esc($dt['u_username']); ?></td>
                  <td class="text-center align-middle">
                    <a href="<?= base_url('master/e_users/' . esc($dt['u_username'])); ?>" class="btn btn-primary rounded-0 btn-sm text-xs">
                      <span class="icon text-white" title="Edit">
                        <i class="fas fa-edit"></i>
                      </span>
                    </a> |
                    <a href="<?= base_url('master/d_users/' . esc($dt['u_username'])); ?>" class="btn btn-danger rounded-0 btn-sm text-xs" onclick="return confirm('Deleted Users will lost forever. Still want to delete?')">
                      <span class="icon text-white" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                      </span>
                    </a>
                  </td>
                <?php else : ?>
                  <td class="align-middle text-center">
                    <?php
                    /*
                    <a href="<?= base_url('master/a_users/' . esc($dt['e_id']) . '/' . esc($dt['d_id'])); ?>" class="btn btn-primary btn-sm bg-gradient-primary rounded-pill px-3">Create Account</a>
                    */
                    ?>
                    <a href="<?= base_url('master/a_users/' . esc($dt['e_id'])); ?>" class="btn btn-primary btn-sm bg-gradient-primary rounded-pill px-3">Create Account</a>
                  </td>
                  <td class="text-center align-middle">
                    <button class="btn btn-primary rounded-0 btn-sm text-xs" disabled>
                      <span class="icon text-white" title="Edit">
                        <i class="fas fa-edit"></i>
                      </span>
                    </button> |
                    <button class="btn btn-danger rounded-0 btn-sm text-xs" disabled>
                      <span class="icon text-white" title="Delete">
                        <i class="fas fa-trash-alt"></i>
                      </span>
                    </button>
                  </td>
                <?php endif; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
