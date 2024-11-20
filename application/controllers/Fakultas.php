<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fakultas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        }
        $this->load->model('Fakultas_model', 'fakultas');
    }

    public function index()
    {
        $title = 'Data Fakultas';
        $loaddata = $this->fakultas->get_data();
        $data = array(
            'title' => $title,
            'fakultas' => $loaddata,
        );
        $this->template->load('template/template_v', 'fakultas/fakultas_v', $data);
    }

    public function detail($id = NULL)
    {
        $id = $this->uri->segment(3);
        $get_row = $this->fakultas->get_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $fakultas = $get_row->result();
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
            $title = "Detail {$nama_fakultas}";
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
                'fakultas' => $fakultas,
            );
            $this->template->load('template/template_v', 'fakultas/fakultas_d', $data);
        } else {
            $this->session->set_flashdata('warning', 'Data masih kosong!');
            redirect('fakultas');
        }
    }
}
?>
