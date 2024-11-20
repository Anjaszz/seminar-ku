<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Cek apakah user sudah login, jika belum arahkan ke login
        if (!$this->session->userdata('admin_id')) {
            redirect('master/auth');
        }
        // Load model untuk mengambil data total
        $this->load->model('Home_model'); // Pastikan model sudah diload
    }

    public function index()
    {
        $title = 'Home';
        $mahasiswa = anchor('mahasiswa', 'Data Mahasiswa');
        $fakultas = anchor('fakultas', 'Data Fakultas');
        $prodi = anchor('prodi', 'Data Prodi');
        $jenjang = anchor('jenjang', 'Data Jenjang');
        $box = $this->info_box();
        $data = array(
            'mahasiswa' => $mahasiswa,
            'fakultas' => $fakultas,
            'prodi' => $prodi,
            'jenjang' => $jenjang,
            'title' => $title,
            'box' => $box,
        );
        $this->template->load('master/template/template_v', 'master/home', $data);
    }

    public function info_box()
    {
        $box = [
            [
                'color'         => 'facebook',
                'total'     => $this->Home_model->total('mahasiswa'), // Memanggil method total dari model
                'title'        => 'Total Mahasiswa',
                'icon'        => 'users',
                'link' => site_url('mahasiswa')
            ],
            [
                'color'         => 'success',
                'total'     => $this->Home_model->total('fakultas'), // Memanggil method total dari model
                'title'        => 'Total Fakultas',
                'icon'        => 'poll',
                'link' => site_url('fakultas')
            ],
            [
                'color'         => 'warning',
                'total'     => $this->Home_model->total('prodi'), // Memanggil method total dari model
                'title'        => 'Total Prodi',
                'icon'        => 'book',
                'link' => site_url('prodi')
            ],
            [
                'color'         => 'googleplus',
                'total'     => $this->Home_model->total('seminar'), // Memanggil method total dari model
                'title'        => 'Total Seminar',
                'icon'        => 'layer-group',
                'link' => site_url('seminar')
            ],
        ];
        $info_box = json_decode(json_encode($box), FALSE);
        return $info_box;
    }
}
