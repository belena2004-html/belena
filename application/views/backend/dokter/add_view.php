<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="<?= base_url('dokter/add') ?>" method="POST" class="col-lg-8">
                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" name="nama_dokter" class="form-control" value="<?= set_value('nama_dokter'); ?>">
                    <?= form_error('nama_dokter', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="id_poli">Poliklinik</label>
                    <select name="id_poli" class="form-control">
                        <option value="">-- Pilih Poliklinik --</option>
                        <?php foreach ($poli as $p) : ?>
                            <option value="<?= $p->id_poli; ?>" <?= set_select('id_poli', $p->id_poli); ?>><?= $p->nama_poli; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('id_poli', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="no_telepon_dokter">No. Telepon</label>
                    <input type="text" name="no_telepon_dokter" class="form-control" value="<?= set_value('no_telepon_dokter'); ?>">
                    <?= form_error('no_telepon_dokter', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <a href="<?= base_url('dokter') ?>" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>