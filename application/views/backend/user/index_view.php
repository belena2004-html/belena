<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('user/add') ?>" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Data User
    </a>
    <?= $this->session->flashdata('message'); ?>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($users as $u) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $u->nama_lengkap; ?></td>
                                <td><?= $u->username; ?></td>
                                <td><span class="badge badge-<?= ($u->level == 'admin') ? 'success' : 'info'; ?>"><?= ucfirst($u->level); ?></span></td>
                                <td>
                                    <a href="<?= base_url('user/edit/') . $u->id_user; ?>" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <?php if ($u->id_user != current_user()->id_user) : // Tombol hapus tidak muncul untuk user yg sedang login 
                                    ?>
                                        <a href="<?= base_url('user/delete/') . $u->id_user; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
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