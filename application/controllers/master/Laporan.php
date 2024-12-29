<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {


    public function __construct()
    {
        parent::__construct();

        // Pastikan pengguna sudah login
        if (!$this->session->userdata('admin_id')) {
            redirect('master/auth'); // Redirect ke halaman login
        } 
        $this->load->model('Mahasiswa_model', 'mhs');
        $this->load->model('Laporan_master_model');
        $this->load->model('Vendor_model', 'vnd');
    }

    public function peserta()
    {
       
        $mhs = $this->mhs->lihat_data();
       
        $data = array(
            'mahasiswa' =>  $mhs,
            'title' => 'Data Peserta',
        );
        $this->template->load('master/template/template_v', 'master/laporan/laporanpeserta', $data);
    }

    public function vendor()
    {
       // Pagination configuration
       $items_per_page = 10;
       $current_page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
       $start = ($current_page - 1) * $items_per_page;
       
       // Load model dulu sebelum menggunakannya
       $this->load->model('Vendor_model', 'vnd');
       
       // Get total records and paginated data
       $total_items = $this->vnd->count_all_vendors();
       $vendor = $this->vnd->get_paginated_vendors($start, $items_per_page);

        $vnd = $this->vnd->lihat_data();
       
        $data = array(
            'vendor' =>  $vnd,
            'title' => 'Data Vendor Seminar',
            'total_items' => $total_items,
            'items_per_page' => $items_per_page,
            'current_page' => $current_page
        );
        $this->template->load('master/template/template_v', 'master/laporan/laporanvendor', $data);
    }

    public function keuangan() {
        $data['title'] = 'Laporan Keuangan';
        $data['laporan'] = $this->Laporan_master_model->get_laporan_keuangan();
        $data['total_pemasukan'] = $this->Laporan_master_model->total_pemasukan();
        $this->template->load('master/template/template_v', 'master/laporan/laporankeuangan', $data);
    }
}
