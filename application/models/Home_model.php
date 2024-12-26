<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home_model extends CI_Model
{

    public function total($table)
    {
        return $this->db->get($table)->num_rows();
    }

    public function total_mahasiswa_by_vendor($id_vendor)
    {
        $this->db->select('*'); // Ambil semua kolom dari tabel mahasiswa
        $this->db->from('pendaftaran_seminar');
        $this->db->where('id_vendor', $id_vendor); // Filter berdasarkan id_vendor
        return $this->db->get()->result(); // Mengembalikan hasil query
    }

    public function total_sponsor_by_vendor($id_vendor)
    {
        $this->db->select('*'); // Ambil semua kolom dari tabel mahasiswa
        $this->db->from('sponsor');
        $this->db->where('id_vendor', $id_vendor); // Filter berdasarkan id_vendor
        return $this->db->get()->result(); // Mengembalikan hasil query
    }

    public function total_seminar_by_vendor($id_vendor)
    {
        $this->db->select('*'); // Ambil semua kolom dari tabel mahasiswa
        $this->db->from('seminar');
        $this->db->where('id_vendor', $id_vendor); // Filter berdasarkan id_vendor
        return $this->db->get()->result(); // Mengembalikan hasil query
    }

    public function total_tiket_by_vendor($id_vendor)
    {
        // Menghitung total tiket terjual berdasarkan id_vendor
        $this->db->select_sum('tiket_terjual'); // Mengambil jumlah tiket terjual
        $this->db->from('tiket'); // Tabel tiket
        $this->db->where('id_vendor', $id_vendor); // Filter berdasarkan id_vendor
        
        $query = $this->db->get(); // Eksekusi query
        return $query->row()->tiket_terjual; // Mengembalikan total tiket terjual
    }



    public function get_vendor_by_id($id_vendor) {
        $this->db->select('nama_vendor');
        $this->db->from('users');
        $this->db->where('id_vendor', $id_vendor);
        return $this->db->get()->row();
    }
}

