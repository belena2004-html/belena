<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?> | RS Sehat Selalu</title>
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block" style="background: url(assets/img/hospital.svg) center; background-size: cover;"></div>
                            <div class="col-lg-6 p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <?= $this->session->flashdata('validation_errors'); ?>

                                <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab">Login</a></li>
                                    <li class="nav-item"><a class="nav-link" id="pills-register-tab" data-toggle="pill" href="#pills-register" role="tab">Registrasi Pasien</a></li>
                                </ul>

                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel">
                                        <p class="text-center small">Untuk Admin & Pasien yang sudah terdaftar.</p>
                                        <form class="user" method="POST" action="<?= base_url('auth/process_login') ?>">
                                            <div class="form-group"><input type="text" class="form-control form-control-user" name="username" placeholder="Username" required></div>
                                            <div class="form-group"><input type="password" class="form-control form-control-user" name="password" placeholder="Password" required></div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="pills-register" role="tabpanel">
                                        <p class="text-center small">Khusus untuk pasien baru.</p>
                                        <form class="user" method="POST" action="<?= base_url('register') ?>">
                                            <div class="form-group"><input type="text" class="form-control form-control-user" name="nama_pasien" placeholder="Nama Lengkap Sesuai KTP" required value="<?= set_value('nama_pasien'); ?>"></div>
                                            <div class="form-group"><input type="text" class="form-control form-control-user" name="nik" placeholder="NIK (16 Digit)" required value="<?= set_value('nik'); ?>"></div>
                                            <div class="form-group"><input type="text" class="form-control form-control-user" name="no_telepon" placeholder="Nomor Telepon Aktif" required value="<?= set_value('no_telepon'); ?>"></div>
                                            <hr>
                                            <div class="form-group"><input type="text" class="form-control form-control-user" name="username" placeholder="Buat Username" required value="<?= set_value('username'); ?>"></div>
                                            <div class="form-group"><input type="password" class="form-control form-control-user" name="password" placeholder="Buat Password" required></div>
                                            <div class="form-group"><input type="password" class="form-control form-control-user" name="password_confirm" placeholder="Konfirmasi Password" required></div>
                                            <button type="submit" class="btn btn-success btn-user btn-block">Daftar Akun Baru</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        $(document).ready(function() {
            if (window.location.hash) {
                $('a[href="' + window.location.hash + '"]').tab('show');
            }
        });
    </script>
</body>

</html>