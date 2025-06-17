<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4 col-lg-8">
        <div class="card-body">
            <form action="<?= base_url('user/edit/' . $user->id_user) ?>" method="POST">
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $user->nama_lengkap; ?>">
                    <?= form_error('nama_lengkap', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" value="<?= $user->username; ?>">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="level">Level</label>
                    <select name="level" class="form-control">
                        <option value="admin" <?= ($user->level == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="pasien" <?= ($user->level == 'pasien') ? 'selected' : ''; ?>>Pasien</option>
                    </select>
                    <?= form_error('level', '<small class="text-danger">', '</small>'); ?>
                </div>
                <a href="<?= base_url('user') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>