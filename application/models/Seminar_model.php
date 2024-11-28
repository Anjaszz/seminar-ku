<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seminar_model extends CI_Model
{

    public function get_seminar_id($id)
    {
        return $this->db->get_where('seminar', ['id_seminar' => $id])->row_array();
    }

public function update_seminar($id, $data)
{
    $this->db->where('id_seminar', $id);
    $this->db->update('seminar', $data);
}


        public function get_nama_seminar_by_id($id_seminar)
        {
            $this->db->select('nama_seminar');
            $this->db->from('seminar');
            $this->db->where('id_seminar', $id_seminar);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->row()->nama_seminar;
            } else {
                return 'Seminar Tidak Diketahui';
            }
        }
public function get_seminar_by_id($id_seminar) {
        $this->db->select('nama_seminar, tgl_pelaksana');
        $this->db->from('seminar');
        $this->db->where('id_seminar', $id_seminar);
        $query = $this->db->get();

        return $query->row(); // Mengembalikan satu baris hasil
    }

        public function getSeminarById($id_seminar) {
        $this->db->select('nama_seminar');
        $this->db->from('seminar');
        $this->db->where('id_seminar', $id_seminar);
        $query = $this->db->get();

        // Mengembalikan objek seminar jika ada, atau false jika tidak ada
        return $query->row();
    }
    
        public function get_data()
        {
    
            $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'left');
            return $this->db->get('seminar')->result();
        }
        
    public function insert_data($data)
    {
        return $this->db->insert('seminar', $data);
    }

    public function get_all_kategori() {
        return $this->db->get('kategori_seminar')->result_array();
    }

    public function get_all_lokasi() {
        return $this->db->get('lokasi_seminar')->result_array();
    }

    public function get_all_fakultas() {
        return $this->db->get('fakultas')->result_array();
    }

    public function get_row($id)
    {
        $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'left');
        $this->db->join('pembicara', 'pembicara.id_seminar = seminar.id_seminar', 'left');
        $this->db->join('sponsor', 'sponsor.id_seminar = seminar.id_seminar', 'left');
        $this->db->where('seminar.id_seminar', $id);
        return $this->db->get('seminar');
    }

    public function get_sm_row($id)
    {
        $this->db->where('seminar.id_seminar', $id);
        return $this->db->get('seminar');
    }

    function update_data($id, $data)
    {
        $this->db->where('id_seminar', $id);
        return $this->db->update('seminar', $data);
    }

    public function delete_data($id)
    {
        $this->db->trans_start(); // Memulai transaksi database
        
        // Hapus data dari tabel pendaftaran_seminar berdasarkan id_mahasiswa
        $this->db->where('id_seminar', $id);
        $this->db->delete('seminar');

        $this->db->where('id_seminar', $id);
        $this->db->delete('pembicara');

        $this->db->where('id_seminar', $id);
        $this->db->delete('tiket');

        $this->db->where('id_seminar', $id);
        $this->db->delete('sponsor');
        
        $this->db->trans_complete(); // Menyelesaikan transaksi database
    
        // Periksa apakah transaksi berhasil
        if ($this->db->trans_status() === FALSE) {
            // Jika transaksi gagal, rollback dan return false
            $this->db->trans_rollback();
            return false;
        } else {
            // Jika transaksi berhasil, commit dan return true
            $this->db->trans_commit();
            return true;
        }
    }

    public function get_pembicara($id)
    {
        $this->db->where('id_seminar', $id);
        return $this->db->get('pembicara')->result();
    }

    function total_tiket($id)
    {
        return $this->db->where('id_seminar', $id)->get('tiket');
    }

    public function tiket_terjual($id)
    {
        return $this->db->where('id_seminar', $id)->get('pendaftaran_seminar')->num_rows();
    }

    public function get_sponsor($id)
    {
        $this->db->where('id_seminar', $id);
        return $this->db->get('sponsor')->result();
    }



    public function getSeminarData() {
        // Query untuk mengambil data dari tabel seminar dan tiket
        $this->db->select('seminar.id_seminar, seminar.nama_seminar, seminar.tgl_pelaksana, seminar.lampiran, tiket.harga_tiket, tiket.slot_tiket');
        $this->db->from('seminar');
        $this->db->join('tiket', 'seminar.id_seminar = tiket.id_seminar', 'left');
        $query = $this->db->get();
        return $query->result();
    }

        // Fungsi untuk mengambil semua data seminar yang didaftarkan oleh mahasiswa
        public function getSeminarDaftar($id_mahasiswa) {
            $this->db->select('pendaftaran_seminar.*, seminar.nama_seminar, seminar.tgl_pelaksana, tiket.harga_tiket, tiket.slot_tiket, seminar.lampiran, seminar.file'); // Tambahkan seminar.file
            $this->db->from('pendaftaran_seminar');
            $this->db->join('seminar', 'seminar.id_seminar = pendaftaran_seminar.id_seminar');
            $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar');
            $this->db->where('pendaftaran_seminar.id_mahasiswa', $id_mahasiswa);
            // Mengambil semua data tanpa memfilter id_stsbyr
            
            $query = $this->db->get();
            return $query->result();  // Mengembalikan semua hasil query sebagai array objek
        }
        
        
    
    
    

    public function getSeminarsByStatus($id_stsbyr) {
        $this->db->where('id_stsbyr', $id_stsbyr);
        $query = $this->db->get('pendaftaran_seminar'); // Ganti dengan nama tabel yang sesuai
        return $query->result();
    }

    public function sertifikat($id_seminar) {
        // Menggunakan Query Builder CodeIgniter
        $this->db->select('hs.nama_seminar, m.nama_mhs, hs.tanggal_pelaksanaan');
        $this->db->from('history_seminar hs');
        $this->db->join('mahasiswa m', 'm.id_mahasiswa = hs.id_mahasiswa'); // Ganti dengan tabel mahasiswa yang sesuai
        $this->db->where('hs.id_seminar', $id_seminar);

        $query = $this->db->get();
        
        // Mengembalikan hasil query
        if ($query->num_rows() > 0) {
            return $query->result(); // Mengembalikan semua baris data yang ditemukan
        } else {
            return null; // Jika tidak ada data ditemukan
        }
    }
}