<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Jenjang_model extends CI_Model
{

    function get_data()
    {
        return $this->db->get('jenjang')->result();
    }

    public function get_row($id)
    {
        $this->db->where('mahasiswa.id_fakultas', $id);
        $this->db->join('fakultas', 'fakultas.id_fakultas = mahasiswa.id_fakultas', 'left');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left');
        $this->db->join('jenjang', 'jenjang.id_jenjang = mahasiswa.id_jenjang', 'left');
        return   $this->db->get('mahasiswa');
    }
}

