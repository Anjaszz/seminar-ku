<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar_model extends CI_Model {

    public function getFakultas() {
        return $this->db->get('fakultas')->result();
    }

    public function getJenjang() {
        return $this->db->get('jenjang')->result();
    }

    public function get_prodi_by_fakultas($id_fakultas) {
        $this->db->where('id_fakultas', $id_fakultas);
        return $this->db->get('prodi')->result();
    }

    public function simpanMahasiswa($data) {
        $this->db->insert('mahasiswa', $data);
        return $this->db->insert_id(); // Mengembalikan ID mahasiswa yang baru saja disimpan
    }
    
    public function simpanUserMhs($data) {
        return $this->db->insert('user_mhs', $data);
    }
    
}
