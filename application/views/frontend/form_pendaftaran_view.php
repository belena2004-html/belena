<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4>Formulir Pendaftaran Kunjungan</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('pendaftaran_berobat/proses') ?>" method="POST">
                    <div class="form-group">
                        <label for="id_poli">Pilih Poliklinik</label>
                        <select name="id_poli" id="id_poli" class="form-control" required>
                            <option value="">-- Silakan Pilih --</option>
                            <?php foreach ($poli as $p) : ?>
                                <option value="<?= $p->id_poli; ?>"><?= $p->nama_poli; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_dokter">Pilih Dokter</label>
                        <select name="id_dokter" id="id_dokter" class="form-control" required disabled>
                            <option value="">-- Pilih Poli Terlebih Dahulu --</option>
                        </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jam_kunjungan">Jam Kunjungan</label>
                            <input type="time" name="jam_kunjungan" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keluhan">Keluhan Penyakit</label>
                        <textarea name="keluhan" class="form-control" rows="4" required></textarea>
                    </div>
                    <a href="<?= base_url('dashboard_pasien') ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // AJAX untuk dropdown dokter dinamis
    $(document).ready(function() {
        $('#id_poli').change(function() {
            var id_poli = $(this).val();
            if (id_poli != '') {
                $.ajax({
                    url: "<?= base_url('welcome/get_dokter_by_poli'); ?>",
                    method: "POST",
                    data: {
                        id_poli: id_poli
                    },
                    dataType: "JSON",
                    success: function(data) {
                        var html = '<option value="">-- Pilih Dokter --</option>';
                        for (var i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].id_dokter + '">' + data[i].nama_dokter + '</option>';
                        }
                        $('#id_dokter').html(html).prop('disabled', false);
                    }
                });
            } else {
                $('#id_dokter').html('<option value="">-- Pilih Poli Terlebih Dahulu --</option>').prop('disabled', true);
            }
        });
    });
</script>