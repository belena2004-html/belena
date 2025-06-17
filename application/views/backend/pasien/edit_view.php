<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <form action="<?= base_url('pasien/edit/' . $pasien->id_pasien) ?>" method="POST">
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Data Diri Pasien</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_pasien">Nama Lengkap</label>
                            <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" value="<?= $pasien->nama_pasien; ?>">
                            <?= form_error('nama_pasien', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" name="nik" id="nik" class="form-control" value="<?= $pasien->nik; ?>">
                            <?= form_error('nik', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $pasien->tempat_lahir; ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $pasien->tanggal_lahir; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="L" <?= ($pasien->jenis_kelamin == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                                <option value="P" <?= ($pasien->jenis_kelamin == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_telepon">No. Telepon</label>
                            <input type="text" name="no_telepon" id="no_telepon" class="form-control" value="<?= $pasien->no_telepon; ?>">
                            <?= form_error('no_telepon', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control"><?= $pasien->alamat; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Data Akun Login</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="<?= $pasien->username; ?>">
                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="password">Password Baru</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                            <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a href="<?= base_url('pasien') ?>" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Update Data Pasien</button>
    </form>
</div>