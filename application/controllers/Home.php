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
        $id_vendor = $this->session->userdata('id_vendor'); // Ambil id_vendor dari session

        // Hitung total mahasiswa berdasarkan id_vendor
        $total_mahasiswa = $this->home->total_mahasiswa_by_vendor($id_vendor);
        $total_mhs = count($total_mahasiswa); // Hitung jumlah mahasiswa

        $total_sponsor = $this->home->total_sponsor_by_vendor($id_vendor);
        $total_sp = count($total_sponsor);

        $total_seminar = $this->home->total_seminar_by_vendor($id_vendor);
        $total_sm = count($total_seminar);

        $total_tiket_terjual = $this->home->total_tiket_by_vendor($id_vendor); // Ambil total tiket terjual


        // Data untuk info box
        $box = [
            [
                'color' => 'facebook',
                'total' => $total_mhs,
                'title' => 'Total Peserta',
                'icon' => 'users',
                'link' => site_url('mahasiswa'),
            ],
            [
                'color' => 'success',
                'total' => $total_sp,
                'title' => 'Total Sponsor',
                'icon' => 'poll',
                'link' => site_url('fakultas'),
            ],
            [
                'color' => 'warning',
                'total' => $total_sm,
                'title' => 'Total Seminar',
                'icon' => 'book',
                'link' => site_url('prodi'),
            ],
            [
                'color' => 'googleplus',
                'total' => $total_tiket_terjual,
                'title' => 'Total Tiket Terjual',
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
