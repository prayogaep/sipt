<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"><?= $title; ?></h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);"><?= $title; ?></a></li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <?php if (session('success')) { ?>
        <!-- success Alert -->
        <div class="alert alert-success" role="alert">
            <strong> <?= session('success'); ?></strong>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Kelola User</h4>
                    <div class="flex-shrink-0">
                        <a href="/user/create" class="btn btn-primary">+ Tambah User</a>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Id</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($users as $u) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $u['id_user']; ?></td>
                                            <td><?= $u['username']; ?></td>
                                            <td><?= $u['nama_role']; ?></td>
                                            <td>
                                                <?php if ($u['id_user'] != session('id_user')) { ?>
                                                    <a href="/user/edit/<?= $u['id_user']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="/user/delete/<?= $u['id_user']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ?')">Delete</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->


    </div>
    <!--end row-->

</div>
<!-- container-fluid -->
<?= $this->endSection() ?>