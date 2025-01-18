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

    public function get_all_jenis() {
        return $this->db->get('jenis_seminar')->result_array();
    }
    
    public function get_jenis_by_id($id) {
        return $this->db->get_where('jenis_seminar', ['id_jenis' => $id])->row_array();
    }

        public function getSeminarById($id_seminar) {
        $this->db->select('nama_seminar, id_vendor');
        $this->db->from('seminar');
        $this->db->where('id_seminar', $id_seminar);
        $query = $this->db->get();

        // Mengembalikan objek seminar jika ada, atau false jika tidak ada
        return $query->row();
    }
    
    public function get_data()
    {
        // Ambil id_vendor dari session
        $id_vendor = $this->session->userdata('id_vendor');
    
        // Lakukan join antara tabel seminar, tiket, dan users
        $this->db->select('seminar.*, tiket.*, users.nama_vendor'); // Ambil semua kolom dari seminar dan tiket, serta nama_vendor dari users
        $this->db->from('seminar');
        $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'left'); // Join dengan tabel tiket
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left'); // Join dengan tabel users
        $this->db->where('seminar.id_vendor', $id_vendor); // Filter berdasarkan id_vendor
    
        return $this->db->get()->result();
    }
    public function get_data_online()
{
    // Ambil id_vendor dari session
    $id_vendor = $this->session->userdata('id_vendor');
    
    // Lakukan join antara tabel seminar, tiket, dan users
    $this->db->select('seminar.*, tiket.*, users.nama_vendor'); 
    $this->db->from('seminar');
    $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'left');
    $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left');
    
    // Filter berdasarkan id_vendor dan id_jenis
    $this->db->where('seminar.id_vendor', $id_vendor);
    $this->db->where('seminar.id_jenis', 1); // Menambahkan filter untuk id_jenis = 1
    
    return $this->db->get()->result();
}
public function get_data_offline()
{
    // Ambil id_vendor dari session
    $id_vendor = $this->session->userdata('id_vendor');
    
    // Lakukan join antara tabel seminar, tiket, dan users
    $this->db->select('seminar.*, tiket.*, users.nama_vendor'); 
    $this->db->from('seminar');
    $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'left');
    $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left');
    
    // Filter berdasarkan id_vendor dan id_jenis
    $this->db->where('seminar.id_vendor', $id_vendor);
    $this->db->where('seminar.id_jenis', 2); // Menambahkan filter untuk id_jenis = 1
    
    return $this->db->get()->result();
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
    public function get_lokasi_by_id($id_lokasi)
    {
        $this->db->where('id_lokasi', $id_lokasi);
        return $this->db->get('lokasi_seminar')->row(); // Mengembalikan satu baris data lokasi
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
        $this->db->select('
            seminar.id_seminar, 
            seminar.nama_seminar, 
            seminar.tgl_pelaksana, 
            seminar.lampiran, 
            tiket.harga_tiket, 
            tiket.slot_tiket, 
            users.nama_vendor AS nama_vendor
        ');
        $this->db->from('seminar');
        $this->db->join('tiket', 'seminar.id_seminar = tiket.id_seminar', 'inner'); // Ganti ke INNER JOIN
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left');   // Tetap gunakan LEFT JOIN untuk tabel users
        $query = $this->db->get();
        return $query->result();
    }
    
    
    

    public function getLokasiSeminar() {
        // Query untuk mengambil data dari tabel lokasi_seminar
        $this->db->select('id_lokasi, nama_provinsi');
        $this->db->from('lokasi_seminar');
        $query = $this->db->get();
        
        // Tambahkan opsi "Semua Lokasi"
        $all_locations = new stdClass();
        $all_locations->id_lokasi = 0; // ID untuk semua lokasi
        $all_locations->nama_provinsi = 'Semua Lokasi'; // Nama untuk semua lokasi
    
        $locations = $query->result();
        array_unshift($locations, $all_locations); // Menambahkan "Semua Lokasi" di awal array
    
        return $locations;
    }
    
    
    public function getSeminarDataByLocation($id_lokasi) {
        // Query untuk mengambil data seminar berdasarkan id_lokasi
        $this->db->select('seminar.id_seminar, seminar.nama_seminar, seminar.tgl_pelaksana, seminar.lampiran, tiket.harga_tiket, tiket.slot_tiket, users.nama_vendor');
        $this->db->from('seminar');
        $this->db->join('tiket', 'seminar.id_seminar = tiket.id_seminar', 'left');
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left'); 
        $this->db->where('seminar.id_lokasi', $id_lokasi); // Filter berdasarkan id_lokasi
        $query = $this->db->get();
        return $query->result();
    }



        // Fungsi untuk mengambil semua data seminar yang didaftarkan oleh mahasiswa
        public function getSeminarDaftar($id_mahasiswa) {
            $this->db->select('pendaftaran_seminar.*, seminar.nama_seminar, seminar.tgl_pelaksana, seminar.id_jenis, tiket.harga_tiket, tiket.slot_tiket, seminar.lampiran, seminar.file'); // Tambahkan seminar.file
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



    
    public function searchSeminars($keyword) {
        $this->db->select('seminar.*, tiket.harga_tiket, tiket.slot_tiket, lokasi_seminar.nama_provinsi, 
                           seminar.lampiran, seminar.tgl_pelaksana, seminar.nama_seminar, seminar.id_seminar, users.nama_vendor');
        $this->db->from('seminar');
        $this->db->join('tiket', 'seminar.id_seminar = tiket.id_seminar', 'left');
        $this->db->join('lokasi_seminar', 'seminar.id_lokasi = lokasi_seminar.id_lokasi', 'left');
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left'); 
        $this->db->like('seminar.nama_seminar', $keyword);
        $this->db->or_like('seminar.deskripsi', $keyword);
        $this->db->order_by('seminar.tgl_pelaksana', 'ASC');
        return $this->db->get()->result();
    }
    
    public function getSeminarsByPriceRange($range) {
        $this->db->select('seminar.*, tiket.harga_tiket, tiket.slot_tiket, lokasi_seminar.nama_provinsi, 
                           seminar.lampiran, seminar.tgl_pelaksana, seminar.nama_seminar, seminar.id_seminar, users.nama_vendor');
        $this->db->from('seminar');
        $this->db->join('tiket', 'seminar.id_seminar = tiket.id_seminar', 'left');
        $this->db->join('lokasi_seminar', 'seminar.id_lokasi = lokasi_seminar.id_lokasi', 'left');
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left'); 
    
        switch($range) {
            case 'free':
                $this->db->where('tiket.harga_tiket', 0);
                break;
            case 'paid':
                $this->db->where('tiket.harga_tiket >', 0);
                break;
            case '0-50000':
                $this->db->where('tiket.harga_tiket >=', 0);
                $this->db->where('tiket.harga_tiket <=', 50000);
                break;
            case '50000-100000':
                $this->db->where('tiket.harga_tiket >', 50000);
                $this->db->where('tiket.harga_tiket <=', 100000);
                break;
            case '100000+':
                $this->db->where('tiket.harga_tiket >', 100000);
                break;
        }
        $this->db->order_by('seminar.tgl_pelaksana', 'ASC');
        return $this->db->get()->result();
    }
    
    public function getTodaySeminars() {
        $this->db->select('seminar.*, tiket.harga_tiket, tiket.slot_tiket, lokasi_seminar.nama_provinsi, 
                           seminar.lampiran, seminar.tgl_pelaksana, seminar.nama_seminar, seminar.id_seminar, users.nama_vendor');
        $this->db->from('seminar');
        $this->db->join('tiket', 'seminar.id_seminar = tiket.id_seminar', 'left');
        $this->db->join('lokasi_seminar', 'seminar.id_lokasi = lokasi_seminar.id_lokasi', 'left');
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left'); 
        $this->db->where('DATE(seminar.tgl_pelaksana)', date('Y-m-d'));
        $this->db->order_by('seminar.tgl_pelaksana', 'ASC');
        return $this->db->get()->result();
    }
    
    public function getNearbySeminars($lat, $lng) {
        $this->db->select('seminar.*, tiket.harga_tiket, tiket.slot_tiket, lokasi_seminar.nama_provinsi, 
                           seminar.lampiran, seminar.tgl_pelaksana, seminar.nama_seminar, seminar.id_seminar, users.nama_vendor');
        $this->db->from('seminar');
        $this->db->join('tiket', 'seminar.id_seminar = tiket.id_seminar', 'left');
        $this->db->join('lokasi_seminar', 'seminar.id_lokasi = lokasi_seminar.id_lokasi', 'left');
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left'); 
        // ... rest of the distance calculation ...
        $this->db->order_by('seminar.tgl_pelaksana', 'ASC');
        return $this->db->get()->result();
    }

    
    public function getCategories() {
        $this->db->select('*');
        $this->db->from('kategori_seminar');
        $query = $this->db->get();
        return $query->result();
    }

    public function getSeminarsByCategory($id_kategori) {
        $this->db->select('
            seminar.id_seminar, 
            seminar.nama_seminar, 
            seminar.deskripsi, 
            seminar.tgl_pelaksana, 
            tiket.harga_tiket, 
            seminar.lampiran,
            users.nama_vendor
        ');
        $this->db->from('seminar');
        $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'inner'); // Ganti ke INNER JOIN
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left');   // Tetap gunakan LEFT JOIN untuk tabel users
        $this->db->where('seminar.id_kategori', $id_kategori); // Filter berdasarkan kategori
        return $this->db->get()->result();
    }
    
    public function getSeminarVendor() {
        $this->db->select('seminar.*, users.nama_vendor');
        $this->db->from('seminar');
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left');
        return $this->db->get()->result();
    }    

    public function getKategoriSeminar() {
        $this->db->distinct();
        $this->db->select('ks.id_kategori, ks.nama_kategori');
        $this->db->from('kategori_seminar ks');
        $this->db->join('seminar s', 's.id_kategori = ks.id_kategori');
        $this->db->order_by('ks.nama_kategori', 'ASC');
        return $this->db->get()->result();
    }

    public function getJenisSeminar() {
        $this->db->distinct();
        $this->db->select('js.id_jenis, js.nama_jenis');
        $this->db->from('jenis_seminar js');
        $this->db->join('seminar s', 's.id_jenis = js.id_jenis');
        $this->db->order_by('js.nama_jenis', 'ASC');
        return $this->db->get()->result();
    }

    public function getSeminarDataByCategory($id_kategori) {
        $this->db->select('
            seminar.id_seminar, 
            seminar.nama_seminar, 
            seminar.deskripsi, 
            seminar.tgl_pelaksana, 
            tiket.harga_tiket, 
            seminar.lampiran,
            users.nama_vendor
        ');
        $this->db->from('seminar');
        $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'inner');
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left');
        $this->db->where('seminar.id_kategori', $id_kategori);
        return $this->db->get()->result();
    }

    public function getSeminarDataByType($id_jenis) {
        $this->db->select('
            seminar.id_seminar, 
            seminar.nama_seminar, 
            seminar.deskripsi, 
            seminar.tgl_pelaksana, 
            tiket.harga_tiket, 
            seminar.lampiran,
            users.nama_vendor
        ');
        $this->db->from('seminar');
        $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'inner');
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left');
        $this->db->where('seminar.id_jenis', $id_jenis);
        return $this->db->get()->result();
    }

    public function getUpcomingSeminars($limit = 6) {
        $this->db->select('
            seminar.id_seminar, 
            seminar.nama_seminar, 
            seminar.deskripsi, 
            seminar.tgl_pelaksana, 
            tiket.harga_tiket, 
            seminar.lampiran,
            users.nama_vendor,
            kategori_seminar.nama_kategori,
            jenis_seminar.nama_jenis
        ');
        $this->db->from('seminar');
        $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'inner');
        $this->db->join('users', 'seminar.id_vendor = users.id_vendor', 'left');
        $this->db->join('kategori_seminar', 'kategori_seminar.id_kategori = seminar.id_kategori', 'left');
        $this->db->join('jenis_seminar', 'jenis_seminar.id_jenis = seminar.id_jenis', 'left');
        $this->db->where('seminar.tgl_pelaksana >=', date('Y-m-d'));
        $this->db->order_by('seminar.tgl_pelaksana', 'ASC');
        $this->db->limit($limit);
        
        return $this->db->get()->result();
    }
    public function getSeminarlink($id_seminar) {
        $this->db->select('
            seminar.*,
            users.nama_vendor,
            tiket.harga_tiket,
            seminar.lampiran,
            seminar.nama_seminar
        ');
        $this->db->from('seminar');
        $this->db->join('users', 'users.id_vendor = seminar.id_vendor', 'left');
        $this->db->join('tiket', 'tiket.id_seminar = seminar.id_seminar', 'left');
        $this->db->where('seminar.id_seminar', $id_seminar);
        return $this->db->get()->row();
    }
   
}
    
   
    
