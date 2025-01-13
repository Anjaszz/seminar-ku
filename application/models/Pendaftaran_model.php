<?php

class Pendaftaran_model extends CI_Model
{
    
    function get_data($id_seminar)
    {
        $this->db->where('pendaftaran_seminar.id_seminar', $id_seminar);
        
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left');
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar', 'left');
        $this->db->join('status_pembayaran', 'status_pembayaran.id_stsbyr = pendaftaran_seminar.id_stsbyr', 'left');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id_metode = pendaftaran_seminar.id_metode', 'left');
        return $this->db->get('pendaftaran_seminar')->result();
    }

 
    public function get_all_data()
    {
        // Ambil id_vendor dari session
        $id_vendor = $this->session->userdata('id_vendor');

        // Melakukan join dengan tabel yang diperlukan
        $this->db->select('pendaftaran_seminar.*, mahasiswa.nama_mhs, mahasiswa.nim, mahasiswa.email, mahasiswa.no_telp, status_pembayaran.nama_stsbyr, metode_pembayaran.nama_metode, seminar.nama_seminar');
        $this->db->from('pendaftaran_seminar');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left');
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar', 'left');
        $this->db->join('status_pembayaran', 'status_pembayaran.id_stsbyr = pendaftaran_seminar.id_stsbyr', 'left');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id_metode = pendaftaran_seminar.id_metode', 'left');

        // Tambahkan filter berdasarkan id_vendor
        $this->db->where('pendaftaran_seminar.id_vendor', $id_vendor);

        return $this->db->get()->result(); // Mengambil data yang sudah difilter
    }





    function get_stsbyr()
    {
        return $this->db->get('status_pembayaran')->result();
    }

    function get_metode()
    {
        return $this->db->where_not_in('id_metode', '3')->get('metode_pembayaran')->result();
    }

    function insert_data($data)
    {
        return $this->db->insert('pendaftaran_seminar', $data);
    }

    function update_data($id, $data)
    {
        return $this->db->where('id_pendaftaran', $id)->update('pendaftaran_seminar', $data);
    }

    function get_pst()
    {
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar', 'right');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa  = pendaftaran_seminar.id_mahasiswa', 'right');
        return $this->db->get('pendaftaran_seminar')->result();
    }


    function cek_peserta($id,$seminar)
    {
        $this->db->where('mahasiswa.nim', $id);
        $this->db->where('pendaftaran_seminar.id_seminar', $seminar);
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar', 'right');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa  = pendaftaran_seminar.id_mahasiswa', 'right');
        return $this->db->get('pendaftaran_seminar');
    }

    function get_peserta($peserta, $seminar)
    {
        return
            $this->db->where('pendaftaran_seminar.id_seminar', $seminar)
            ->where('pendaftaran_seminar.id_mahasiswa', $peserta)
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left')
            ->get('pendaftaran_seminar');
    }

    function get_peserta_row($id, $peserta)
    {
        $this->db->where('pendaftaran_seminar.id_pendaftaran', $id);
        $this->db->where('pendaftaran_seminar.id_mahasiswa', $peserta);
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left');
        return $this->db->get('pendaftaran_seminar');
    }

    function get_row($id)
    {
        $this->db->where('pendaftaran_seminar.id_pendaftaran', $id);
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left');
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar', 'left');
        $this->db->join('status_pembayaran', 'status_pembayaran.id_stsbyr = pendaftaran_seminar.id_stsbyr', 'left');
        $this->db->join('metode_pembayaran', 'metode_pembayaran.id_metode = pendaftaran_seminar.id_metode', 'left');
        return $this->db->get('pendaftaran_seminar');
    }

    public function get_id_mahasiswa_by_pendaftaran($id_pendaftaran)
    {
        $this->db->select('id_mahasiswa');
        $this->db->from('pendaftaran_seminar');
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row()->id_mahasiswa;
        } else {
            return false;
        }
    }

    // Fungsi untuk menghapus data berdasarkan id_mahasiswa
    // Fungsi untuk menghapus data berdasarkan id_pendaftaran
public function delete_data($id_pendaftaran)
{
    $this->db->trans_start(); // Memulai transaksi database

    // Hapus data dari tabel pendaftaran_seminar berdasarkan id_pendaftaran
    $this->db->where('id_pendaftaran', $id_pendaftaran);
    $this->db->delete('pendaftaran_seminar');

    // Jika Anda ingin juga menghapus dari tabel lain berdasarkan id_pendaftaran
    // Anda harus memastikan itu dilakukan dengan benar
    // Misalnya, jika ada tabel presensi_seminar, pastikan Anda menghapus berdasarkan id_pendaftaran
    // Jika tidak ada hubungan langsung, jangan hapus dari tabel lain

    $this->db->trans_complete(); // Menyelesaikan transaksi database

    // Periksa apakah transaksi berhasil
    return $this->db->trans_status(); // Mengembalikan true jika berhasil, false jika gagal
}

    function cek_id($id)
    {
        $this->db->select('pendaftaran_seminar.id_seminar, mahasiswa.*');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa');
        $this->db->where('mahasiswa.nim', $id);
        return $this->db->get('pendaftaran_seminar')->row();
    }

    function get_seminar_name($nim)
    {
        $this->db->select('seminar.nama_seminar');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa');
        $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar');
        $this->db->where('mahasiswa.nim', $nim);
        return $this->db->get('pendaftaran_seminar')->row();
    }

    public function daftarkanSeminar($data) {
        return $this->db->insert('pendaftaran_seminar', $data);
    }

    public function getHargaTiket($id_seminar) {
        $this->db->select('harga_tiket');
        $this->db->from('tiket');
        $this->db->where('id_seminar', $id_seminar);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row()->harga_tiket;
        }
        
        return null; // Jika data tidak ditemukan
    }
    

        public function isRegistered($id_seminar, $id_mahasiswa) {
            $this->db->select('id_pendaftaran, id_stsbyr'); // Pastikan id_pendaftaran disertakan
            $this->db->from('pendaftaran_seminar');
            $this->db->where('id_seminar', $id_seminar);
            $this->db->where('id_mahasiswa', $id_mahasiswa);
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                return $query->row(); // Mengembalikan satu baris hasil
            }
            return false; // Tidak ada data yang ditemukan
        }
    }
    


    

