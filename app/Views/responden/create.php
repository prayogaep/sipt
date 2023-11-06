<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title><?= $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">

    <!--Swiper slider css-->
    <link href="<?= base_url(); ?>assets/libs/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="<?= base_url(); ?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= base_url(); ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .rating {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotateY(180deg);
            display: flex;
        }

        .rating input {
            display: none;
        }

        .rating label {
            display: block;
            cursor: pointer;
            width: 50px;
            /*background: #ccc;*/
        }

        .rating label:before {
            content: '\f005';
            font-family: fontAwesome;
            position: relative;
            display: block;
            font-size: 50px;
            color: #101010;
        }

        .rating label:after {
            content: '\f005';
            font-family: fontAwesome;
            position: absolute;
            display: block;
            font-size: 50px;
            color: #fffa00;
            top: 0;
            opacity: 0;
            transition: .5s;
            text-shadow: 0 2px 5px rgba(0, 0, 0, .5);
        }

        .rating label:hover:after,
        .rating label:hover~label:after,
        .rating input:checked~label:after {
            opacity: 1;
        }
    </style>

</head>

<body data-bs-spy="scroll" data-bs-target="#navbar-example">

    <!-- Begin page -->
    <div class="layout-wrapper landing">

        <!-- start contact -->
        <section class="section" id="contact">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h3 class="mb-3 fw-semibold">Responden Tulus Company</h3>
                            <p class="text-muted mb-4 ff-secondary">Jawaban dan Penilaian dari anda akan membantu kami memperbaiki pelayanan Tulus Company</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-8">
                        <div>
                            <form action="/responden/<?= $ip; ?>" method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="nama_responden" class="form-label fs-13">Nama</label>
                                            <input name="nama_responden" id="nama_responden" type="text" class="form-control bg-light border-light" placeholder="Nama Lengkap" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="number" class="form-label fs-13">Umur</label>
                                            <input name="umur" id="number" type="number" class="form-control bg-light border-light" placeholder="Umur" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="jenis_kelamin" class="form-label fs-13">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control bg-light border-light" required>
                                                <option value="" selected disabled>- Pilih Jenis Kelamin -</option>
                                                <option value="L">Laki - Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label fs-13">Alamat</label>
                                            <textarea name="alamat" id="alamat" rows="2" class="form-control bg-light border-light" placeholder="Alamat..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="pertanyaan_10" class="form-label fs-13">Dari pengalaman Anda sebagai pelanggan di toko ini, bagaimana penilaian Anda terhadap kualitas keseluruhan pelayanan yang diberikan oleh toko ?
                                        </label>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="rating" class="form-label fs-13">Rate of Service</label>
                                            <div class="rating">
                                                <input type="radio" name="rating" id="star1" value="5"><label for="star1"></label>
                                                <input type="radio" name="rating" id="star2" value="4"><label for="star2"></label>
                                                <input type="radio" name="rating" id="star3" value="3"><label for="star3"></label>
                                                <input type="radio" name="rating" id="star4" value="2"><label for="star4"></label>
                                                <input type="radio" name="rating" id="star5" value="1"><label for="star5"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <input name="ks" id="ks" type="text" class="form-control bg-light border-light" placeholder="Kritik dan Saran" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-end">
                                        <input type="submit" id="submit" name="send" class="submitBnt btn btn-primary" value="Send Message">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <label class="form-label fs-13">Notes : </label>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Rate</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>⭐⭐⭐⭐⭐</td>
                                    <td>Sangat Puas</td>
                                </tr>
                                <tr>
                                    <td>⭐⭐⭐⭐</td>
                                    <td>Puas</td>
                                </tr>
                                <tr>
                                    <td>⭐⭐⭐</td>
                                    <td>Biasa saja</td>
                                </tr>
                                <tr>
                                    <td>⭐⭐</td>
                                    <td>Tidak Puas</td>
                                </tr>
                                <tr>
                                    <td>⭐</td>
                                    <td>Sangat Tidak Puas</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end contact -->

        <!-- start cta -->
        <!-- end cta -->

        <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative">
            <div class="container">

                <div class="row text-center text-sm-start align-items-center mt-5">
                    <div class="col-sm-6">

                        <div>
                            <p class="copy-rights mb-0">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> © SITUS - TULUS
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
        <!-- end footer -->


        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-danger btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->


    <!-- JAVASCRIPT -->
    <script src="<?= base_url(); ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url(); ?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins.js"></script>

    <!--Swiper slider js-->
    <script src="<?= base_url(); ?>assets/libs/swiper/swiper-bundle.min.js"></script>

    <!-- landing init -->
    <script src="<?= base_url(); ?>assets/js/pages/landing.init.js"></script>
</body>

</html>