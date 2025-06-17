<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PendaftaranController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!current_user() || current_user()->level != 'admin') {
            redirect('login');
        }
        $this->load->model('Pendaftaran_model');
    }

    public function index()
    {
        // Ambil status dari query string untuk filtering
        $status = $this->input->get('status');

        $data = [
            'title' => 'Data Pendaftaran',
            'pages' => 'Data Pendaftaran',
            'pendaftaran' => $this->Pendaftaran_model->get_all($status),
            // Data untuk statistik
            'count_menunggu' => $this->Pendaftaran_model->count_by_status('Menunggu Persetujuan'),
            'count_disetujui' => $this->Pendaftaran_model->count_by_status('Disetujui'),
            'count_ditolak' => $this->Pendaftaran_model->count_by_status('Ditolak')
        ];

        $this->load->view('backend/templates/_header', $data);
        $this->load->view('backend/templates/_sidebar', $data);
        $this->load->view('backend/templates/_topbar', $data);
        $this->load->view('backend/pendaftaran/index_view', $data);
        $this->load->view('backend/templates/_footer');
    }

    public function detail($id)
    {
        $pendaftaran = $this->Pendaftaran_model->get_by_id($id);
        if (!$pendaftaran) show_404();

        $data = [
            'title' => 'Detail Pendaftaran',
            'pages' => 'Data Pendaftaran',
            'p'     => $pendaftaran
        ];

        $this->load->view('backend/templates/_header', $data);
        $this->load->view('backend/templates/_sidebar', $data);
        $this->load->view('backend/templates/_topbar', $data);
        $this->load->view('backend/pendaftaran/detail_view', $data);
        $this->load->view('backend/templates/_footer');
    }

    public function approve($id)
    {
        $keterangan = "Pendaftaran Anda telah dikonfirmasi dan disetujui oleh admin.";
        $this->Pendaftaran_model->update_status($id, 'Disetujui', $keterangan);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran berhasil disetujui!</div>');
        redirect('pendaftaran');
    }

    public function reject_process()
    {
        $id = $this->input->post('id_pendaftaran');
        $keterangan = $this->input->post('keterangan_admin');

        $this->Pendaftaran_model->update_status($id, 'Ditolak', $keterangan);
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Pendaftaran telah ditolak.</div>');
        redirect('pendaftaran');
    }

    public function delete($id)
    {
        $this->Pendaftaran_model->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pendaftaran berhasil dihapus!</div>');
        redirect('pendaftaran');
    }

    /**
     * Method ini harus berdiri sendiri dan tidak memuat view template apapun.
     * Ia akan langsung mengirimkan file ke browser dan menghentikan eksekusi.
     */
    public function export_csv()
    {
        // 1. Ambil data dari model
        $pendaftaran_data = $this->Pendaftaran_model->get_all();

        if (empty($pendaftaran_data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada data untuk diexport!</div>');
            redirect('pendaftaran');
        }

        // 2. Siapkan nama file
        $filename = 'laporan_pendaftaran_' . date('Ymd') . '.csv';

        // 3. Set HTTP Headers untuk memicu download file CSV
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // 4. Buka PHP output stream untuk menulis file
        $output = fopen('php://output', 'w');

        // 5. Tulis baris header (judul kolom)
        fputcsv($output, [
            'Kode Pendaftaran',
            'Nama Pasien',
            'NIK',
            'Dokter Tujuan',
            'Poliklinik',
            'Tgl Rencana Kunjungan',
            'Jam Kunjungan',
            'Keluhan',
            'Status Pendaftaran',
            'Tanggal Didaftarkan'
        ]);

        // 6. Loop data dan tulis setiap baris
        foreach ($pendaftaran_data as $p) {
            // Ambil data pasien dari relasi untuk NIK
            // (Asumsi model get_all sudah JOIN dengan pasien atau Anda perlu memanggilnya)
            // Untuk sekarang kita asumsikan NIK ada di objek $p jika sudah di-JOIN
            $pasien_data = $this->db->get_where('pasien', ['id_pasien' => $p->id_pasien])->row();
            $nik = $pasien_data ? $pasien_data->nik : '';

            fputcsv($output, [
                $p->kode_pendaftaran,
                $p->nama_pasien,
                "'" . $nik, // Tambahkan ' di depan NIK agar tidak jadi scientific di Excel
                $p->nama_dokter,
                $p->nama_poli,
                date('d-m-Y', strtotime($p->tanggal_kunjungan)),
                date('H:i', strtotime($p->jam_kunjungan)),
                $p->keluhan,
                $p->status_pendaftaran,
                date('d-m-Y H:i', strtotime($p->tanggal_pendaftaran))
            ]);
        }

        // 7. Tutup stream
        fclose($output);

        // 8. HENTIKAN eksekusi skrip. Ini bagian paling penting!
        exit();
    }

    public function export_pdf()
    {
        $this->load->library('pdf');

        $data['pendaftaran_data'] = $this->Pendaftaran_model->get_all();

        // Pastikan data tidak kosong untuk menghindari error di view
        if (empty($data['pendaftaran_data'])) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada data untuk diexport!</div>');
            redirect('pendaftaran');
        }

        $html = $this->load->view('backend/pendaftaran/laporan_pdf', $data, TRUE);
        $filename = 'Laporan-Pendaftaran-' . date('Ymd');

        // Jika semua sudah benar, kembalikan fungsi generate
        $this->pdf->generate($html, $filename, 'A4', 'portrait');
    }

    /**
     * Endpoint untuk menyediakan data event ke FullCalendar.
     * Hanya menampilkan pendaftaran yang sudah disetujui.
     */
    public function calendar_events()
    {
        // Hanya ambil pendaftaran yang sudah disetujui untuk ditampilkan di jadwal
        $pendaftaran_disetujui = $this->Pendaftaran_model->get_all('Disetujui');

        $events = array();
        foreach ($pendaftaran_disetujui as $p) {
            $events[] = array(
                'id'    => $p->id_pendaftaran,
                'title' => 'Pasien: ' . $p->nama_pasien, // Teks yang muncul di kalender
                'start' => $p->tanggal_kunjungan . 'T' . $p->jam_kunjungan, // Format ISO8601
                'url'   => base_url('pendaftaran/detail/' . $p->id_pendaftaran), // Link saat event diklik
                'description' => 'Dokter: ' . $p->nama_dokter
            );
        }

        // Set header ke JSON dan outputkan data
        header('Content-Type: application/json');
        echo json_encode($events);
    }
}
