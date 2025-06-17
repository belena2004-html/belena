<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('dokter/add') ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Data Dokter
    </a>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Dokter</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokter</th>
                            <th>Poliklinik</th>
                            <th>No. Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dokter as $d) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $d->nama_dokter; ?></td>
                                <td><?= $d->nama_poli; ?></td>
                                <td><?= $d->no_telepon_dokter; ?></td>
                                <td>
                                    <a href="<?= base_url('dokter/edit/') . $d->id_dokter; ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('dokter/delete/') . $d->id_dokter; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>