<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= esc($title); ?></h1>

    <a href="<?= base_url('master'); ?>" class="btn btn-sm btn-default bg-gradient-light border rounded-0 btn-icon-split mb-4">
        <span class="icon text-white">
            <i class="fas fa-chevron-left"></i>
        </span>
        <span class="text">Back</span>
    </a>
    
    <div class="row justify-content-center">
        <form action="<?= base_url('master/addDepartment'); ?>" method="POST" class="col-lg-5 col-md-6 col-sm-12 p-0">
            <div class="card rounded-0">
                <h5 class="card-header">Department Master Data</h5>
                <div class="card-body">
                    <h5 class="card-title">Add New Department</h5>
                    <p class="card-text">Form to add new department to system</p>
                    
                    <!-- Flashdata for messages -->
                    <?= session()->getFlashdata('message') ?>

                    <div class="form-group">
                        <label for="d_id" class="col-form-label-lg">Department ID</label>
                        <input type="text" class="form-control form-control-lg" autofocus name="d_id" id="d_id" value="<?= old('d_id') ?>">
                        <?= isset($validation) ? $validation->getError('d_id', '<small class="text-danger">', '</small>') : '' ?>
                    </div>

                    <div class="form-group">
                        <label for="d_name" class="col-form-label-lg">Department Name</label>
                        <input type="text" class="form-control form-control-lg" name="d_name" id="d_name" value="<?= old('d_name') ?>">
                        <?= isset($validation) ? $validation->getError('d_name', '<small class="text-danger">', '</small>') : '' ?>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0">
                        <span class="icon text-white">
                            <i class="fas fa-plus-circle"></i>
                        </span>
                        <span class="text">Save</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
