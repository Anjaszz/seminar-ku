<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_auth_model extends CI_Model {

    // Fungsi untuk mengecek login berdasarkan email dan password
    public function cek_login($email, $password) {
        // Query untuk mencari data admin berdasarkan email dan password
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('master_admin');

        // Jika data ditemukan, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
}
