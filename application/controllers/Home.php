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
        $total_mhs = !empty($total_mahasiswa) ? count($total_mahasiswa) : 0; // Hitung jumlah mahasiswa, jika tidak ada set ke 0

        // Hitung total sponsor
        $total_sponsor = $this->home->total_sponsor_by_vendor($id_vendor);
        $total_sp = !empty($total_sponsor) ? count($total_sponsor) : 0; // Hitung jumlah sponsor, jika tidak ada set ke 0

        // Hitung total seminar
        $total_seminar = $this->home->total_seminar_by_vendor($id_vendor);
        $total_sm = !empty($total_seminar) ? count($total_seminar) : 0; // Hitung jumlah seminar, jika tidak ada set ke 0

        // Hitung total tiket terjual
        $total_tiket_terjual = $this->home->total_tiket_by_vendor($id_vendor); // Ambil total tiket terjual
        $total_tr = !empty($total_tiket_terjual) ? $total_tiket_terjual : 0; // Jika tidak ada set ke 0

        // Hitung total transaksi
        $total_transaksi = $this->home->total_transaksi_by_vendor($id_vendor); // Ambil total transaksi
        $total_trx = !empty($total_transaksi) ? $total_transaksi : 0; // Jika tidak ada set ke 0


        // Data untuk info box
        $box = [
            [
                'color' => 'facebook', // Warna untuk Total Peserta
                'total' => $total_mhs,
                'title' => 'Total Peserta',
                'icon' => 'users', // Ikon untuk Total Peserta
                'link' => site_url('pendaftaran'),
            ],
            [
                'color' => 'success', // Warna untuk Total Sponsor
                'total' => $total_sp,
                'title' => 'Total Sponsor',
                'icon' => 'handshake', // Ikon untuk Total Sponsor
                'link' => site_url('sponsor'),
            ],
            [
                'color' => 'warning', // Warna untuk Total Seminar
                'total' => $total_sm,
                'title' => 'Total Seminar',
                'icon' => 'chalkboard-teacher', // Ikon untuk Total Seminar
                'link' => site_url('seminar'),
            ],
            [
                'color' => 'info', // Warna untuk Total Tiket Terjual
                'total' => $total_tr,
                'title' => 'Total Tiket Terjual',
                'icon' => 'ticket-alt', // Ikon untuk Total Tiket Terjual
                'link' => site_url('tiket'),
            ],
            [
                'color' => 'primary', // Warna untuk Total Uang Masuk
                'total' => $total_trx,
                'title' => 'Total Uang Masuk',
                'icon' => 'money-bill-wave', // Ikon untuk Total Uang Masuk
                'link' => site_url('laporankeuangan'),
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
