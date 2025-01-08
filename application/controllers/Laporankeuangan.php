<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporankeuangan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth'); // Redirect ke halaman login
        }         $this->load->model(
            [
                'Pendaftaran_model' => 'pf',
                'Seminar_model' => 'sm',
                'Mahasiswa_model' => 'mhs',
                'Laporan_keuangan_model' => 'lk',
            ]
        );
        $this->load->library('user_agent');
    }

    public function index()
    {
        $title = 'Laporan Keuangan Seminar';
        $get_seminar = $this->sm->get_data();
        $data = array(
            'title' => $title,
            'seminar' => $get_seminar,
        );
        $this->template->load('template/template_v', 'laporan-keuangan/laporan-keuangan_v', $data);
    }

    public function detail($id_seminar)
{
    $id_admin = $this->session->userdata('id_vendor'); // Mendapatkan id_admin dari session
    $title = 'Laporan Keuangan Seminar';
    
    // Ambil laporan dan total transaksi
    $data_keuangan = $this->lk->get_keuangan($id_seminar, $id_admin);
    
    $data = array(
        'title' => $title,
        'id_seminar' => $id_seminar,
        'laporan' => $data_keuangan['laporan'],
        'total_transaksi' => $data_keuangan['total_transaksi'], // Tambahkan total transaksi
    );

    $this->template->load('template/template_v', 'laporan-keuangan/laporan-keuangan_d', $data);
}



    public function hapus($id_mahasiswa, $id_seminar)
{
    // Panggil model untuk menghapus data
    $this->lk->hapus_laporan($id_mahasiswa, $id_seminar);

    // Pesan sukses
    $this->session->set_flashdata('message', 'Data berhasil dihapus.');
    redirect($this->session->userdata('link')); // Kembali ke halaman sebelumnya
}

public function hapus_semua($id_seminar)
{
    // Hapus data dari tabel presensi_seminar
    $this->lk->hapus_semua($id_seminar);
    
    $this->session->set_flashdata('success', 'Semua data berhasil dihapus.');

    // Redirect kembali ke halaman laporan
    redirect('laporan');
}


}
