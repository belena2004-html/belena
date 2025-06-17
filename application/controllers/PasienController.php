<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PasienController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!current_user() || current_user()->level != 'admin') {
            redirect('login');
        }
        $this->load->model('Pasien_model');
        $this->load->model('User_model'); // Diperlukan untuk proses delete
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pasien',
            'pages' => 'Data Pasien',
            'pasien' => $this->Pasien_model->get_all()
        ];
        $this->load->view('backend/templates/_header', $data);
        $this->load->view('backend/templates/_sidebar', $data);
        $this->load->view('backend/templates/_topbar', $data);
        $this->load->view('backend/pasien/index_view', $data);
        $this->load->view('backend/templates/_footer');
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Pasien',
            'pages' => 'Data Pasien',
            'pasien' => $this->Pasien_model->get_by_id($id),
            'riwayat' => $this->Pasien_model->get_riwayat_pendaftaran($id)
        ];
        if (!$data['pasien']) show_404();

        $this->load->view('backend/templates/_header', $data);
        $this->load->view('backend/templates/_sidebar', $data);
        $this->load->view('backend/templates/_topbar', $data);
        $this->load->view('backend/pasien/detail_view', $data);
        $this->load->view('backend/templates/_footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|is_unique[pasien.nik]|exact_length[16]');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = ['title' => 'Tambah Data Pasien', 'pages' => 'Data Pasien'];
            $this->load->view('backend/templates/_header', $data);
            $this->load->view('backend/templates/_sidebar', $data);
            $this->load->view('backend/templates/_topbar', $data);
            $this->load->view('backend/pasien/add_view', $data);
            $this->load->view('backend/templates/_footer');
        } else {
            // Data untuk tabel users
            $data_user = [
                'nama_lengkap' => $this->input->post('nama_pasien'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => 'pasien'
            ];

            // Data untuk tabel pasien
            $data_pasien = [
                'nomor_rekam_medis' => 'RM' . time(), // Contoh generate No RM
                'nik' => $this->input->post('nik'),
                'nama_pasien' => $this->input->post('nama_pasien'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'no_telepon' => $this->input->post('no_telepon')
            ];

            if ($this->Pasien_model->insert($data_user, $data_pasien)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pasien baru berhasil ditambahkan!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan data pasien!</div>');
            }
            redirect('pasien');
        }
    }

    public function edit($id)
    {
        $pasien = $this->Pasien_model->get_by_id($id);
        if (!$pasien) show_404();

        // Aturan validasi dinamis
        $is_unique_nik = ($this->input->post('nik') != $pasien->nik) ? '|is_unique[pasien.nik]' : '';
        $is_unique_username = ($this->input->post('username') != $pasien->username) ? '|is_unique[users.username]' : '';

        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|exact_length[16]' . $is_unique_nik);
        $this->form_validation->set_rules('username', 'Username', 'required|trim' . $is_unique_username);

        if ($this->form_validation->run() == FALSE) {
            $data = ['title' => 'Edit Data Pasien', 'pages' => 'Data Pasien', 'pasien' => $pasien];
            $this->load->view('backend/templates/_header', $data);
            $this->load->view('backend/templates/_sidebar', $data);
            $this->load->view('backend/templates/_topbar', $data);
            $this->load->view('backend/pasien/edit_view', $data);
            $this->load->view('backend/templates/_footer');
        } else {
            $id_user = $pasien->id_user;

            // Data untuk tabel users
            $data_user = [
                'nama_lengkap' => $this->input->post('nama_pasien'),
                'username' => $this->input->post('username')
            ];
            if (!empty($this->input->post('password'))) {
                $data_user['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            // Data untuk tabel pasien
            $data_pasien = [
                'nik' => $this->input->post('nik'),
                'nama_pasien' => $this->input->post('nama_pasien'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat'),
                'no_telepon' => $this->input->post('no_telepon')
            ];

            if ($this->Pasien_model->update($id, $id_user, $data_pasien, $data_user)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pasien berhasil diperbarui!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal memperbarui data pasien!</div>');
            }
            redirect('pasien');
        }
    }

    public function delete($id_pasien)
    {
        // Untuk menghapus pasien, kita hapus user-nya, dan data pasien akan ikut terhapus (ON DELETE CASCADE)
        $pasien = $this->Pasien_model->get_by_id($id_pasien);
        if ($pasien) {
            $this->User_model->delete($pasien->id_user);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pasien berhasil dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data pasien tidak ditemukan!</div>');
        }
        redirect('pasien');
    }
}
