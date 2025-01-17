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
    
        $data['jumlah_seminar'] = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
        $data['jumlah_belum_bayar'] = $this->User_model->getJumlahBelumBayar($id_mahasiswa);
        $data['jumlah_history'] = $this->User_model->getJumlahHistory($id_mahasiswa);
        $data['jumlah_komunitas'] = $this->User_model->getJumlahKomunitas($id_mahasiswa);
    
        // Ambil nama seminar berdasarkan id_seminar
        $seminar = $this->db->get_where('seminar', ['id_seminar' => $id_seminar])->row();
        $data['nama_seminar'] = $seminar ? $seminar->nama_seminar : 'Nama Seminar Tidak Ditemukan';
    
        // Kirim data mahasiswa
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
    
        // Mendapatkan data chat
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
        $id_chat = $this->input->post('id_chat');
    
        $data = [
            'id_vendor' => $id_vendor,
            'id_seminar' => $id_seminar,
            'id_mahasiswa' => $id_mahasiswa,
            'pesan' => $pesan,
        ];
    
        // Jika ada id_chat, berarti ini adalah edit
        if (!empty($id_chat)) {
            $this->ChatModel->updateChat($id_chat, $data);
        } else {
            // Handle file upload dan save seperti sebelumnya
            if (!empty($_FILES['file']['name'])) {
                $config['upload_path'] = './uploads/chat/';
                $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx';
                $config['max_size'] = 2048;
                $this->upload->initialize($config);
    
                if ($this->upload->do_upload('file')) {
                    $upload_data = $this->upload->data();
                    $data['file_path'] = 'uploads/chat/' . $upload_data['file_name'];
                    $ext = strtolower($upload_data['file_ext']);
                    $data['tipe_file'] = in_array($ext, ['.pdf', '.doc', '.docx']) ? 'document' : 'image';
                }
            }
    
            $this->ChatModel->saveChat($data);
        }
    
        redirect('user/chat/index/' . $id_vendor . '/' . $id_seminar);
    }
    
    public function delete() {
        $id_chat = $this->input->post('id_chat');
        $chat = $this->ChatModel->getChatById($id_chat);
    
        // Validasi kepemilikan chat
        if ($chat && $chat['id_mahasiswa'] == $this->session->userdata('id_mahasiswa')) {
            // Hapus file jika ada
            if (!empty($chat['file_path']) && file_exists(FCPATH . $chat['file_path'])) {
                unlink(FCPATH . $chat['file_path']);
            }
    
            $result = $this->ChatModel->deleteChat($id_chat);
            echo json_encode(['success' => $result]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        }
    }
}
