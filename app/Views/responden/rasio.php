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
    <div class="row justify-content-center">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Penilaian Pelanggan</h4>
                    <div class="flex-shrink-0">
                        <!-- <a href="/produk/create" class="btn btn-primary">+ Tambah Produk</a> -->
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <h1>⭐ <?= $rasio; ?></h1>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->


    </div>
    <div class="row">
        <div class="col-xl">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1"><?= $title ?></h4>
                    <div class="flex-shrink-0">
                        <!-- <a href="/produk/create" class="btn btn-primary">+ Tambah Produk</a> -->
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <canvas id="bar"></canvas>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->


    </div>
    <!--end row-->

</div>
<!-- Chart JS -->
<script src="<?= base_url(); ?>assets/libs/chart.js/chart.min.js"></script>

<script>
    // Data untuk chart bar
    const data = {
        labels: ["⭐","⭐⭐", "⭐⭐⭐", "⭐⭐⭐⭐", "⭐⭐⭐⭐⭐"],
        datasets: [{
            label: "Total",
            data: <?= $count; ?>,
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgb(54, 162, 235)',
            ],
            borderWidth: 1
        }]
    };
    // Konfigurasi chart
    const config = {
        type: 'bar',
        data: data,
        options: {
            legend: {
                display: false // Menonaktifkan legenda (label dataset)
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                subtitle: {
                    display: true,
                    text: 'Count By Rate'
                }
            }
        },
    };

    // Menggambar chart pai
    const ctx = document.getElementById('bar').getContext('2d');
    new Chart(ctx, config);
</script>
<!-- container-fluid -->
<?= $this->endSection() ?>