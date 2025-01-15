<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Seminar_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Sertifikat_model');
        $this->load->model('Komunitas_model');
        $this->load->model('Prodi_model');
        $this->load->library('session');
        $this->load->model('ChatModel');
        $this->load->library('upload');
        $this->load->helper('url');
    }

    public function index($id_vendor, $id_seminar) {

        if (!$this->session->userdata('user_data')) {
            redirect('user/auth'); // Redirect to login if not logged in
        }
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/auth'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/auth');
        }
        $this->load->model('User_model'); // Sesuaikan nama model Anda
        
        // Ambil data jumlah
        $id_mahasiswa = $this->session->userdata('id_mahasiswa'); // Ambil id mahasiswa dari session

        // Ambil jumlah seminar yang diikuti
        $jumlah_seminar = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);

        // Ambil jumlah belum bayar
        $jumlah_belum_bayar = $this->User_model->getJumlahBelumBayar($id_mahasiswa);

        // Ambil jumlah history seminar
        $jumlah_history = $this->User_model->getJumlahHistory($id_mahasiswa);

        // Kirim data ke view
        $data['jumlah_seminar'] = $jumlah_seminar;
        $data['jumlah_belum_bayar'] = $jumlah_belum_bayar;
        $data['jumlah_history'] = $jumlah_history;
    
        // Kirim nama mahasiswa ke view
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
        // Mendapatkan id_mahasiswa dari session
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');

        $data['chats'] = $this->ChatModel->getChats($id_vendor, $id_seminar);
        $data['id_vendor'] = $id_vendor;
        $data['id_seminar'] = $id_seminar;

        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('chat/index', $data);
        $this->load->view('template/user/footer');
    }

    public function send() {
        $id_vendor = $this->input->post('id_vendor');
        $id_seminar = $this->input->post('id_seminar');
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
        $pesan = $this->input->post('pesan');

        $data = [
            'id_vendor' => $id_vendor,
            'id_seminar' => $id_seminar,
            'id_mahasiswa' => $id_mahasiswa,
            'pesan' => $pesan,
        ];

        // Handle file upload
        if (!empty($_FILES['file']['name'])) {
            $config['upload_path'] = './uploads/chat/';
            $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx';
            $config['max_size'] = 2048; // 2MB
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file')) {
                $upload_data = $this->upload->data();
                $data['file_path'] = 'uploads/chat/' . $upload_data['file_name'];

                // Tentukan tipe file
                $ext = strtolower($upload_data['file_ext']);
                $data['tipe_file'] = in_array($ext, ['.pdf', '.doc', '.docx']) ? 'document' : 'image';
            } else {
                // Debug untuk upload error
                log_message('error', 'Upload error: ' . $this->upload->display_errors());
            }
        }

        // Simpan data ke database
        if ($this->ChatModel->saveChat($data)) {
            redirect('user/chat/index/' . $id_vendor . '/' . $id_seminar);
        } else {
            log_message('error', 'Gagal menyimpan data chat ke database.');
        }
    }
}
