<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('pasien/add') ?>" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Pasien Baru</a>
    <?= $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No. RM</th>
                            <th>Nama Pasien</th>
                            <th>NIK</th>
                            <th>Tgl Lahir</th>
                            <th>No. Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pasien as $p) : ?>
                            <tr>
                                <td><?= $p->nomor_rekam_medis; ?></td>
                                <td><?= $p->nama_pasien; ?></td>
                                <td><?= $p->nik; ?></td>
                                <td><?= date('d M Y', strtotime($p->tanggal_lahir)); ?></td>
                                <td><?= $p->no_telepon; ?></td>
                                <td>
                                    <a href="<?= base_url('pasien/detail/') . $p->id_pasien; ?>" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('pasien/edit/') . $p->id_pasien; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                    <a href="<?= base_url('pasien/delete/') . $p->id_pasien; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Menghapus data pasien juga akan menghapus akun loginnya. Yakin?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>