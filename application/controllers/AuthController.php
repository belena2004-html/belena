<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Logikanya dibalik: jika SUDAH login, tendang ke dashboard
        if (current_user()) {
            if (current_user()->level == 'admin') {
                redirect('dashboard');
            } else {
                redirect('dashboard_pasien');
            }
        }

        $data['title'] = "Login & Registrasi";
        $this->load->view('auth/login_view', $data);
    }

    public function process_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login_view', ['title' => '/']);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('users', ['username' => $username])->row_array();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // --- PERUBAHAN DI SINI ---
                    // Tidak lagi menolak pasien, cukup verifikasi level ada
                    if ($user['level'] == 'admin') {

                        // Buat sesi untuk admin yang berhasil login
                        $data_session = [
                            'id_user'  => $user['id_user'],
                            'is_login' => TRUE,
                            'level'    => $user['level']
                        ];
                        $this->session->set_userdata($data_session);

                        // Arahkan admin ke dashboard
                        redirect('dashboard');
                    } elseif ($user['level'] == 'pasien') {

                        // Buat sesi untuk pasien yang berhasil login
                        $data_session = [
                            'id_user'  => $user['id_user'],
                            'is_login' => TRUE,
                            'level'    => $user['level']
                        ];
                        $this->session->set_userdata($data_session);

                        // Arahkan pasien ke dashboard_pasien
                        redirect('dashboard_pasien');
                    } else {
                        // Untuk level lain yang mungkin ada di masa depan
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Level pengguna tidak valid!</div>');
                        redirect('/');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                    redirect('/');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');
                redirect('/');
            }
        }
    }

    public function register()
    {
        // Logika validasi dipindahkan dari Welcome.php ke sini
        $this->form_validation->set_rules('nama_pasien', 'Nama Lengkap', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|is_unique[pasien.nik]|exact_length[16]|numeric', ['is_unique' => 'NIK ini sudah terdaftar!']);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]|min_length[5]', ['is_unique' => 'Username ini sudah digunakan!']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('validation_errors', validation_errors('<div class="alert alert-danger p-2" role="alert">', '</div>'));
            redirect(base_url('login#pills-register')); // Kembali ke tab registrasi
        } else {
            $data_user = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_pasien', true)),
                'username'     => htmlspecialchars($this->input->post('username', true)),
                'password'     => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'level'        => 'pasien'
            ];
            $data_pasien = [
                'nomor_rekam_medis' => 'RM' . time(),
                'nik'               => htmlspecialchars($this->input->post('nik', true)),
                'nama_pasien'       => htmlspecialchars($this->input->post('nama_pasien', true)),
                'no_telepon'        => htmlspecialchars($this->input->post('no_telepon', true)),
                'tempat_lahir'      => '',
                'tanggal_lahir'     => date('Y-m-d'),
                'jenis_kelamin'     => 'L',
                'alamat'            => ''
            ];

            if ($this->Pasien_model->insert($data_user, $data_pasien)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Registrasi Berhasil!</strong> Silakan login.</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><strong>Registrasi Gagal!</strong></div>');
            }
            redirect('login');
        }
    }

    public function logout()
    {
        // Hancurkan semua session
        $this->session->sess_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil logout.</div>');
        redirect('/');
    }
}
