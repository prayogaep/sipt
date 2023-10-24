<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"><?= $title; ?></h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= $title; ?></a></li>
                    <li class="breadcrumb-item active">Tambah Produk</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tambah Produk</h4>
                        <div class="flex-shrink-0">
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <form action="/produk" method="post" enctype="multipart/form-data">
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div>
                                            <label for="iconInput" class="form-label">Nama Produk</label>
                                            <div class="form-icon">
                                                <input type="text" class="form-control form-control-icon" name="nama_produk" id="iconInput" placeholder="Nama Produk" required>
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div>
                                            <label for="iconInput" class="form-label">Foto</label>
                                            <div class="form-icon">
                                                <input type="file" class="form-control form-control-icon" name="foto" id="iconInput" placeholder="foto" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div>
                                            <label for="iconInput" class="form-label">Deskripsi</label>
                                            <div class="form-icon">
                                                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control"></textarea>
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