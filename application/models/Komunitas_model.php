<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Komunitas_model extends CI_Model
{

    public function cekKeanggotaan($id_mahasiswa, $id_seminar)
{
    // Query untuk mengecek apakah ada data dengan id_mahasiswa dan id_seminar
    $this->db->where('id_mahasiswa', $id_mahasiswa);
    $this->db->where('id_seminar', $id_seminar);
    $query = $this->db->get('komunitas');
    
    if ($query->num_rows() > 0) {
        return true; // Jika data ditemukan
    }
    return false; // Jika data tidak ditemukan
}
public function get_seminar_by_mahasiswa($id_mahasiswa) {
    $this->db->select('seminar.nama_seminar, 
                   seminar.lampiran, 
                   seminar.id_seminar, 
                   seminar.id_vendor,
                   COALESCE((SELECT nama_mhs FROM mahasiswa 
                    WHERE id_mahasiswa = (
                        SELECT id_mahasiswa FROM chat_komunitas 
                        WHERE id_seminar = seminar.id_seminar 
                        ORDER BY created_at DESC 
                        LIMIT 1
                    )), "") as nama_mhs,
                   COALESCE((SELECT pesan FROM chat_komunitas 
                    WHERE id_seminar = seminar.id_seminar 
                    ORDER BY created_at DESC 
                    LIMIT 1), "Belum ada pesan") as pesan,
                   (CASE 
                     WHEN EXISTS (
                         SELECT 1 FROM chat_komunitas 
                         WHERE id_seminar = seminar.id_seminar
                     ) 
                     THEN (SELECT created_at FROM chat_komunitas 
                           WHERE id_seminar = seminar.id_seminar 
                           ORDER BY created_at DESC 
                           LIMIT 1)
                     ELSE ""
                   END) as created_at');
$this->db->from('seminar');

// Join dengan tabel komunitas untuk memfilter seminar berdasarkan mahasiswa
$this->db->join('komunitas', 'komunitas.id_seminar = seminar.id_seminar');

// Filter berdasarkan id_mahasiswa di tabel komunitas
$this->db->where('komunitas.id_mahasiswa', $id_mahasiswa);

// Urutkan berdasarkan seminar terbaru
$this->db->order_by('seminar.id_seminar', 'DESC');

// Eksekusi query
$query = $this->db->get();

// Mengembalikan hasil query
return $query->result();
}
    // Fungsi untuk menambahkan data ke tabel komunitas
    public function gabungKomunitas($data)
    {
        $this->db->insert('komunitas', $data);
    }

    public function get_komunitas_chats($id_mahasiswa) {
        // Menyusun query untuk menggabungkan tabel chat_komunitas, seminar, mahasiswa, dan komunitas
        $this->db->select('seminar.nama_seminar, seminar.lampiran, chat_komunitas.pesan, chat_komunitas.created_at, mahasiswa.nama_mhs, seminar.id_vendor, seminar.id_seminar');
        $this->db->from('chat_komunitas');
        
        // Menambahkan join ke tabel komunitas dan seminar
        $this->db->join('komunitas', 'komunitas.id_seminar = chat_komunitas.id_seminar'); // Menghubungkan chat_komunitas dengan komunitas
        $this->db->join('seminar', 'seminar.id_seminar = komunitas.id_seminar'); // Menghubungkan komunitas dengan seminar
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = chat_komunitas.id_mahasiswa'); // Menghubungkan mahasiswa dengan chat_komunitas
        
        // Mengatur filter berdasarkan id_mahasiswa yang ada di session
        $this->db->where('chat_komunitas.id_mahasiswa', $id_mahasiswa);
        
        // Mengurutkan berdasarkan waktu chat dan menampilkan hanya 1 chat terakhir
        $this->db->order_by('chat_komunitas.created_at', 'DESC');
        $this->db->limit(1); 
        
        // Eksekusi query
        $query = $this->db->get();
    
        // Mengembalikan hasil query
        return $query->result();
    }
    
}
