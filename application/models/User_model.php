<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Function to validate login credentials
    public function validate_login($email, $password) {
        // Cari user berdasarkan NIM
        $this->db->where('email', $email);
        
        // Hash password yang dimasukkan menggunakan MD5
        $hashed_password = md5($password);
        $this->db->where('password', $hashed_password); // Gunakan hashing MD5 untuk perbandingan
    
        // Ambil data user
        $user = $this->db->get('user_mhs')->row();
    
        // Jika user ditemukan
        if ($user) {
            return $user; // User ditemukan, kembalikan data user
        }
    
        // Jika user tidak ditemukan atau password salah
        return null;
    }
    
    
    
    public function update_password($id_mahasiswa, $new_password) {
        // Hash password baru dengan MD5
        $hashed_password = md5($new_password);
    
        // Data yang akan diupdate
        $data = array(
            'password' => $hashed_password,
            'id_reset' => 1 // Set id_reset menjadi 1 setelah password berhasil diubah
        );
    
        // Update password berdasarkan id_mahasiswa
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        return $this->db->update('user_mhs', $data);
    }
    
    
     
    public function getMahasiswaByNIM($nim) {
        $this->db->select('id_mahasiswa, nama_mhs'); // Tambahkan id_mahasiswa di sini
        $this->db->from('mahasiswa');
        $this->db->where('nim', $nim);
        $query = $this->db->get();
        
        // Pastikan mengembalikan satu objek atau null
        return $query->row(); 
    }
    

    public function getMahasiswaProfile($id_mahasiswa) {
        $this->db->select('mahasiswa.nama_mhs, mahasiswa.nim, mahasiswa.email, mahasiswa.no_telp, prodi.nama_prodi, mahasiswa.foto, mahasiswa.id_prodi'); // Tambahkan mahasiswa.id_prodi
        $this->db->from('mahasiswa');
        $this->db->join('prodi', 'mahasiswa.id_prodi = prodi.id_prodi');
        $this->db->where('mahasiswa.id_mahasiswa', $id_mahasiswa);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row(); // Kembalikan data mahasiswa
        } else {
            return false; // Jika tidak ada data, return false
        }
    }
    
    

    

    public function updateMahasiswa($id_mahasiswa, $nama_mhs, $email, $no_telp, $id_prodi, $foto) {
        $data = [
            'nama_mhs' => $nama_mhs,
            'email' => $email,
            'no_telp' => $no_telp,
            'id_prodi' => $id_prodi,
            'foto' => $foto // Pastikan ini ada agar foto diupdate
        ];
    
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->update('mahasiswa', $data);
    }
    
    

    public function getAllProdi() {
        $this->db->select('*');
        $this->db->from('prodi');
        $query = $this->db->get();
        return $query->result(); // Kembalikan semua data jurusan
    }
    
    

        public function updateProfilePicture($id_mahasiswa, $foto) {
            $this->db->set('foto', $foto);
            $this->db->where('id_mahasiswa', $id_mahasiswa);
            return $this->db->update('user_mhs'); // Perbarui tabel user_mhs
        }
        
        
        public function getDetailSeminarByID($id_seminar) {
            $this->db->select('s.id_seminar, s.nama_seminar, s.tgl_pelaksana, s.lampiran, 
                               p.nama_pembicara, p.latar_belakang, 
                               t.slot_tiket, t.tiket_terjual, 
                               sp.nama_sponsor, 
                               ls.nama_provinsi, s.lokasi'); // Menambahkan nama_provinsi dan lokasi dari tabel seminar
            $this->db->from('seminar s');
            $this->db->join('pembicara p', 'p.id_seminar = s.id_seminar', 'left');
            $this->db->join('tiket t', 't.id_seminar = s.id_seminar', 'left');
            $this->db->join('sponsor sp', 'sp.id_seminar = s.id_seminar', 'left'); // Mengambil nama_sponsor berdasarkan id_seminar
            $this->db->join('lokasi_seminar ls', 'ls.id_lokasi = s.id_lokasi', 'left'); // Join dengan tabel lokasi_seminar
            $this->db->where('s.id_seminar', $id_seminar);
            $query = $this->db->get();
            $seminar = $query->row();
        
            // Hitung sisa tiket
            if ($seminar) {
                $seminar->sisa_tiket = $seminar->slot_tiket - $seminar->tiket_terjual;
            }
        
            return $seminar;
        }
        
        public function hapusPendaftaran($id_pendaftaran) {
            // Hapus data dari tabel pendaftaran_seminar berdasarkan id_pendaftaran
            $this->db->where('id_pendaftaran', $id_pendaftaran);
            return $this->db->delete('pendaftaran_seminar');
        }

        public function getJumlahSeminarDiikuti($id_mahasiswa) {
            $this->db->where('id_mahasiswa', $id_mahasiswa);
            $this->db->where('id_stsbyr', 1); // Mengambil berdasarkan id_stsbyr = 2
            return $this->db->count_all_results('pendaftaran_seminar'); // Menggunakan tabel pendaftaran_seminar
    }

    // Fungsi untuk mendapatkan jumlah belum bayar
    public function getJumlahBelumBayar($id_mahasiswa) {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->where('id_stsbyr', 2); // Mengambil berdasarkan id_stsbyr = 2
        return $this->db->count_all_results('pendaftaran_seminar'); // Menggunakan tabel pendaftaran_seminar
    }

    // Fungsi untuk mendapatkan jumlah history seminar
    public function getJumlahHistory($id_mahasiswa) {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        return $this->db->count_all_results('history_seminar'); // Ganti dengan tabel yang sesuai
    }

    public function getJumlahKomunitas($id_mahasiswa) {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        return $this->db->count_all_results('komunitas'); // Ganti dengan tabel yang sesuai
    }

    
        
    public function getNimByIdMahasiswa($id_mahasiswa) {
        $this->db->select('mahasiswa.nim');
        $this->db->from('mahasiswa');
        $this->db->join('pendaftaran_seminar', 'pendaftaran_seminar.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->where('mahasiswa.id_mahasiswa', $id_mahasiswa);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row()->nim;
        }
        
        return false;
    }
    
    public function getSeminarByMahasiswa($id_mahasiswa) {
        $this->db->select('s.nama_seminar, s.tgl_pelaksana');
        $this->db->from('pendaftaran_seminar ps');
        $this->db->join('seminar s', 'ps.id_seminar = s.id_seminar');
        $this->db->where('ps.id_mahasiswa', $id_mahasiswa);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
        
    public function get_seminar_by_mahasiswa($id_mahasiswa) {
        $this->db->select('seminar.nama_seminar, seminar.lampiran, seminar.tgl_pelaksana, presensi_seminar.id_seminar, CONCAT(seminar.nama_seminar, " - ", DATE_FORMAT(seminar.tgl_pelaksana, "%d %M %Y")) AS seminar_info');
        $this->db->from('presensi_seminar');
        $this->db->join('seminar', 'seminar.id_seminar = presensi_seminar.id_seminar');
        $this->db->where('presensi_seminar.id_mahasiswa', $id_mahasiswa);
        $query = $this->db->get();
    
        return $query->result();
    }
    

    public function isHistory($id_seminar, $id_mahasiswa) {
        $this->db->where('id_seminar', $id_seminar);
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $query = $this->db->get('history_seminar');
    
        return $query->num_rows() > 0;
    }
    
    public function getSlotTiketAndTiketTerjual($id_seminar) {
        $this->db->select('slot_tiket, tiket_terjual');
        $this->db->from('tiket'); // Nama tabel yang menyimpan informasi tiket
        $this->db->where('id_seminar', $id_seminar);
        $query = $this->db->get();

        // Jika data ditemukan, kembalikan hasilnya
        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan satu baris data sebagai objek
        } else {
            return null; // Jika tidak ditemukan, kembalikan null
        }
    }

    public function get_user_by_id($id_mahasiswa)
    {
        return $this->db->where('id_mahasiswa', $id_mahasiswa)
                        ->get('user_mhs')
                        ->row();
    }
    
    
    public function checkPresensi($id_mahasiswa, $id_seminar) {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->where('id_seminar', $id_seminar);
        $query = $this->db->get('history_seminar');
        return $query->num_rows() > 0; // Mengembalikan true jika ada, false jika tidak
    }
    
    public function get_mahasiswa_by_email($email) {
        $this->db->select('*'); // Ambil semua kolom
        $this->db->from('user_mhs');
        $this->db->where('email', $email);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row(); // Mengembalikan baris pertama
        }
        
        return null; // Jika tidak ada hasil
    }
    

    // Update password berdasarkan id_mahasiswa
    public function update_password_by_id_mahasiswa($id_mahasiswa, $new_password) {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->update('user_mhs', ['password' => $new_password]);
    }
    public function save_reset_token($email, $token, $expiry_time) {
        // Simpan token dan expiry_time ke dalam database
        $data = array(
            'reset_token' => $token,
            'expiry_time' => $expiry_time,
        );
    
        // Pastikan Anda memiliki tabel yang sesuai untuk menyimpan token
        $this->db->where('email', $email);
        return $this->db->update('user_mhs', $data);
    }

    public function get_reset_token($token, $email) {
        $this->db->where('reset_token', $token);
        $this->db->where('email', $email);
        return $this->db->get('user_mhs')->row();
    }
    
    
    public function clear_reset_token($email) {
        $this->db->set('reset_token', null);
        $this->db->set('expiry_time', null);
        $this->db->where('email', $email);
        return $this->db->update('user_mhs');
    }
    
    public function updateScanStatus($id_mahasiswa, $id_seminar) {
        $data = array(
            'id_scan' => 1,
        );
        
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->where('id_seminar', $id_seminar);
        return $this->db->update('pendaftaran_seminar', $data);
    }
    
    public function cekPresensi($id_mahasiswa, $id_seminar) {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->where('id_seminar', $id_seminar);
        return $this->db->get('history_seminar')->num_rows() > 0;
    }
    
    public function resetScan($id_mahasiswa, $id_seminar) {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->where('id_seminar', $id_seminar);
        $this->db->update('pendaftaran_seminar', ['id_scan' => 0]);
    }
    public function cariSeminarByNama($nama_seminar)
    {
        $this->db->like('nama_seminar', $nama_seminar);
        return $this->db->get('seminar')->result();
    }
    
    
    
    
    
}
    





