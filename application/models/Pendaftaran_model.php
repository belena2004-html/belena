<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model
{
    private $_table = "pendaftaran";

    public function get_all($status = null)
    {
        $this->db->select('pendaftaran.*, pasien.nama_pasien, dokter.nama_dokter, poli.nama_poli');
        $this->db->from($this->_table);
        $this->db->join('pasien', 'pendaftaran.id_pasien = pasien.id_pasien');
        $this->db->join('dokter', 'pendaftaran.id_dokter = dokter.id_dokter');
        $this->db->join('poli', 'dokter.id_poli = poli.id_poli');

        // Filter berdasarkan status jika disediakan
        if ($status) {
            $this->db->where('pendaftaran.status_pendaftaran', $status);
        }

        $this->db->order_by('pendaftaran.tanggal_pendaftaran', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('pendaftaran.*, pasien.*, dokter.nama_dokter, poli.nama_poli');
        $this->db->from($this->_table);
        $this->db->join('pasien', 'pendaftaran.id_pasien = pasien.id_pasien');
        $this->db->join('dokter', 'pendaftaran.id_dokter = dokter.id_dokter');
        $this->db->join('poli', 'dokter.id_poli = poli.id_poli');
        $this->db->where('pendaftaran.id_pendaftaran', $id);
        return $this->db->get()->row();
    }

    public function update_status($id, $status, $keterangan = null)
    {
        $data = [
            'status_pendaftaran' => $status,
            'keterangan_admin' => $keterangan
        ];
        return $this->db->update($this->_table, $data, array('id_pendaftaran' => $id));
    }

    public function count_by_status($status = null)
    {
        if ($status) {
            $this->db->where('status_pendaftaran', $status);
        }
        return $this->db->count_all_results($this->_table);
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id_pendaftaran" => $id));
    }

    public function get_daily_registrations($days = 7)
    {
        $this->db->select('DATE(tanggal_pendaftaran) as registration_date, COUNT(id_pendaftaran) as total');
        $this->db->from($this->_table);
        $this->db->where('tanggal_pendaftaran >=', date('Y-m-d', strtotime("-$days days")));
        $this->db->group_by('DATE(tanggal_pendaftaran)');
        $this->db->order_by('registration_date', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }
}
