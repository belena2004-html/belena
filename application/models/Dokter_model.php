<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter_model extends CI_Model
{
    private $_table = "dokter";

    public function get_all()
    {
        // Mengambil semua data dokter dengan nama polikliniknya
        $this->db->select('dokter.*, poli.nama_poli');
        $this->db->from($this->_table);
        $this->db->join('poli', 'dokter.id_poli = poli.id_poli');
        $this->db->order_by('nama_dokter', 'ASC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        // Mengambil satu baris data dokter berdasarkan id_dokter
        return $this->db->get_where($this->_table, ["id_dokter" => $id])->row();
    }

    public function insert($data)
    {
        // Menyimpan data dokter baru
        return $this->db->insert($this->_table, $data);
    }

    public function update($id, $data)
    {
        // Memperbarui data dokter berdasarkan id
        return $this->db->update($this->_table, $data, array('id_dokter' => $id));
    }

    public function delete($id)
    {
        // Menghapus data dokter
        // Akan gagal jika dokter ini terhubung ke data pendaftaran
        return $this->db->delete($this->_table, array("id_dokter" => $id));
    }
}
