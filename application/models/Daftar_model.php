<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_model extends CI_Model {

    public function getFakultas() {
        return $this->db->get('fakultas')->result();
    }

    public function getProdi() {
        return $this->db->get('prodi')->result();
    }

    public function get_prodi_by_fakultas($id_fakultas) {
        $this->db->where('id_fakultas', $id_fakultas);
        return $this->db->get('prodi')->result();
    }

    public function simpanMahasiswa($data) {
        $this->db->insert('mahasiswa', $data);
        return $this->db->insert_id(); // Mengembalikan ID yang baru saja dimasukkan
    }

    public function simpanUserMhs($data) {
        $this->db->insert('user_mhs', $data);
        return $this->db->affected_rows() > 0; // Mengembalikan true jika berhasil
    }

    public function get_last_nim_count($year, $month) {
        $this->db->like('nim', $year . $month, 'after'); // Mencari NIM yang dimulai dengan tahun dan bulan
        return $this->db->count_all_results('mahasiswa'); // Menghitung jumlah NIM yang ditemukan
    }
    
}
