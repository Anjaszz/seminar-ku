<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_master_model extends CI_Model {

    public function get_laporan_keuangan() {
        $this->db->select('transaksi_master.id_transaksi, transaksi_master.tgl_transaksi, transaksi_master.jumlah_masuk, users.nama_vendor');
        $this->db->from('transaksi_master');
        $this->db->join('users', 'transaksi_master.id_vendor = users.id_vendor', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function total_pemasukan() {
        $this->db->select_sum('jumlah_masuk');
        $query = $this->db->get('transaksi_master');
        return $query->row()->jumlah_masuk;
    }

    public function get_monthly_income() {
        $this->db->select('MONTH(tgl_transaksi) as month, YEAR(tgl_transaksi) as year, SUM(jumlah_masuk) as total');
        $this->db->from('transaksi_master');
        $this->db->group_by('YEAR(tgl_transaksi), MONTH(tgl_transaksi)');
        $this->db->order_by('YEAR(tgl_transaksi), MONTH(tgl_transaksi)');
        $query = $this->db->get();
        return $query->result_array();
    }
}
