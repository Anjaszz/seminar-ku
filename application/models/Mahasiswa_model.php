<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{

    function lihat_data()
{
    $this->db->join('fakultas', 'fakultas.id_fakultas = mahasiswa.id_fakultas', 'left');
    $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left'); // Join dengan tabel prodi
    return $this->db->get('mahasiswa')->result();
}

    function get_prodi_by_fakultas($fakultas_id)
    {
        $this->db->where('id_fakultas', $fakultas_id);
        return $this->db->get('prodi')->result();
    }
    
    function get_fakultas()
    {
        return $this->db->get('fakultas')->result();
    }
    function get_prodi()
    {
        return $this->db->get('prodi')->result();
    }
    
    public function get_last_nim_count($year, $month) {
        $this->db->like('nim', $year . $month, 'after'); // Mencari NIM yang dimulai dengan tahun dan bulan
        return $this->db->count_all_results('mahasiswa'); // Menghitung jumlah NIM yang ditemukan
    }

    
    function insert_data($data)
    {
        return $this->db->insert('mahasiswa', $data);
    }


    function insert_data_user($data_user)
    {
        return $this->db->insert('user_mhs', $data_user);
    }
    public function insert_data_id($data)
{
    $this->db->insert('mahasiswa', $data);
    return $this->db->insert_id(); // Mengembalikan ID dari record yang baru ditambahkan
}
public function check_nim_exists($nim) {
    $this->db->where('nim', $nim);
    $query = $this->db->get('mahasiswa');
    
    if ($query->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}

public function check_email_exists($email) {
    $this->db->where('email', $email);
    $query = $this->db->get('mahasiswa');
    
    if ($query->num_rows() > 0) {
        return true;
    } else {
        return false;
    }
}

public function check_nim_exists_except_self($nim, $id)
{
    // Pengecekan NIM selain data dengan id yang sedang diedit
    $this->db->where('nim', $nim);
    $this->db->where('id_mahasiswa !=', $id);
    $query = $this->db->get('mahasiswa');
    return $query->num_rows() > 0;
}

public function check_email_exists_except_self($email, $id)
{
    // Pengecekan email selain data dengan id yang sedang diedit
    $this->db->where('email', $email);
    $this->db->where('id_mahasiswa !=', $id);
    $query = $this->db->get('mahasiswa');
    return $query->num_rows() > 0;
}



    function get_row($id)
    {
        $this->db->where('id_mahasiswa', $id);
        $this->db->join('fakultas', 'fakultas.id_fakultas = mahasiswa.id_fakultas', 'left');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left');
        return   $this->db->get('mahasiswa');
    }

    function get_nim($id)
    {
        $this->db->where('id_mahasiswa', $id);
        return   $this->db->get('mahasiswa')->row();
    }


    function update_data($id, $data)
    {
        $this->db->where('id_mahasiswa', $id);
        return $this->db->update('mahasiswa', $data);
    }

    function update_data_user($id, $data)
    {
        $this->db->where('id_mahasiswa', $id);
        return $this->db->update('mahasiswa', $data);
    }

    function delete_data($id)
    {
        $this->db->trans_start(); // Memulai transaksi database
        $this->db->where('id_mahasiswa', $id);
        $this->db->delete('history_seminar');
    
        // Hapus data dari tabel pertama
        $this->db->where('id_mahasiswa', $id);
        $this->db->delete('mahasiswa');
    
        // Hapus data dari tabel kedua
        $this->db->where('id_mahasiswa', $id);
        $this->db->delete('presensi_seminar');
    
        // Hapus data dari tabel ketiga
        $this->db->where('id_mahasiswa', $id);
        $this->db->delete('pendaftaran_seminar');

        $this->db->where('id_mahasiswa', $id);
        $this->db->delete('user_mhs');

        
    
        $this->db->trans_complete(); // Menyelesaikan transaksi database
    
        // Periksa apakah transaksi berhasil
        if ($this->db->trans_status() === FALSE) {
            // Jika transaksi gagal, maka lakukan rollback
            $this->db->trans_rollback();
            return false;
        } else {
            // Jika transaksi berhasil, maka commit transaksi
            $this->db->trans_commit();
            return true;
        }
    }

    public function count_all_mahasiswa()
    {
        return $this->db->count_all('mahasiswa');
    }
    
    public function get_paginated_mahasiswa($start, $limit)
    {
        $this->db->select('mahasiswa.*, fakultas.kode_fakultas, fakultas.nama_fakultas, prodi.nama_prodi');
        $this->db->from('mahasiswa');
        $this->db->join('fakultas', 'fakultas.id_fakultas = mahasiswa.id_fakultas', 'left');
        $this->db->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left');
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }


    
    
}