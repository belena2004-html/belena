<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Profil</h6>
                </div>
                <div class="card-body">
                    <?= $this->session->flashdata('message'); ?>

                    <form action="<?= base_url('update_profile') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" value="<?= $user->nama_lengkap; ?>">
                            <?= form_error('nama_lengkap', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $user->username; ?>">
                            <?= form_error('username', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                        <hr>
                        <p class="font-weight-bold">Ubah Password</p>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <small class="form-text text-muted">Kosongkan jika Anda tidak ingin mengubah password.</small>
                            <?= form_error('password', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password_confirm">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirm" id="password_confirm" class="form-control">
                            <?= form_error('password_confirm', '<small class="text-danger pl-2">', '</small>'); ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profil</button>
                        <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Foto Profil</h6>
                </div>
                <div class="card-body text-center">
                    <img class="img-profile rounded-circle mb-3" src="<?= base_url('assets/img/undraw_profile.svg') ?>" style="max-width: 150px;">
                    <h5 class="font-weight-bold"><?= $user->nama_lengkap; ?></h5>
                    <p class="text-muted"><?= $user->username; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>