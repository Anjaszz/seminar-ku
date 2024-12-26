<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tiket_model extends CI_Model
{

    public function get_data()
{
    // Ambil id_vendor dari session
    $id_vendor = $this->session->userdata('id_vendor');

    // Lakukan join antara tabel tiket, seminar, dan users
    $this->db->select('tiket.*, seminar.*, users.nama_vendor'); // Ambil semua kolom dari tiket dan seminar, serta nama_vendor dari users
    $this->db->from('tiket');
    $this->db->join('seminar', 'seminar.id_seminar = tiket.id_seminar', 'left'); // Join dengan tabel seminar
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


    function cek_seminar($seminar){
        $this->db->join('seminar', 'seminar.id_seminar = tiket.id_seminar', 'left');
        return $this->db->where('tiket.id_seminar',$seminar)->get('tiket');
    }

    function cek_seminar_edit($seminar){
        $this->db->join('seminar', 'seminar.id_seminar = tiket.id_seminar', 'left');
        return $this->db->where_not_in('tiket.id_seminar',$seminar)->get('tiket');
    }
    
    function insert_data($data)
    {
        return $this->db->insert('tiket', $data);
    }

    function get_row($id)
    {
        return $this->db->where('id_tiket', $id)->get('tiket');
    }

    function update_data($id, $data)
    {
        return $this->db->where('id_tiket', $id)->update('tiket', $data);
    }

    function delete_data($id)
    {
        return $this->db->where('id_tiket', $id)->delete('tiket');
    }
}

/* End of file Tiket_model.php */
/* Location: ./application/models/Tiket_model.php */
