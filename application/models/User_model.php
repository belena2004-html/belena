<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $_table = "users";

    public function get_all()
    {
        // Mengambil semua data dari tabel users
        return $this->db->order_by('nama_lengkap', 'ASC')->get($this->_table)->result();
    }

    public function get_by_id($id)
    {
        // Mengambil satu baris data berdasarkan id_user
        return $this->db->get_where($this->_table, ["id_user" => $id])->row();
    }

    public function insert($data)
    {
        // Menyimpan data baru ke tabel
        return $this->db->insert($this->_table, $data);
    }

    public function update($id, $data)
    {
        // Memperbarui data di tabel berdasarkan id
        return $this->db->update($this->_table, $data, array('id_user' => $id));
    }

    public function delete($id)
    {
        // Menghapus data dari tabel
        return $this->db->delete($this->_table, array("id_user" => $id));
    }
}
