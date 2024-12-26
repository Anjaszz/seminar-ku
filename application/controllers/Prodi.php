<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Prodi extends CI_Controller
{
    
    public function __construct()
    {

        parent::__construct();

        // Pastikan pengguna sudah login
        if (!$this->session->userdata('admin_id')) {
            redirect('master/auth'); // Redirect ke halaman login
        }
        
           $this->load->model('Prodi_model', 'ksi');
    }

    public function index()
    {
        
        $title = 'Data Program Studi';
       
        $loaddata = $this->ksi->get_data();
    
        $data = array(
            'title' => $title,
            'prodi' => $loaddata,
        );
        $this->template->load('master/template/template_v', 'prodi/prodi_v', $data);
    }
    public function detail($id = NULL)
    {
        $id = $this->uri->segment(3);
        $get_row = $this->ksi->get_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $prodi = $get_row->result();
            $id_mahasiswa = $row->id_mahasiswa;
            $nim = $row->nim;
            $nama_mhs = $row->nama_mhs;
            $email = $row->email;
            $no_telp = $row->no_telp;
            $id_fakultas = $row->id_fakultas;
            $id_prodi = $row->id_prodi;
            $nama_fakultas = $row->nama_fakultas;
            $nama_prodi = $row->nama_prodi;
            $kode_fakultas = $row->kode_fakultas;
            $kode_prodi = $row->kode_prodi;
            $title = "Detail {$nama_prodi}";
            $data = array(
                'id_mahasiswa' => $id_mahasiswa,
                'nim' => $nim,
                'nama_mhs' => $nama_mhs,
                'email' => $email,
                'no_telp' => $no_telp,
                'id_fakultas' => $id_fakultas,
                'id_prodi' => $id_prodi,
                'nama_fakultas' => $nama_fakultas,
                'nama_prodi' => $nama_prodi,
                'kode_fakultas' => $kode_fakultas,
                'kode_prodi' => $kode_prodi,
                'title' => $title,
                'prodi' => $prodi,
            );
            $this->template->load('master/template/template_v', 'prodi/prodi_d', $data);
        } else {
            $this->session->set_flashdata('warning', 'Data masih kosong!');
            redirect('prodi');
        }
    }
    
}