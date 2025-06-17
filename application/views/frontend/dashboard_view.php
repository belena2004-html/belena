<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">Profil Pasien</div>
            <div class="card-body">
                <p><strong>No. RM:</strong> <?= $pasien->nomor_rekam_medis; ?></p>
                <p><strong>Nama:</strong> <?= $pasien->nama_pasien; ?></p>
                <p><strong>NIK:</strong> <?= $pasien->nik; ?></p>
                <p><strong>No. Telepon:</strong> <?= $pasien->no_telepon; ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Riwayat Pendaftaran</h4>
            <a href="<?= base_url('pendaftaran_berobat') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Pendaftaran Baru</a>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="list-group">
            <?php if (!empty($riwayat)): foreach ($riwayat as $r): ?>
                    <div class="list-group-item">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Dr. <?= $r->nama_dokter ?> (<?= $r->nama_poli ?>)</h5>
                            <small><?= date('d M Y', strtotime($r->tanggal_kunjungan)) ?></small>
                        </div>
                        <p class="mb-1"><?= $r->keluhan ?></p>
                        <?php $badge = ['Disetujui' => 'success', 'Ditolak' => 'danger', 'Menunggu Persetujuan' => 'warning']; ?>
                        <small>Status: <span class="badge badge-<?= $badge[$r->status_pendaftaran] ?>"><?= $r->status_pendaftaran ?></span></small>
                    </div>
                <?php endforeach;
            else: ?>
                <div class="alert alert-info">Belum ada riwayat pendaftaran.</div>
            <?php endif; ?>
        </div>
    </div>
</div>