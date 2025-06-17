<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Proteksi Halaman: Cukup pastikan user sudah login.
		if (!current_user()) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu!</div>');
			redirect('login');
		}
		// Load semua model yang mungkin dibutuhkan
		$this->load->model('Pendaftaran_model');
		$this->load->model('Pasien_model');
	}

	public function index()
	{
		$level = current_user()->level;

		if ($level == 'admin') {
			$this->admin_dashboard();
		} else {
			redirect('logout');
		}
	}

	// Fungsi untuk menampilkan dashboard admin
	private function admin_dashboard()
	{
		// Mengambil data registrasi harian dari model
		$daily_data_raw = $this->Pendaftaran_model->get_daily_registrations(7);

		// --- Memproses data untuk Chart.js ---
		$chart_labels = [];
		$chart_data = [];

		// Siapkan array untuk 7 hari terakhir
		for ($i = 6; $i >= 0; $i--) {
			$date = date('Y-m-d', strtotime("-$i days"));
			$chart_labels[] = date('d M', strtotime($date)); // Format label (misal: 16 Jun)

			// Cari data untuk tanggal ini
			$found = false;
			foreach ($daily_data_raw as $row) {
				if ($row['registration_date'] == $date) {
					$chart_data[] = (int) $row['total'];
					$found = true;
					break;
				}
			}
			// Jika tidak ada pendaftaran pada hari itu, isikan 0
			if (!$found) {
				$chart_data[] = 0;
			}
		}

		$data = [
			'title' => 'Dashboard Admin',
			'pages' => 'Dashboard',
			'count_menunggu' => $this->Pendaftaran_model->count_by_status('Menunggu Persetujuan'),
			'count_disetujui' => $this->Pendaftaran_model->count_by_status('Disetujui'),
			'count_ditolak' => $this->Pendaftaran_model->count_by_status('Ditolak'),
			'count_pasien' => $this->db->count_all_results('pasien'),
			'chart_labels' => json_encode($chart_labels),
			'chart_data' => json_encode($chart_data)
		];

		$this->load->view('backend/templates/_header', $data);
		$this->load->view('backend/templates/_sidebar', $data);
		$this->load->view('backend/templates/_topbar', $data);
		$this->load->view('backend/index', $data);
		$this->load->view('backend/templates/_footer');
	}

	// 1. Method untuk menampilkan halaman profil
	public function profile()
	{
		$data = [
			'title' => 'Edit Profil',
			'pages' => 'Profil', // Untuk penanda menu jika ada
			'user'  => current_user() // Mengambil data user yang sedang login
		];

		$this->load->view('backend/templates/_header', $data);
		$this->load->view('backend/templates/_sidebar', $data);
		$this->load->view('backend/templates/_topbar', $data);
		$this->load->view('backend/profile/index_view', $data); // View baru untuk form profil
		$this->load->view('backend/templates/_footer');
	}

	// 2. Method untuk memproses update profil
	public function update_profile()
	{
		$currentUser = current_user();

		// Aturan validasi dinamis untuk username
		$is_unique_username = ($this->input->post('username') != $currentUser->username) ? '|is_unique[users.username]' : '';
		$this->form_validation->set_rules('username', 'Username', 'required|trim' . $is_unique_username);
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');

		// Validasi password hanya jika field diisi
		if (!empty($this->input->post('password'))) {
			$this->form_validation->set_rules('password', 'Password Baru', 'trim|min_length[6]');
			$this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'trim|required|matches[password]');
		}

		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, kembali ke halaman profil
			$this->profile();
		} else {
			// Jika validasi berhasil
			$id = $currentUser->id_user;
			$data = [
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'username' => $this->input->post('username')
			];

			// Cek jika ada input password baru
			if (!empty($this->input->post('password'))) {
				$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			}

			// Update data ke database via model
			if ($this->User_model->update($id, $data)) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil berhasil diperbarui!</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal memperbarui profil!</div>');
			}
			redirect('profile');
		}
	}

	public function jadwal()
	{
		$data = [
			'title' => 'Jadwal Pendaftaran Pasien',
			'pages' => 'Jadwal Pendaftaran',
		];

		$this->load->view('backend/templates/_header', $data);
		$this->load->view('backend/templates/_sidebar', $data);
		$this->load->view('backend/templates/_topbar', $data);
		$this->load->view('backend/jadwal_view', $data);
		$this->load->view('backend/templates/_footer');
	}
}
