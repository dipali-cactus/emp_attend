<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center mt-5 pt-5">

    <div class="col-xl-6 col-lg-7 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-3">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Employee Attendance System</h1>
                  <hr>
                </div>

                <?php if (session()->getFlashdata('message')): ?>
                    <div class="alert alert-info">
                        <?= session()->getFlashdata('message'); ?>
                    </div>
                <?php endif; ?>

                <form class="user" method="post" action="<?= base_url(); ?>">
                  <div class="form-group mt-4">
                    <input type="text" class="form-control form-control-user" name="username" placeholder="Username (example: CDM023)">
                    <?php if(isset($validation) && $validation->hasError('username')): ?>
                        <small class="text-danger pl-3"><?= $validation->getError('username'); ?></small>
                    <?php endif; ?>
                  </div>
                  <div class="form-group mt-4 mb-4">
                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                    <?php if(isset($validation) && $validation->hasError('password')): ?>
                        <small class="text-danger pl-3"><?= $validation->getError('password'); ?></small>
                    <?php endif; ?>
                  </div>
                  <button class="btn btn-primary bg-gradient-primary btn-user btn-block mt-4" type="submit">
                    Login
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>
