<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikat extends MY_Controller
{

    public function __construct()
{
    parent::__construct();
    if (!$this->session->userdata('id_vendor')) {
        redirect('auth'); // Redirect ke halaman login
    } 
    // Pastikan User_model di-load di sini
    $this->load->model(
        [
            'Pendaftaran_model' => 'pf',
            'Seminar_model' => 'sm',
            'Mahasiswa_model' => 'mhs',
            'Sertifikat_model' => 'sr',
            'User_model' => 'um', // Tambahkan ini
        ]
    );
    $this->load->library('user_agent');
    $this->load->library('upload');
}


    public function index()
    {
        $title = 'Sertifikat Presensi Seminar';
        // Ambil semua data dari tabel history_seminar
        $sertifikat = $this->sm->get_data();
        
        $data = array(
            'title' => $title,
            'sertifikat' => $sertifikat,
        );
        $this->template->load('template/template_v', 'sertifikat/sertifikat_v', $data);
    }

    public function upload($id_seminar)
    {
        // Konfigurasi upload file
        $config['upload_path']   = './uploads/sertifikat';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['file_name']     = 'sertifikat_' . time(); // Nama file

        $this->upload->initialize($config);

        if ($this->upload->do_upload('sertifikat')) {
            // Jika upload berhasil
            $upload_data = $this->upload->data();
            $sertifikat = $upload_data['file_name'];

            // Update data sertifikat di database
            if ($this->sr->update_sertifikat($id_seminar, $sertifikat)) {
                $this->session->set_flashdata('success', 'Sertifikat berhasil diupload.');
            } else {
                $this->session->set_flashdata('error', 'Gagal mengupdate database.');
            }
        } else {
            // Jika upload gagal
            $this->session->set_flashdata('error', $this->upload->display_errors());
        }

        // Redirect ke halaman awal
        redirect('sertifikat');
    }

    public function hapus_sertifikat($id_seminar)
{
    // Ambil data sertifikat berdasarkan id_seminar
    $sertifikat = $this->sm->get_data($id_seminar);
    
    // Cek apakah sertifikat ada dan file benar-benar ada
    if (!empty($sertifikat->sertifikat) && file_exists('./uploads/sertifikat/' . $sertifikat->sertifikat)) {
        // Hapus file sertifikat
        unlink('./uploads/sertifikat/' . $sertifikat->sertifikat);
    }
    
    // Update kolom sertifikat menjadi NULL di database
    $this->sr->hapus_sertifikat($id_seminar);

    // Redirect kembali ke halaman sertifikat
    $this->session->set_flashdata('success', 'Sertifikat berhasil dihapus.');
    redirect('sertifikat');
}

public function seminar_history()
{

    $id_mahasiswa = $this->session->userdata('id_mahasiswa');  // Mengambil id_mahasiswa dari session
        
    
        
        // Ambil data jumlah
        $id_mahasiswa = $this->session->userdata('id_mahasiswa'); // Ambil id mahasiswa dari session

        // Ambil jumlah seminar yang diikuti
        $jumlah_seminar = $this->um->getJumlahSeminarDiikuti($id_mahasiswa);

        // Ambil jumlah belum bayar
        $jumlah_belum_bayar = $this->um->getJumlahBelumBayar($id_mahasiswa);

        // Ambil jumlah history seminar
        $jumlah_history = $this->um->getJumlahHistory($id_mahasiswa);

        
    
    // Fetch history seminar data based on the mahasiswa ID
    $history_seminar = $this->sr->get_by_mahasiswa_id($id_mahasiswa);

    $data = array(
        'history_seminar' => $history_seminar,
        'jumlah_seminar' => $jumlah_seminar,
        'jumlah_belum_bayar' => $jumlah_belum_bayar,
        'jumlah_history' => $jumlah_history,
    
    );
    $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/history-seminar', $data); // Ganti dengan path view yang sesuai
        $this->load->view('template/user/footer');
    // Load the entire template, including the footer
    
}


    // Fungsi untuk menampilkan halaman sertifikat
    public function generateCertificate($id_seminar)
    {
        // Dapatkan id_mahasiswa dari session
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');

        // Ambil data sertifikat berdasarkan id_seminar
        $data['sertifikat'] = $this->sr->getCertificateBySeminar($id_seminar);

        // Ambil nama mahasiswa berdasarkan id_mahasiswa
        $data['mahasiswa'] = $this->sr->getMahasiswaNameById($id_mahasiswa);

        // Cek apakah data sertifikat dan mahasiswa ada
        if ($data['sertifikat'] && $data['mahasiswa']) {
            // Load view sertifikat
            $this->load->view('user/sertifikat', $data);
        } else {
            show_404();
        }
    }



}
