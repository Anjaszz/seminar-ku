<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Pastikan pengguna sudah login
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth');
        }

        // Load model
        $this->load->model('Home_model', 'home');
        
        // Ambil id_vendor dari session
        $id_vendor = $this->session->userdata('id_vendor');
        
        // Ambil vendor berdasarkan id_vendor
        $vendor = $this->home->get_vendor_by_id($id_vendor);
        
        // Ambil email admin
        $vendor_email = $this->home->get_email_by_vendor_id($id_vendor);
        
        // Siapkan semua data untuk view
        $data = [
            'nama_vendor' => isset($vendor) ? $vendor->nama_vendor : 'SIMAS',
            'id_vendor' => $id_vendor,
            'admin_email' => $vendor_email
        ];

        // Set data untuk semua view
        $this->load->vars($data);
        
        // Load header dengan data
        $this->load->view('template/header', $data);
    }
}