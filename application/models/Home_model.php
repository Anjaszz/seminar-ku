<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home_model extends CI_Model
{

    public function total($table)
    {
        return $this->db->get($table)->num_rows();
    }

    public function get_vendor_by_id($id_vendor) {
        $this->db->select('nama_vendor');
        $this->db->from('users');
        $this->db->where('id_vendor', $id_vendor);
        return $this->db->get()->row();
    }
}

