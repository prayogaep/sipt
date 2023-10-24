<?= $this->extend('main') ?>
<?= $this->section('content') ?>
<?php
$from = $_GET ? $_GET['from'] : date('Y-m-d');
$to = $_GET ? $_GET['to'] : date('Y-m-d');
?>
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
                    <h4 class="card-title mb-0 flex-grow-1"><?= $title ?></h4>
                    <div class="flex-shrink-0">
                        <!-- <label class="form-label mb-0">Filter</label> -->
                        <form action="/responden/export" method="get" class="d-inline">
                            <input type="hidden" value="<?= $from; ?>" name="from" class="form-control" placeholder="From" required>
                            <input type="hidden" value="<?= $to; ?>" name="to" class="form-control" placeholder="To">
                            <button type="submit" class="btn btn-success">Export Excel</button>
                        </form>
                        <!-- <a href="/produk/create" class="btn btn-primary">+ Tambah Produk</a> -->
                    </div>
                </div><!-- end card header -->

                <div class="card-body">

                    <form action="/responden/show" method="get" class="d-inline">
                        <div class="row mb-3 ">
                            <div class="col-3">
                                <input type="date" value="<?= $from; ?>" name="from" class="form-control" placeholder="From" required>
                            </div>
                            <div class="col-3">
                                <input type="date" value="<?= $to; ?>" name="to" class="form-control" placeholder="To">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Responden</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($responden as $r) { ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= date('d-m-Y', strtotime($r['tanggal'])); ?></td>
                                            <td><?= $r['nama_responden']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $r['id_responden'] ?>">
                                                    Lihat Jawaban
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Button trigger modal -->


                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $r['id_responden'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Responden : <?= $r['nama_responden'] ?> | Rating : <?php for ($i = 0; $i < $r['rating']; $i++) {
                                                                                                                                                                    echo "⭐";
                                                                                                                                                                } ?></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul>
                                                            <li>Bagaimana kesan pertama anda saat mengunjungi toko kami ?</li>
                                                            <p><?= $r['pertanyaan_1'] ?></p>
                                                            <li>Bagaimana penilaian anda terhadap ketersediaan produk yang anda cari selama mengunjungi toko ?</li>
                                                            <p><?= $r['pertanyaan_2'] ?></p>
                                                            <li>Bagaimana penilaian anda terhadap keramahan dan kesopanan staf toko selama mengunjungi toko ?</li>
                                                            <p><?= $r['pertanyaan_3'] ?></p>
                                                            <li>Bagaimaan penilaian anda terhadap kecepatan efisiensi proses pembayaran di kasir ?</li>
                                                            <p><?= $r['pertanyaan_4'] ?></p>
                                                            <li>Sejauh mana anda puas dengan kualitas produk yang anda beli di toko ?</li>
                                                            <p><?= $r['pertanyaan_5'] ?></p>
                                                            <li>Apakah anda merasa bahwa staff toko memberikan informasi yang cukup tentang produk, harga dan promosi yang berlangsung ?</li>
                                                            <p><?= $r['pertanyaan_6'] ?></p>
                                                            <li>Apakah anda merasa kebersihan dan kerapihan toko memenuhi standar yang diharapkan ?</li>
                                                            <p><?= $r['pertanyaan_7'] ?></p>
                                                            <li>Apakah anda puas dengan responsivitas staf toko ketika anda membutuhkan bantuan atau informasi tambahan ?</li>
                                                            <p><?= $r['pertanyaan_8'] ?></p>
                                                            <li>Apakah anda puas dengan pengalaman berbelanja ?</li>
                                                            <p><?= $r['pertanyaan_9'] ?></p>
                                                            <li>Apakah anda merekomendasikan toko ini kepada teman atau keluarga berdasarkan pengalaman anda ?</li>
                                                            <p><?= $r['pertanyaan_10'] ?></p>
                                                        </ul>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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