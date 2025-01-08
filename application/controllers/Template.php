<?php
class MY_Controller extends MY_Controller {
    protected $vendor_data;

    public function __construct() {
        parent::__construct();
        
        // Pastikan user sudah login
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth');
        }

        // Load model
        $this->load->model('Home_Model', 'home');
        
        // Ambil id_vendor dari session
        $id_vendor = $this->session->userdata('id_vendor');
        
        // Ambil data vendor
        $vendor = $this->home->get_vendor_by_id($id_vendor);
        $this->vendor_data = [
            'nama_vendor' => isset($vendor) ? $vendor->nama_vendor : 'SIMAS',
            'id_vendor' => $id_vendor
        ];
        
        // Set data vendor untuk semua view
        $this->load->vars($this->vendor_data);
    }
}