<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Pastikan pengguna sudah login
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth'); // Redirect ke halaman login
        }

        // Load model untuk digunakan dalam controller
        $this->load->model('Home_Model', 'home');
    }

    public function index()
{
    // Judul halaman
    $title = 'Home';

    // Data navigasi
    $mahasiswa = anchor('mahasiswa', 'Data Mahasiswa');
    $fakultas = anchor('fakultas', 'Data Fakultas');
    $prodi = anchor('prodi', 'Data Prodi');
    $jenjang = anchor('jenjang', 'Data Jenjang');

    // Informasi box
    $box = $this->info_box();

    // Ambil id_vendor dari session
    $id_vendor = $this->session->userdata('id_vendor');
    
    // Ambil nama_vendor berdasarkan id_vendor
    $this->load->model('Home_model');
    $vendor = $this->Home_model->get_vendor_by_id($id_vendor);
    
    // Simpan nama_vendor ke dalam data yang akan diteruskan ke view
    $data['nama_vendor'] = isset($vendor) ? $vendor->nama_vendor : 'Vendor Tidak Ditemukan';

    // Data untuk view
    $data['mahasiswa'] = $mahasiswa;
    $data['fakultas'] = $fakultas;
    $data['prodi'] = $prodi;
    $data['jenjang'] = $jenjang;
    $data['title'] = $title;
    $data['box'] = $box;

    // Load template dan view
    $this->template->load('template/template_v', 'home/home_v', $data);
}


    public function info_box()
    {
        // Data untuk info box
        $box = [
            [
                'color' => 'facebook',
                'total' => $this->home->total('mahasiswa'),
                'title' => 'Total Mahasiswa',
                'icon' => 'users',
                'link' => site_url('mahasiswa'),
            ],
            [
                'color' => 'success',
                'total' => $this->home->total('fakultas'),
                'title' => 'Total Fakultas',
                'icon' => 'poll',
                'link' => site_url('fakultas'),
            ],
            [
                'color' => 'warning',
                'total' => $this->home->total('prodi'),
                'title' => 'Total Prodi',
                'icon' => 'book',
                'link' => site_url('prodi'),
            ],
            [
                'color' => 'googleplus',
                'total' => $this->home->total('seminar'),
                'title' => 'Total Seminar',
                'icon' => 'layer-group',
                'link' => site_url('seminar'),
            ],
        ];

        // Konversi array ke objek
        $info_box = json_decode(json_encode($box), FALSE);
        return $info_box;
    }

    public function navbar() {
        // Ambil id_vendor dari session
        $id_vendor = $this->session->userdata('id_vendor');
        
        // Ambil nama_vendor berdasarkan id_vendor
        $this->load->model('Home_model');
        $vendor = $this->Home_model->get_vendor_by_id($id_vendor);
        
        // Simpan nama_vendor ke dalam data yang akan diteruskan ke view
        $this->data['nama_vendor'] = $vendor->nama_vendor;
    
        // Muat view navbar dengan data nama_vendor
        $this->load->view('template/navbar', $this->data);
    }
}
