<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="<?= base_url('poli/add') ?>" method="POST">
                        <div class="form-group">
                            <label for="nama_poli">Nama Poliklinik</label>
                            <input type="text" name="nama_poli" id="nama_poli" class="form-control" value="<?= set_value('nama_poli'); ?>">
                            <?= form_error('nama_poli', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <a href="<?= base_url('poli') ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>