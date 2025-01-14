<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('ChatModel');
        $this->load->library('upload');
        $this->load->helper('url');
    }

    public function index($id_vendor, $id_seminar) {
        $data['chats'] = $this->ChatModel->getChats($id_vendor, $id_seminar);
        $data['id_vendor'] = $id_vendor;
        $data['id_seminar'] = $id_seminar;
        $this->load->view('chat/index', $data);
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
