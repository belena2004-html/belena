<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien_model extends CI_Model
{
    // Mengambil semua data pasien
    public function get_all()
    {
        return $this->db->order_by('nama_pasien', 'ASC')->get('pasien')->result();
    }

    // Mengambil data pasien tunggal beserta data user-nya
    public function get_by_id($id_pasien)
    {
        $this->db->select('pasien.*, users.username');
        $this->db->from('pasien');
        $this->db->join('users', 'pasien.id_user = users.id_user');
        $this->db->where('pasien.id_pasien', $id_pasien);
        return $this->db->get()->row();
    }

    // Mengambil riwayat pendaftaran seorang pasien
    public function get_riwayat_pendaftaran($id_pasien)
    {
        $this->db->select('pendaftaran.*, dokter.nama_dokter, poli.nama_poli');
        $this->db->from('pendaftaran');
        $this->db->join('dokter', 'pendaftaran.id_dokter = dokter.id_dokter');
        $this->db->join('poli', 'dokter.id_poli = poli.id_poli');
        $this->db->where('pendaftaran.id_pasien', $id_pasien);
        $this->db->order_by('pendaftaran.tanggal_kunjungan', 'DESC');
        return $this->db->get()->result();
    }

    // Proses penambahan data pasien baru (transaksional)
    public function insert($data_user, $data_pasien)
    {
        $this->db->trans_start();

        // 1. Insert ke tabel users
        $this->db->insert('users', $data_user);

        // 2. Ambil ID user yang baru saja dibuat
        $id_user_baru = $this->db->insert_id();

        // 3. Tambahkan id_user ke data pasien
        $data_pasien['id_user'] = $id_user_baru;

        // 4. Insert ke tabel pasien
        $this->db->insert('pasien', $data_pasien);

        $this->db->trans_complete();

        // Mengembalikan status transaksi
        return $this->db->trans_status();
    }

    // Proses update data pasien (melibatkan 2 tabel)
    public function update($id_pasien, $id_user, $data_pasien, $data_user)
    {
        $this->db->trans_start();

        // Update tabel users
        if (!empty($data_user)) {
            $this->db->update('users', $data_user, ['id_user' => $id_user]);
        }

        // Update tabel pasien
        $this->db->update('pasien', $data_pasien, ['id_pasien' => $id_pasien]);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
