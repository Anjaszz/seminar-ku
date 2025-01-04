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

    
    public function total_transaksi_by_vendor($id_vendor)
    {
        // Menghitung total jumlah dari transaksi_user berdasarkan id_vendor
        $this->db->select_sum('jumlah'); // Mengambil jumlah dari kolom jumlah
        $this->db->from('transaksi_user'); // Tabel transaksi_user
        $this->db->where('id_admin', $id_vendor); // Filter berdasarkan id_vendor
        
        $query = $this->db->get(); // Eksekusi query
        return $query->row()->jumlah; // Mengembalikan total jumlah
    }


    public function get_monthly_income_by_vendor($id_vendor)
    {
        $this->db->select('MONTH(tgl_transaksi) as month, SUM(jumlah) as total');
        $this->db->from('transaksi_user');
        $this->db->where('id_admin', $id_vendor);
        $this->db->where('YEAR(tgl_transaksi)', date('Y'));
        $this->db->group_by('MONTH(tgl_transaksi)');
        $this->db->order_by('month', 'ASC');
        return $this->db->get()->result();
    }


    public function get_vendor_by_id($id_vendor) {
        $this->db->select('nama_vendor');
        $this->db->from('users');
        $this->db->where('id_vendor', $id_vendor);
        return $this->db->get()->row();
    }

    public function get_email_by_admin_id($admin_id)
    {
        $this->db->select('email');
        $this->db->from('master_admin');
        $this->db->where('id', $admin_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->email; // Mengembalikan email
        }
        return null; // Jika tidak ditemukan
    }

    public function get_email_by_vendor_id($admin_id)
    {
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where('id_vendor', $admin_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->email; // Mengembalikan email
        }
        return null; // Jika tidak ditemukan
    }
}

