<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Seminar_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Sertifikat_model');
        $this->load->library('session');
        $this->load->library('ciqrcode');
    }

    public function etiket($id_mahasiswa, $id_seminar) {
        $param_id_mahasiswa = $id_mahasiswa;
        $param_id_seminar = $id_seminar;
        
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
        
        if (!$this->session->userdata('user_data')) {
            redirect('user/auth');
        }
        
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
        
        if (!$nim) {
            redirect('user/auth');
        }
        
        // Lanjutkan menggunakan $param_id_mahasiswa dan $param_id_seminar untuk data di view
        $data['id_mahasiswa'] = $param_id_mahasiswa;
        $data['id_seminar'] = $param_id_seminar;
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/auth');
        }
    
        // Ambil data seminar berdasarkan id_seminar
        $seminar_data = $this->Seminar_model->get_seminar_by_id($id_seminar); // Menggunakan fungsi yang telah Anda buat
    
        if ($seminar_data) {
            $data['nama_seminar'] = $seminar_data->nama_seminar; // Ambil nama seminar
            $data['tgl_pelaksana'] = $seminar_data->tgl_pelaksana; // Ambil tanggal pelaksanaan seminar
        } else {
            $data['nama_seminar'] = 'Seminar Tidak Ditemukan'; // Default jika tidak ada
            $data['tgl_pelaksana'] = 'Tanggal Tidak Ditemukan'; // Default jika tidak ada
        }
    
        // Ambil data jumlah
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
        $data['jumlah_seminar'] = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
        $data['jumlah_belum_bayar'] = $this->User_model->getJumlahBelumBayar($id_mahasiswa);
        $data['jumlah_history'] = $this->User_model->getJumlahHistory($id_mahasiswa);
        $data['jumlah_komunitas'] = $this->User_model->getJumlahKomunitas($id_mahasiswa);
    
        if ($nim) {
            // Pengaturan QR Code
            $config['cacheable'] = true;
            $config['cachedir'] = './assets/';
            $config['errorlog'] = './assets/';
            $config['imagedir'] = './uploads/qr_image/';
            $config['quality'] = true;
            $config['size'] = '1024';
            $config['black'] = array(224, 255, 255);
            $config['white'] = array(70, 130, 180);
            $this->ciqrcode->initialize($config);
    
            // Nama file QR Code
            $image_name = $nim . '.png';
    
            // Buat data untuk QR Code
            $params['data'] = $nim;
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
    
            // Generate QR Code
            $this->ciqrcode->generate($params);
    
            // Tampilkan hasil QR Code di view
            $data['nim'] = $nim;
            $data['qrcode'] = base_url('uploads/qr_image/' . $image_name);
    
            $this->load->view('template/user/header', $data);
            $this->load->view('template/user/navbar', $data);
            $this->load->view('user/etiket', $data);
            $this->load->view('template/user/footer');
        } else {
            echo 'NIM tidak ditemukan.';
        }
    }

    public function updateScan() {
        // Pastikan request adalah AJAX
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $id_seminar = $this->input->post('id_seminar');
        
        // Validasi input
        if (!$id_mahasiswa || !$id_seminar) {
            $response = array('success' => false, 'message' => 'Data tidak lengkap');
            echo json_encode($response);
            return;
        }

        // Update scan melalui model
        $update = $this->User_model->updateScanStatus($id_mahasiswa, $id_seminar);
        
        if ($update) {
            $response = array('success' => true, 'message' => 'Scan berhasil diupdate');
        } else {
            $response = array('success' => false, 'message' => 'Gagal mengupdate scan');
        }

        echo json_encode($response);
    }
    
    public function cekPresensi() {
        $id_mahasiswa = $this->input->post('id_mahasiswa');
        $id_seminar = $this->input->post('id_seminar');
    
        $cekPresensi = $this->User_model->cekPresensi($id_mahasiswa, $id_seminar);
    
        if ($cekPresensi) {
            echo json_encode(['success' => true, 'message' => 'Presensi berhasil!']);
        } else {
            // Jika gagal, set id_scan kembali ke 0
            $this->User_model->resetScan($id_mahasiswa, $id_seminar);
            echo json_encode(['success' => false, 'message' => 'Presensi gagal, coba lagi.']);
        }}


        
}    