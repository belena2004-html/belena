<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4 col-lg-8">
        <div class="card-body">
            <form action="<?= base_url('user/add') ?>" method="POST">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= set_value('nama_lengkap'); ?>">
                    <?= form_error('nama_lengkap', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    <select name="level" class="form-control">
                        <option value="">-- Pilih Level --</option>
                        <option value="admin" <?= set_select('level', 'admin'); ?>>Admin</option>
                        <option value="pasien" <?= set_select('level', 'pasien'); ?>>Pasien</option>
                    </select>
                    <?= form_error('level', '<small class="text-danger">', '</small>'); ?>
                </div>
                <a href="<?= base_url('user') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>