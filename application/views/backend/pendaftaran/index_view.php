<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <div>
            <a href="<?= base_url('pendaftaran/export_csv') ?>" class="btn btn-success btn-icon-split mr-2">
                <span class="icon text-white-50"><i class="fas fa-file-csv"></i></span>
                <span class="text">Export ke CSV</span>
            </a>
            <a href="<?= base_url('pendaftaran/export_pdf') ?>" target="_blank" class="btn btn-danger btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-file-pdf"></i></span>
                <span class="text">Export ke PDF</span>
            </a>
        </div>
    </div>
    <?= $this->session->flashdata('message'); ?>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Persetujuan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_menunggu; ?></div>
                        </div>
                        <div class="col-auto"><a href="<?= base_url('pendaftaran?status=Menunggu Persetujuan') ?>"><i class="fas fa-clock fa-2x text-gray-300"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Disetujui</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_disetujui; ?></div>
                        </div>
                        <div class="col-auto"><a href="<?= base_url('pendaftaran?status=Disetujui') ?>"><i class="fas fa-check-circle fa-2x text-gray-300"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Ditolak</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_ditolak; ?></div>
                        </div>
                        <div class="col-auto"><a href="<?= base_url('pendaftaran?status=Ditolak') ?>"><i class="fas fa-times-circle fa-2x text-gray-300"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Semua Pendaftaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Pasien</th>
                            <th>Dokter Tujuan</th>
                            <th>Tgl Kunjungan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendaftaran as $p) : ?>
                            <tr>
                                <td><?= $p->kode_pendaftaran; ?></td>
                                <td><?= $p->nama_pasien; ?></td>
                                <td><?= $p->nama_dokter; ?> (<?= $p->nama_poli; ?>)</td>
                                <td><?= date('d M Y', strtotime($p->tanggal_kunjungan)); ?></td>
                                <td>
                                    <?php
                                    $badge = 'secondary';
                                    if ($p->status_pendaftaran == 'Disetujui') $badge = 'success';
                                    if ($p->status_pendaftaran == 'Ditolak') $badge = 'danger';
                                    if ($p->status_pendaftaran == 'Menunggu Persetujuan') $badge = 'warning';
                                    ?>
                                    <span class="badge badge-<?= $badge; ?>"><?= $p->status_pendaftaran; ?></span>
                                </td>
                                <td>
                                    <a href="<?= base_url('pendaftaran/detail/') . $p->id_pendaftaran; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <?php if ($p->status_pendaftaran == 'Menunggu Persetujuan') : ?>
                                        <a href="<?= base_url('pendaftaran/approve/') . $p->id_pendaftaran; ?>" class="btn btn-sm btn-success" onclick="return confirm('Setujui pendaftaran ini?')"><i class="fas fa-check"></i></a>
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#rejectModal" data-id="<?= $p->id_pendaftaran; ?>"><i class="fas fa-times"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('pendaftaran/reject_process') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_pendaftaran" id="id_pendaftaran_modal">
                    <div class="form-group">
                        <label for="keterangan_admin">Alasan Penolakan</label>
                        <textarea name="keterangan_admin" id="keterangan_admin" class="form-control" rows="3" required></textarea>
                        <small>Contoh: Jadwal dokter penuh, silahkan pilih jadwal lain.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Pendaftaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#rejectModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang memicu modal
            var pendaftaranId = button.data('id'); // Ambil data-id dari tombol
            var modal = $(this);
            modal.find('.modal-body #id_pendaftaran_modal').val(pendaftaranId);
        });
    });
</script>