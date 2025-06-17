<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pasien_model');
		$this->load->model('Poli_model');
		$this->load->model('Dokter_model');
		$this->load->model('Pendaftaran_model');
		$this->load->library('form_validation');
	}

	// Halaman Dashboard Pasien (setelah login)
	public function dashboard()
	{
		// Proteksi halaman
		if (!current_user() || current_user()->level != 'pasien') {
			redirect(base_url());
		}

		$current_user_data = current_user();
		$pasien_data = $this->db->get_where('pasien', ['id_user' => $current_user_data->id_user])->row();

		$data = [
			'title' => 'Dashboard Pasien',
			'pasien' => $pasien_data,
			'riwayat' => $this->Pasien_model->get_riwayat_pendaftaran($pasien_data->id_pasien)
		];

		$this->load->view('frontend/templates/_header', $data);
		$this->load->view('frontend/dashboard_view', $data);
		$this->load->view('frontend/templates/_footer', $data);
	}

	// Halaman Form Pendaftaran Berobat
	public function pendaftaran()
	{
		if (!current_user() || current_user()->level != 'pasien') {
			redirect(base_url());
		}

		$data = [
			'title' => 'Form Pendaftaran Berobat',
			'poli'  => $this->Poli_model->get_all()
		];

		$this->load->view('frontend/templates/_header', $data);
		$this->load->view('frontend/form_pendaftaran_view', $data);
		$this->load->view('frontend/templates/_footer', $data);
	}

	// Proses simpan pendaftaran berobat
	public function proses_pendaftaran()
	{
		if (!current_user() || current_user()->level != 'pasien') {
			redirect(base_url());
		}

		$this->form_validation->set_rules('id_dokter', 'Dokter', 'required');
		$this->form_validation->set_rules('tanggal_kunjungan', 'Tanggal Kunjungan', 'required');
		$this->form_validation->set_rules('keluhan', 'Keluhan', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$this->pendaftaran(); // Kembali ke form jika gagal
		} else {
			$pasien = $this->db->get_where('pasien', ['id_user' => current_user()->id_user])->row();
			$data = [
				'kode_pendaftaran' => 'REG' . time(),
				'id_pasien' => $pasien->id_pasien,
				'id_dokter' => $this->input->post('id_dokter'),
				'keluhan' => $this->input->post('keluhan'),
				'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan'),
				'jam_kunjungan' => $this->input->post('jam_kunjungan'),
				'status_pendaftaran' => 'Menunggu Persetujuan'
			];

			$this->db->insert('pendaftaran', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pendaftaran berobat berhasil dikirim! Silakan tunggu konfirmasi dari admin.</div>');
			redirect('dashboard_pasien');
		}
	}

	// Endpoint untuk AJAX
	public function get_dokter_by_poli()
	{
		$id_poli = $this->input->post('id_poli');
		$dokter = $this->db->get_where('dokter', ['id_poli' => $id_poli])->result();
		echo json_encode($dokter);
	}
}
