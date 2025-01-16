<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Genqr extends MY_Controller {
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth');
        } 
        $this->load->model([
            'Seminar_model' => 'sm',
            'Scan_model' => 'sc',
            'Pendaftaran_model' => 'pf',
        ]);
        $this->load->model('Genqr_model', 'gen');
        $this->load->library('ciqrcode');
    }

    public function index()
    {
        $title = 'QRCode Presensi Online';
        $get_seminar = $this->sm->get_data();
        $latest_seminar_id = $this->sc->get_latest_seminar_id(); 

        $data = [
            'title' => $title,
            'seminar' => $get_seminar,
            'latest_seminar_id' => $latest_seminar_id, 
        ];

        $this->template->load('template/template_v', 'genqr/genqr_v', $data);
    }

    public function generate($id_seminar) {
        // Ambil data seminar
        $seminar = $this->db->get_where('seminar', ['id_seminar' => $id_seminar])->row();
        
        if ($seminar) {
            // Generate QR Code
            $params['data'] = $id_seminar; // Hanya berisi id_seminar
            $params['level'] = 'H';
            $params['size'] = 10;
            $qr_image = 'seminar_' . $id_seminar . '_qr.png';
            $params['savename'] = FCPATH . "uploads/qr_image/" . $qr_image;
            
            // Buat direktori jika belum ada
            if (!file_exists(FCPATH . "uploads/qr_image/")) {
                mkdir(FCPATH . "uploads/qr_image/", 0777, true);
            }
            
            $this->ciqrcode->generate($params);
            
            $data = array(
                'title' => 'QR Code Presensi',
                'seminar' => $seminar,
                'qr_image' => $qr_image
            );
            
            $this->template->load('template/template_v', 'genqr/result_v', $data);
        } else {
            $this->session->set_flashdata('error', 'Seminar tidak ditemukan');
            redirect('seminar');
        }
    }
    public function toggle_scan() {
        // Set header JSON
        header('Content-Type: application/json');
        
        $id_seminar = $this->input->post('id_seminar');
        $current_status = $this->input->post('current_status');
        
        if (!$id_seminar) {
            $response = [
                'success' => false,
                'message' => 'ID Seminar tidak valid'
            ];
            echo json_encode($response);
            return;
        }
        
        try {
            $new_status = $current_status == 1 ? 0 : 1;
            
            $this->db->where('id_seminar', $id_seminar);
            $update = $this->db->update('seminar', ['id_scan' => $new_status]);
            
            if ($update) {
                $response = [
                    'success' => true,
                    'status' => $new_status,
                    'message' => $new_status == 1 ? 'Presensi berhasil diaktifkan' : 'Presensi berhasil dinonaktifkan'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Gagal mengubah status presensi'
                ];
            }
            
        } catch (Exception $e) {
            $response = [
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ];
        }
        
        echo json_encode($response);
        exit;
    }
}