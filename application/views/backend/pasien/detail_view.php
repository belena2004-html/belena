<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Biodata Pasien</h6>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">No. Rekam Medis</dt>
                        <dd class="col-sm-8"><?= $pasien->nomor_rekam_medis; ?></dd>
                        <dt class="col-sm-4">Nama Lengkap</dt>
                        <dd class="col-sm-8"><?= $pasien->nama_pasien; ?></dd>
                        <dt class="col-sm-4">NIK</dt>
                        <dd class="col-sm-8"><?= $pasien->nik; ?></dd>
                        <dt class="col-sm-4">Kelahiran</dt>
                        <dd class="col-sm-8"><?= $pasien->tempat_lahir; ?>, <?= date('d F Y', strtotime($pasien->tanggal_lahir)); ?></dd>
                        <dt class="col-sm-4">Jenis Kelamin</dt>
                        <dd class="col-sm-8"><?= ($pasien->jenis_kelamin == 'L') ? 'Laki-laki' : 'Perempuan'; ?></dd>
                        <dt class="col-sm-4">No. Telepon</dt>
                        <dd class="col-sm-8"><?= $pasien->no_telepon; ?></dd>
                        <dt class="col-sm-4">Alamat</dt>
                        <dd class="col-sm-8"><?= $pasien->alamat; ?></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Akun Login</h6>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Username</dt>
                        <dd class="col-sm-8"><?= $pasien->username; ?></dd>
                        <dt class="col-sm-4">Level</dt>
                        <dd class="col-sm-8"><span class="badge badge-info">Pasien</span></dd>
                    </dl>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Pendaftaran</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php if (!empty($riwayat)): foreach ($riwayat as $r): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong class="d-block"><?= $r->nama_dokter ?></strong>
                                        <small><?= date('d M Y', strtotime($r->tanggal_kunjungan)) ?> - <?= $r->kode_pendaftaran ?></small>
                                    </div>
                                    <span class="badge badge-primary badge-pill"><?= $r->status_pendaftaran ?></span>
                                </li>
                            <?php endforeach;
                        else: ?>
                            <li class="list-group-item">Belum ada riwayat pendaftaran.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <a href="<?= base_url('pasien') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>