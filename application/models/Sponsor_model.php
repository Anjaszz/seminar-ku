<?php

class Sponsor_model extends CI_Model
{
    
    public function get_data()
    {
        // Ambil id_vendor dari session
        $id_vendor = $this->session->userdata('id_vendor');
    
        // Lakukan join antara tabel sponsor dan seminar, serta users
        $this->db->select('sponsor.*, seminar.*, users.nama_vendor'); // Ambil semua kolom dari sponsor dan seminar, serta nama_vendor dari users
        $this->db->from('sponsor');
        $this->db->join('seminar', 'seminar.id_seminar = sponsor.id_seminar', 'left'); // Join dengan tabel seminar
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left'); // Join dengan tabel users
        $this->db->where('sponsor.id_vendor', $id_vendor); // Filter berdasarkan id_vendor di tabel sponsor
    
        return $this->db->get()->result();
    }
    

public function get_seminar()
{
    // Ambil id_vendor dari session
    $id_vendor = $this->session->userdata('id_vendor');

    // Lakukan join antara tabel seminar dan users
    $this->db->select('seminar.*, users.nama_vendor'); // Ambil semua kolom dari seminar dan nama_vendor dari users
    $this->db->from('seminar');
    $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left'); // Join dengan tabel users
    $this->db->where('seminar.id_vendor', $id_vendor); // Filter berdasarkan id_vendor

    return $this->db->get()->result();
}


    function insert_data($data)
    {
        return $this->db->insert('sponsor', $data);
    }

    function get_row($id)
    {
        return $this->db->where('id_sponsor', $id)->get('sponsor');
    }

    function update_data($id, $data)
    {
        return $this->db->where('id_sponsor', $id)->update('sponsor', $data);
    }

    function delete_data($id)
    {
        return $this->db->where('id_sponsor', $id)->delete('sponsor');
    }
}
