<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?>: <?= $p->kode_pendaftaran; ?></h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Pasien</h6>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Nama</dt>
                        <dd class="col-sm-8"><?= $p->nama_pasien; ?></dd>
                        <dt class="col-sm-4">No. RM</dt>
                        <dd class="col-sm-8"><?= $p->nomor_rekam_medis; ?></dd>
                        <dt class="col-sm-4">NIK</dt>
                        <dd class="col-sm-8"><?= $p->nik; ?></dd>
                        <dt class="col-sm-4">Tgl Lahir</dt>
                        <dd class="col-sm-8"><?= date('d F Y', strtotime($p->tanggal_lahir)); ?></dd>
                        <dt class="col-sm-4">No. Telepon</dt>
                        <dd class="col-sm-8"><?= $p->no_telepon; ?></dd>
                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8"><?= $p->alamat; ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Kunjungan</h6>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Dokter</dt>
                        <dd class="col-sm-8"><?= $p->nama_dokter; ?></dd>
                        <dt class="col-sm-4">Poliklinik</dt>
                        <dd class="col-sm-8"><?= $p->nama_poli; ?></dd>
                        <dt class="col-sm-4">Tgl Kunjungan</dt>
                        <dd class="col-sm-8"><?= date('d F Y', strtotime($p->tanggal_kunjungan)); ?></dd>
                        <dt class="col-sm-4">Jam</dt>
                        <dd class="col-sm-8"><?= date('H:i', strtotime($p->jam_kunjungan)); ?></dd>
                        <dt class="col-sm-4">Keluhan</dt>
                        <dd class="col-sm-8"><?= $p->keluhan; ?></dd>
                        <hr class="col-12">
                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8"><strong><?= $p->status_pendaftaran; ?></strong></dd>
                        <dt class="col-sm-4">Keterangan</dt>
                        <dd class="col-sm-8"><?= $p->keterangan_admin ? $p->keterangan_admin : '-'; ?></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
    <a href="<?= base_url('pendaftaran') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>