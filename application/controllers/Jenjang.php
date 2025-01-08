<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenjang extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Pastikan pengguna sudah login
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth'); // Redirect ke halaman login
        }
        $this->load->model('Jenjang_model', 'jjg');
    }

    public function index()
    {
        $title = "Data Jenjang Pendidikan";
        $loaddata = $this->jjg->get_data();
        $data = array(
            'jenjang' => $loaddata,
            'title' => $title,
        );
        $this->template->load('template/template_v', 'jenjang/jenjang_v', $data);
    }

    public function detail($id)
    {
        $id = $this->uri->segment(3);
        $get_row = $this->jjg->get_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $jenjang = $get_row->result();
            $id_mahasiswa = $row->id_mahasiswa;
            $nim = $row->nim;
            $nama_mhs = $row->nama_mhs;
            $email = $row->email;
            $no_telp = $row->no_telp;
            $id_fakultas = $row->id_fakultas;
            $id_prodi = $row->id_prodi;
            $id_jenjang = $row->id_jenjang;
            $nama_fakultas = $row->nama_fakultas;
            $nama_prodi = $row->nama_prodi;
            $nama_jenjang = $row->nama_jenjang;
            $kode_fakultas = $row->kode_fakultas;
            $kode_prodi = $row->kode_prodi;
            $kode_jenjang = $row->kode_jenjang;
            $title = "Detail {$nama_jenjang}";
            $data = array(
                'id_mahasiswa' => $id_mahasiswa,
                'nim' => $nim,
                'nama_mhs' => $nama_mhs,
                'email' => $email,
                'no_telp' => $no_telp,
                'id_fakultas' => $id_fakultas,
                'id_prodi' => $id_prodi,
                'id_jenjang' => $id_jenjang,
                'nama_fakultas' => $nama_fakultas,
                'nama_prodi' => $nama_prodi,
                'nama_jenjang' => $nama_jenjang,
                'kode_fakultas' => $kode_fakultas,
                'kode_prodi' => $kode_prodi,
                'kode_jenjang' => $kode_jenjang,
                'title' => $title,
                'jenjang' => $jenjang,
            );
            $this->template->load('template/template_v', 'jenjang/jenjang_d', $data);
        } else {
            $this->session->set_flashdata('warning', 'Data masih kosong!');
            redirect('jenjang');
        }
    }
}
?>