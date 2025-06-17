<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DokterController extends CI_Controller
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
        $this->load->model('Dokter_model');
        $this->load->model('Poli_model'); // Kita butuh ini untuk form
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Dokter',
            'pages' => 'Data Dokter',
            'dokter'  => $this->Dokter_model->get_all()
        ];

        $this->load->view('backend/templates/_header', $data);
        $this->load->view('backend/templates/_sidebar', $data);
        $this->load->view('backend/templates/_topbar', $data);
        $this->load->view('backend/dokter/index_view', $data);
        $this->load->view('backend/templates/_footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'required|trim');
        $this->form_validation->set_rules('id_poli', 'Poliklinik', 'required');
        $this->form_validation->set_rules('no_telepon_dokter', 'No. Telepon', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Tambah Data Dokter',
                'pages' => 'Data Dokter',
                'poli'  => $this->Poli_model->get_all() // Mengambil data poli untuk dropdown
            ];
            $this->load->view('backend/templates/_header', $data);
            $this->load->view('backend/templates/_sidebar', $data);
            $this->load->view('backend/templates/_topbar', $data);
            $this->load->view('backend/dokter/add_view', $data);
            $this->load->view('backend/templates/_footer');
        } else {
            $data = [
                'nama_dokter' => $this->input->post('nama_dokter'),
                'id_poli' => $this->input->post('id_poli'),
                'no_telepon_dokter' => $this->input->post('no_telepon_dokter')
            ];
            $this->Dokter_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dokter berhasil ditambahkan!</div>');
            redirect('dokter');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama_dokter', 'Nama Dokter', 'required|trim');
        $this->form_validation->set_rules('id_poli', 'Poliklinik', 'required');
        $this->form_validation->set_rules('no_telepon_dokter', 'No. Telepon', 'required|trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Edit Data Dokter',
                'pages' => 'Data Dokter',
                'dokter'  => $this->Dokter_model->get_by_id($id),
                'poli'  => $this->Poli_model->get_all()
            ];
            if (!$data['dokter']) show_404();

            $this->load->view('backend/templates/_header', $data);
            $this->load->view('backend/templates/_sidebar', $data);
            $this->load->view('backend/templates/_topbar', $data);
            $this->load->view('backend/dokter/edit_view', $data);
            $this->load->view('backend/templates/_footer');
        } else {
            $data = [
                'nama_dokter' => $this->input->post('nama_dokter'),
                'id_poli' => $this->input->post('id_poli'),
                'no_telepon_dokter' => $this->input->post('no_telepon_dokter')
            ];
            $this->Dokter_model->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dokter berhasil diperbarui!</div>');
            redirect('dokter');
        }
    }

    public function delete($id)
    {
        if ($this->Dokter_model->delete($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data dokter berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus! Data dokter ini mungkin sedang digunakan di tabel pendaftaran.</div>');
        }
        redirect('dokter');
    }
}
