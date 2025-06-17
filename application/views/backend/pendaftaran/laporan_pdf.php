<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-g">
    <title>Laporan Pendaftaran Pasien</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table,
        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Laporan Pendaftaran Pasien</h1>
    <p>Tanggal Cetak: <?= date('d F Y'); ?></p>
    <hr>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Pasien</th>
                <th>Dokter</th>
                <th>Poliklinik</th>
                <th>Tgl Kunjungan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pendaftaran_data)): ?>
                <?php $no = 1;
                foreach ($pendaftaran_data as $p) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $p->kode_pendaftaran; ?></td>
                        <td><?= $p->nama_pasien; ?></td>
                        <td><?= $p->nama_dokter; ?></td>
                        <td><?= $p->nama_poli; ?></td>
                        <td><?= date('d-m-Y', strtotime($p->tanggal_kunjungan)); ?></td>
                        <td><?= $p->status_pendaftaran; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>