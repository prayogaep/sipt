<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"><?= $title; ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= $title; ?></a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tambah User</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="/user" method="post">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div>
                                            <label for="iconInput" class="form-label">Username</label>
                                            <div class="form-icon">
                                                <input type="text" class="form-control form-control-icon" name="username" id="iconInput" placeholder="Username" required>
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div>
                                            <label for="iconInput" class="form-label">Password</label>
                                            <div class="form-icon">
                                                <input type="password" class="form-control form-control-icon" name="password" id="iconInput" placeholder="Password" required>
                                                <i class="ri-lock-password-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div>
                                            <label for="iconInput" class="form-label">Role</label>
                                            <div class="form-icon">
                                                <select class="form-select" name="role_id" required>
                                                    <option value="" selected disabled>- Pilih Role-</option>
                                                    <?php foreach ($roles as $r) { ?>
                                                        <option value="<?= $r['id_role'] ?>"><?= $r['nama_role'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            </form>
                            <!--end row-->
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
    </div>
</div>
<?= $this->endSection() ?>