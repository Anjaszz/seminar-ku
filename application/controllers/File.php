<?php
defined('BASEPATH') or exit('No direct script access allowed');

class File extends MY_Controller
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
            'File_model' => 'vm',
            'User_model' => 'um', // Tambahkan ini
        ]
    );
    $this->load->library('user_agent');
    $this->load->library('upload');
}


    public function index()
    {
        $title = 'File Seminar';
        // Ambil semua data dari tabel history_seminar
        $file = $this->sm->get_data();
        
        $data = array(
            'title' => $title,
            'file' => $file,
        );
        $this->template->load('template/template_v', 'file/file_v', $data);
    }

    public function upload($id_seminar)
{
    // Ambil nama seminar berdasarkan id_seminar
    $seminar = $this->sm->getSeminarById($id_seminar);
    $nama_seminar = isset($seminar->nama_seminar) ? $seminar->nama_seminar : 'seminar';

    // Bersihkan nama seminar dari karakter yang tidak diinginkan untuk nama file
    $nama_seminar_clean = preg_replace('/[^a-zA-Z0-9-_]/', '_', strtolower($nama_seminar));

    // Konfigurasi upload file
    $config['upload_path']   = './uploads/file';
    $config['allowed_types'] = 'zip';
    $config['max_size']      = 50000; // Batasan ukuran file

    // Nama file diubah menjadi file_(nama_seminar)
    $config['file_name']     = 'file_' . $nama_seminar;

    // Inisialisasi upload dengan konfigurasi
    $this->upload->initialize($config);

    if ($this->upload->do_upload('file')) {
        // Jika upload berhasil
        $upload_data = $this->upload->data();
        $file = $upload_data['file_name'];

        // Update data file di database
        if ($this->vm->update_file($id_seminar, $file)) {
            $this->session->set_flashdata('success', 'File berhasil diupload.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengupdate database.');
        }
    } else {
        // Jika upload gagal
        $this->session->set_flashdata('error', $this->upload->display_errors());
    }

    // Redirect ke halaman awal
    redirect('file');
}


    public function hapus_file($id_seminar)
{
    // Ambil data file berdasarkan id_seminar
    $file = $this->sm->get_data($id_seminar);
    
    // Cek apakah file ada dan file benar-benar ada
    if (!empty($file->file) && file_exists('./uploads/file/' . $file->file)) {
        // Hapus file file
        unlink('./uploads/file/' . $file->file);
    }
    
    // Update kolom file menjadi NULL di database
    $this->vm->hapus_file($id_seminar);

    // Redirect kembali ke halaman file
    $this->session->set_flashdata('success', 'File berhasil dihapus.');
    redirect('file');
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
    $history_seminar = $this->vm->get_by_mahasiswa_id($id_mahasiswa);

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





}
