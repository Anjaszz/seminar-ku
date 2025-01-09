<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Vendor_model extends CI_Model
{

   public function lihat_data()
{
    // Mengambil semua data dari tabel users tanpa gabungan tabel lain
    $users = $this->db->get('users')->result();

    // Menambahkan kolom status berdasarkan nilai dari row active
    foreach ($users as $user) {
        $user->status = $user->active == 1 ? 'Aktiv' : 'Nonaktiv';
    }

    return $users;
}
public function get_vendor_details($id_vendor)
{
    $this->db->select('users.*, bank.nama_bank, users.no_rekening');
    $this->db->from('users');
    $this->db->join('bank', 'bank.id_bank = users.id_bank', 'left'); // Menghubungkan tabel `users` dengan `bank`
    $this->db->where('users.id_vendor', $id_vendor);
    return $this->db->get();
}

public function get_row($id_vendor)
{
    $this->db->select('id_vendor, nama_vendor, tgl_subs, tgl_berakhir, email, no_telp, id_bank, no_rekening');
    $this->db->from('users');
    $this->db->where('id_vendor', $id_vendor);
    return $this->db->get();
}

public function getUserById($id_vendor)
{
    return $this->db->get_where('users', ['id_vendor' => $id_vendor])->row_array();
}


   
    
public function insert_data($data)
{
    // Insert data into the users table
    $this->db->insert('users', $data);
    // Return the last inserted id
    return $this->db->insert_id(); // This will return the auto-incremented id
}

    public function get_all_banks()
    {
        return $this->db->get('bank')->result();
    }

    public function getAllBanks()
    {
        return $this->db->get('bank')->result_array();
    }

    



    function delete_data($id)
    {
        $this->db->trans_start(); // Memulai transaksi database
        $this->db->where('id_vendor', $id);
        $this->db->delete('users');
    
    
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


    public function update_data($id_vendor, $data) {
        $this->db->where('id_vendor', $id_vendor);
        return $this->db->update('users', $data);
    }



    

    public function count_active_vendors() {
        $this->db->where('active', 1); // Misalkan 1 berarti aktif
        return $this->db->count_all_results('users');
    }

    public function get_paginated_active_vendors($start, $items_per_page) {
        $this->db->where('active', 1);
        $this->db->limit($items_per_page, $start);
        return $this->db->get('users')->result();
    }

    public function count_nonaktif_vendors() {
        $this->db->where('active', 0); // Misalkan 0 berarti nonaktif
        return $this->db->count_all_results('users');
    }

    public function get_paginated_nonaktif_vendors($start, $items_per_page) {
        $this->db->where('active', 0);
        $this->db->limit($items_per_page, $start);
        return $this->db->get('users')->result();
    }

public function get_active_vendors()
    {
        return $this->db->where('active', 1)->get('users')->result();
    }


    // nonaktifkan vendor
public function get_nonaktif_vendor()
{
    return $this->db->where('active', 0)->get('users')->result();
}



public function count_all_vendors()
{
    return $this->db->count_all('users'); // Sesuaikan dengan nama tabel vendor Anda
}
public function get_paginated_vendors($start, $limit)
{
    $this->db->limit($limit, $start);
    $query = $this->db->get('users');
    $users = $query->result();
    
    // Tambahkan status seperti di lihat_data
    foreach ($users as $user) {
        $user->status = $user->active == 1 ? 'Aktiv' : 'Nonaktiv';
    }
    
    return $users;
}


    
    
}