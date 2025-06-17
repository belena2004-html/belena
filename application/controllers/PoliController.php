<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PoliController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Proteksi halaman
        if (!current_user()) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda harus login terlebih dahulu!</div>');
            redirect('login');
        }

        // Load model dan library
        $this->load->model('Poli_model');
        $this->load->library('form_validation');
    }

    // Method untuk menampilkan semua data
    public function index()
    {
        $data = [
            'title' => 'Data Poliklinik',
            'pages' => 'Data Poli',
            'poli'  => $this->Poli_model->get_all()
        ];

        $this->load->view('backend/templates/_header', $data);
        $this->load->view('backend/templates/_sidebar', $data);
        $this->load->view('backend/templates/_topbar', $data);
        $this->load->view('backend/poli/index_view', $data);
        $this->load->view('backend/templates/_footer');
    }

    // Method untuk menambah data
    public function add()
    {
        $this->form_validation->set_rules('nama_poli', 'Nama Poli', 'required|trim|is_unique[poli.nama_poli]');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form tambah
            $data = [
                'title' => 'Tambah Data Poli',
                'pages' => 'Data Poli'
            ];
            $this->load->view('backend/templates/_header', $data);
            $this->load->view('backend/templates/_sidebar', $data);
            $this->load->view('backend/templates/_topbar', $data);
            $this->load->view('backend/poli/add_view', $data);
            $this->load->view('backend/templates/_footer');
        } else {
            // Jika validasi berhasil, simpan data
            $data = ['nama_poli' => $this->input->post('nama_poli')];
            $this->Poli_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data poli berhasil ditambahkan!</div>');
            redirect('poli');
        }
    }

    // Method untuk mengedit data
    public function edit($id)
    {
        // Ambil data asli dari database untuk perbandingan
        $original_data = $this->Poli_model->get_by_id($id);
        $original_name = $original_data->nama_poli;

        // Dapatkan nama poli yang di-submit dari form
        $submitted_name = $this->input->post('nama_poli');

        $is_unique_rule = '';
        // Aturan is_unique hanya diterapkan jika nama yang di-submit berbeda dari nama asli
        if ($submitted_name != $original_name) {
            $is_unique_rule = '|is_unique[poli.nama_poli]';
        }

        // Gabungkan aturan validasi
        $this->form_validation->set_rules('nama_poli', 'Nama Poli', 'required|trim' . $is_unique_rule);

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $data = [
                'title' => 'Edit Data Poli',
                'pages' => 'Data Poli',
                'poli'  => $original_data
            ];

            // Cek jika data poli tidak ditemukan
            if (!$data['poli']) {
                show_404();
            }

            $this->load->view('backend/templates/_header', $data);
            $this->load->view('backend/templates/_sidebar', $data);
            $this->load->view('backend/templates/_topbar', $data);
            $this->load->view('backend/poli/edit_view', $data);
            $this->load->view('backend/templates/_footer');
        } else {
            // Jika validasi berhasil
            $data = ['nama_poli' => $this->input->post('nama_poli')];
            $this->Poli_model->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data poli berhasil diperbarui!</div>');
            redirect('poli');
        }
    }

    // Method untuk menghapus data
    public function delete($id)
    {
        if ($this->Poli_model->delete($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data poli berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus! Data poli ini mungkin sedang digunakan di tabel lain.</div>');
        }
        redirect('poli');
    }
}
