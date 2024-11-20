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


   
    
    function insert_data($data)
    {
        return $this->db->insert('users', $data);
    }

    public function get_all_banks()
    {
        return $this->db->get('bank')->result();
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


public function update_data($id_vendor, $data)
{
    $this->db->where('id_vendor', $id_vendor);
    return $this->db->update('users', $data);
}

public function get_active_vendors()
    {
        return $this->db->where('active', 1)->get('users')->result();
    }

public function get_nonaktif_vendor()
{
    return $this->db->where('active', 0)->get('users')->result();
}





    
    
}