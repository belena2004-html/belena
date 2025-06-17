<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poli_model extends CI_Model
{
    private $_table = "poli";

    public function get_all()
    {
        // Mengambil semua data dari tabel poli, diurutkan berdasarkan nama_poli
        return $this->db->order_by('nama_poli', 'ASC')->get($this->_table)->result();
    }

    public function get_by_id($id)
    {
        // Mengambil satu baris data berdasarkan id_poli
        return $this->db->get_where($this->_table, ["id_poli" => $id])->row();
    }

    public function insert($data)
    {
        // Menyimpan data baru ke tabel
        return $this->db->insert($this->_table, $data);
    }

    public function update($id, $data)
    {
        // Memperbarui data di tabel berdasarkan id
        return $this->db->update($this->_table, $data, array('id_poli' => $id));
    }

    public function delete($id)
    {
        // Menghapus data dari tabel.
        // Jika data terikat oleh foreign key (misal di tabel dokter),
        // maka query ini akan gagal dan mengembalikan FALSE.
        return $this->db->delete($this->_table, array("id_poli" => $id));
    }
}
