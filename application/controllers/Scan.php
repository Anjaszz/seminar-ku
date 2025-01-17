<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth'); // Redirect ke halaman login
        } 
        $this->load->model([
            'Seminar_model' => 'sm',
            'Scan_model' => 'sc',
            'Pendaftaran_model' => 'pf',
        ]);
    }

    public function index()
    {
        $title = 'Scan Presensi Offline';
        $get_seminar = $this->sm->get_data_offline();
        $latest_seminar_id = $this->sc->get_latest_seminar_id(); 

        $data = [
            'title' => $title,
            'seminar' => $get_seminar,
            'latest_seminar_id' => $latest_seminar_id, 
        ];

        $this->template->load('template/template_v', 'scan/scan_v', $data);
    }

    public function webcam($id)
    {
        $get_row = $this->sm->get_sm_row($id);
        if ($get_row->num_rows() > 0) {
            $row = $get_row->row();
            $id_seminar = $row->id_seminar;
            $attradd = array('class' => 'btn  btn-gradient-success');
            $tambahdata = anchor("pendaftaran/add/{$id_seminar}", "<i class='feather icon-user-plus'></i>Tambah Data", $attradd);
            $nama_seminar = $row->nama_seminar;
            $title = "Scan Tiket Seminar";
            $data = [
                'title' => $title,
                'btnadd' => $tambahdata,
                'id_seminar' => $id_seminar,
                'nama_seminar' => $nama_seminar,
            ];
            $this->template->load('template/template_v', 'scan/scan_desktop_v', $data);
        } else {
            redirect('pendaftaran');
        }
    }

   public function proses_kehadiran()
{
    $id = $this->input->post('id');
    $idSeminar = $this->input->post('seminar');
    $is_registered = $this->sc->is_student_registered_for_seminar($id, $idSeminar);

    // Get student details using NIM
    $student = $this->pf->cek_id($id);

    if (!$student) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mahasiswa tidak ditemukan!</div>');
        $this->load->view('scan/empty_v');
        return;
    }

    // Check if the student is registered for the seminar
    $is_registered = $this->sc->is_student_registered_for_seminar($student->id_mahasiswa, $idSeminar);

    if (!$is_registered) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mahasiswa tidak terdaftar pada seminar ini!</div>');
        $this->load->view('scan/empty_v');
        return;
    }

    // Validasi id_scan
    $id_scan_status = $this->sc->get_id_scan_status($student->id_mahasiswa, $idSeminar);

    if ($id_scan_status == 0) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">QR Code anda belum aktif!</div>');
        $this->load->view('scan/empty_v');
        return;
    }

    $peserta = $this->pf->cek_id($id);
    $get_row = $this->sm->get_sm_row($id);
    $tgl = date('Y-m-d');
    $jam = date('H:i:s');
    $cek_id = $this->sc->cek_id($id);
    $cek_khd = $this->sc->cek_khd($id, $idSeminar);
    $nama_seminar = $this->sc->get_nama_seminar_by_id($idSeminar);

    if (!$cek_id) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data Tidak Ditemukan!</div>');
        $this->load->view('scan/empty_v');
    } else if ($cek_khd && $cek_khd->id_stskhd == 2) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Sudah Melakukan Presensi!</div>');
        $rows = $get_row->row();
        $row = [
            'nomor_induk' => $cek_khd->nim,
            'tgl_khd' => $tgl,
            'jam_khd' => $jam,
            'fakultas' => $cek_khd->nama_fakultas,
            'prodi' => $cek_khd->nama_prodi,
            'nama_mhs' => $cek_khd->nama_mhs,
            'email' => $cek_khd->email,
            'no_telp' => $cek_khd->no_telp,
            'nama_seminar' => $nama_seminar 
        ];
        $this->load->view('scan/scan_result_v', $row);
    } else {
        
        $data = [
            'id_mahasiswa' => $cek_id->id_mahasiswa,
            'nomor_induk' => $cek_id->nim,
            'id_seminar' => $idSeminar,
            'tgl_khd' => $tgl,
            'jam_khd' => $jam,
            'id_stskhd' => 2,
        ];

        $row = [
            'nomor_induk' => $cek_id->nim,
            'tgl_khd' => $tgl,
            'jam_khd' => $jam,
            'fakultas' => $cek_id->nama_fakultas,
            'prodi' => $cek_id->nama_prodi,
            'nama_mhs' => $cek_id->nama_mhs,
            'email' => $cek_id->email,
            'no_telp' => $cek_id->no_telp,
            'nama_seminar' => $nama_seminar 
        ];

        // Insert presensi data
        $this->sc->insert_data($data);

        // Prepare data for history_seminar
        $history_data = [
            'id_seminar' => $idSeminar,
            'nama_seminar' => $nama_seminar,
            'id_mahasiswa' => $cek_id->id_mahasiswa,
            'nama_mahasiswa' => $cek_id->nama_mhs,
            'tanggal_pelaksanaan' => $tgl,
        ];

        // Insert history seminar data
        if (!$this->sc->insert_data_history($history_data)) {
            log_message('error', 'Failed to insert history seminar data: ' . print_r($history_data, true));
        }

        // Delete data from pendaftaran_seminar where id_stsbyr = 2
        $this->db->where('id_mahasiswa', $cek_id->id_mahasiswa);
        $this->db->where('id_seminar', $idSeminar);
        $this->db->where('id_stsbyr', 1);
        $this->db->delete('pendaftaran_seminar');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Selamat Datang!</div>');
        $this->load->view('scan/scan_result_v', $row);
    }
}

}

    

