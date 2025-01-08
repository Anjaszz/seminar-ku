<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
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
                'Laporan_model' => 'lp',
            ]
        );
        $this->load->library('user_agent');
    }

    public function index()
    {
        $title = 'Laporan Presensi Seminar';
        $get_seminar = $this->sm->get_data();
        $data = array(
            'title' => $title,
            'seminar' => $get_seminar,
        );
        $this->template->load('template/template_v', 'laporan/laporan_v', $data);
    }

   
    public function peserta()
    {
        // Ambil semua data peserta tanpa memfilter berdasarkan id_seminar
        $data['pendaftaran'] = $this->pf->get_all_data(); // Mengambil semua data peserta
        $data['title'] = "Data Peserta"; // Judul halaman

        // Load view dengan data peserta
        $this->template->load('template/template_v', 'laporan/laporanpeserta', $data);
    }



    public function detail($id)
    {
        $cu = current_url();
        $url = array(
            'link' => $cu
        );
        $this->session->set_userdata($url);
        $get_row = $this->sm->get_sm_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $id_seminar = $row->id_seminar;
            $nama_seminar = $row->nama_seminar;
            $title = "Laporan Presensi Seminar {$nama_seminar}";
    
           
            // rekap
            $laporan = $this->lp->get_pst($id_seminar);
            $data = array(
                'title' => $title,
                'id_seminar' => $id_seminar,
                'nama_seminar' => $nama_seminar,

                'laporan' => $laporan,
            );
            $this->template->load('template/template_v', 'laporan/laporan_d', $data);
        } else {
            redirect('pendaftaran');
        }
    }

    public function hapus($id_mahasiswa, $id_seminar)
{
    // Panggil model untuk menghapus data
    $this->lp->hapus_laporan($id_mahasiswa, $id_seminar);

    // Pesan sukses
    $this->session->set_flashdata('message', 'Data berhasil dihapus.');
    redirect($this->session->userdata('link')); // Kembali ke halaman sebelumnya
}

public function hapus_semua($id_seminar)
{
    // Hapus data dari tabel presensi_seminar
    $this->lp->hapus_semua($id_seminar);
    
    $this->session->set_flashdata('success', 'Semua data berhasil dihapus.');

    // Redirect kembali ke halaman laporan
    redirect('laporan');
}


}
