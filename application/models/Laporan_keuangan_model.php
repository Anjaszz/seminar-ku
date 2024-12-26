<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_keuangan_model extends CI_Model
{

    public function get_keuangan($id_seminar, $id_admin)
    {
        // Ambil data transaksi dan informasi mahasiswa
        $this->db->select('transaksi_user.tgl_transaksi, transaksi_user.jumlah, mahasiswa.nama_mhs, mahasiswa.email, mahasiswa.nim'); // Tambahkan nim
        $this->db->from('transaksi_user');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = transaksi_user.id_mahasiswa');
        $this->db->where('transaksi_user.id_seminar', $id_seminar);
        $this->db->where('transaksi_user.id_admin', $id_admin);
        
        $query = $this->db->get();
        
        // Ambil total transaksi
        $total_transaksi = $this->db->select_sum('jumlah')
                                      ->from('transaksi_user')
                                      ->where('id_seminar', $id_seminar)
                                      ->where('id_admin', $id_admin)
                                      ->get()
                                      ->row()
                                      ->jumlah;
    
        return [
            'laporan' => $query->result(),
            'total_transaksi' => $total_transaksi // Kembalikan total transaksi
        ];
    }
    


    public function get_p()
    {
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'right');
        return $this->db->get('pendaftaran_seminar')->result();
    }

    
    public function get_pst($id_seminar)
    {
        $this->db->select('presensi_seminar.*, mahasiswa.nama_mhs, mahasiswa.email, status_kehadiran.nama_stskhd');
        $this->db->from('presensi_seminar');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa');
        $this->db->join('status_kehadiran', 'status_kehadiran.id_stskhd = presensi_seminar.id_stskhd', 'left');
        $this->db->where('id_seminar', $id_seminar);
        return $this->db->get()->result();
    }
    

    public function get_presensi($peserta, $seminar)
    {
        return
            $this->db->where('presensi_seminar.id_seminar', $seminar)
            ->where('presensi_seminar.id_mahasiswa', $peserta)
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa', 'left')
            ->get('presensi_seminar');
    }

    public function insert_data($data)
    {
        return $this->db->insert('presensi_seminar', $data);
    }

    
    function update_data($id, $data)
    {
        return $this->db->where('id_presensi', $id)->update('presensi_seminar', $data);
    }
    
    function get_row($id)
    {
        $this->db->where('presensi_seminar.id_presensi', $id);
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa', 'left');
        $this->db->join('seminar', 'seminar.id_seminar = presensi_seminar.id_seminar', 'left');
        return $this->db->get('presensi_seminar');
    }

    function get_presensi_row($peserta)
    {
        $this->db->where('presensi_seminar.id_mahasiswa', $peserta);
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa', 'left');
        return $this->db->get('presensi_seminar');
    }

    public function hapus_laporan($id_mahasiswa, $id_seminar)
{
    // Hapus data dari tabel presensi_seminar
    $this->db->where('id_mahasiswa', $id_mahasiswa);
    $this->db->where('id_seminar', $id_seminar);
    $this->db->delete('presensi_seminar');

    // Hapus data dari tabel history_seminar
    $this->db->where('id_mahasiswa', $id_mahasiswa);
    $this->db->where('id_seminar', $id_seminar);
    $this->db->delete('history_seminar');
}

public function hapus_semua($id_seminar)
{
    // Hapus data dari tabel presensi_seminar
    $this->db->where('id_seminar', $id_seminar);
    $this->db->delete('presensi_seminar');

    // Hapus data dari tabel history_seminar
    $this->db->where('id_seminar', $id_seminar);
    $this->db->delete('history_seminar');


}}
