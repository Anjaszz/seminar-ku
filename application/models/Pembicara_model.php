<?php

class Pembicara_model extends CI_Model
{
    
    public function get_data()
{
    // Ambil id_vendor dari session
    $id_vendor = $this->session->userdata('id_vendor');

    // Lakukan join antara tabel pembicara dan seminar, serta users
    $this->db->select('pembicara.*, seminar.*, users.nama_vendor'); // Ambil semua kolom dari pembicara dan seminar, serta nama_vendor dari users
    $this->db->from('pembicara');
    $this->db->join('seminar', 'seminar.id_seminar = pembicara.id_seminar', 'left'); // Join dengan tabel seminar
    $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left'); // Join dengan tabel users
    $this->db->where('seminar.id_vendor', $id_vendor); // Filter berdasarkan id_vendor

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
        return $this->db->insert('pembicara', $data);
    }

    function get_row($id)
    {
        return $this->db->where('id_pembicara', $id)->get('pembicara');
    }

    function update_data($id, $data)
    {
        return $this->db->where('id_pembicara', $id)->update('pembicara', $data);
    }

    function delete_data($id)
    {
        return $this->db->where('id_pembicara', $id)->delete('pembicara');
    }
}
