<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!current_user() || current_user()->level != 'admin') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda tidak memiliki akses!</div>');
            redirect('login');
        }
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title' => 'Data User',
            'pages' => 'Data User',
            'users' => $this->User_model->get_all()
        ];

        $this->load->view('backend/templates/_header', $data);
        $this->load->view('backend/templates/_sidebar', $data);
        $this->load->view('backend/templates/_topbar', $data);
        $this->load->view('backend/user/index_view', $data);
        $this->load->view('backend/templates/_footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = ['title' => 'Tambah Data User', 'pages' => 'Data User'];
            $this->load->view('backend/templates/_header', $data);
            $this->load->view('backend/templates/_sidebar', $data);
            $this->load->view('backend/templates/_topbar', $data);
            $this->load->view('backend/user/add_view', $data);
            $this->load->view('backend/templates/_footer');
        } else {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level' => $this->input->post('level')
            ];
            $this->User_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data user berhasil ditambahkan!</div>');
            redirect('user');
        }
    }

    public function edit($id)
    {
        $user = $this->User_model->get_by_id($id);
        if (!$user) show_404();

        // Aturan validasi dinamis untuk username
        $is_unique_username = ($this->input->post('username') != $user->username) ? '|is_unique[users.username]' : '';
        $this->form_validation->set_rules('username', 'Username', 'required|trim' . $is_unique_username);
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('level', 'Level', 'required');

        // Password bersifat opsional
        if (!empty($this->input->post('password'))) {
            $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]');
        }

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Edit Data User',
                'pages' => 'Data User',
                'user'  => $user
            ];
            $this->load->view('backend/templates/_header', $data);
            $this->load->view('backend/templates/_sidebar', $data);
            $this->load->view('backend/templates/_topbar', $data);
            $this->load->view('backend/user/edit_view', $data);
            $this->load->view('backend/templates/_footer');
        } else {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'username' => $this->input->post('username'),
                'level' => $this->input->post('level')
            ];
            // Jika admin mengisi password, update passwordnya
            if (!empty($this->input->post('password'))) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $this->User_model->update($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data user berhasil diperbarui!</div>');
            redirect('user');
        }
    }

    public function delete($id)
    {
        // Mencegah admin menghapus akunnya sendiri
        if ($id == current_user()->id_user) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Anda tidak dapat menghapus akun Anda sendiri!</div>');
        } else {
            if ($this->User_model->delete($id)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data user berhasil dihapus!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus data user!</div>');
            }
        }
        redirect('user');
    }
}
