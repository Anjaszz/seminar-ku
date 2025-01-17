<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Presensi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('user_data')) {
            redirect('user/auth'); // Redirect to login if not logged in
        }
        $this->load->model('scan_model', 'sc');
        $this->load->model('pendaftaran_model', 'pf');
        $this->load->model('seminar_model', 'sm');
    }

    public function hadir($idSeminar) {
        // Get NIM dari session atau input
        $id = $this->session->userdata('nim'); // sesuaikan dengan sistem login Anda
        
        // Get student details using NIM
        $student = $this->pf->cek_id($id);

        if (!$student) {
            $this->session->set_flashdata('swal_icon', 'error');
            $this->session->set_flashdata('swal_title', 'Gagal!');
            $this->session->set_flashdata('swal_text', 'Mahasiswa tidak ditemukan!');
            redirect('user/home');
            return;
        }

        // Check if student is registered for the seminar
        $is_registered = $this->sc->is_student_registered_for_seminar($student->id_mahasiswa, $idSeminar);

        if (!$is_registered) {
            $this->session->set_flashdata('swal_icon', 'error');
            $this->session->set_flashdata('swal_title', 'Gagal!');
            $this->session->set_flashdata('swal_text', 'Anda tidak terdaftar pada seminar ini!');
            redirect('user/home');
            return;
        }

        // Validasi id_scan
        $id_scan_status = $this->sc->get_id_scan_status_online($idSeminar);

        if ($id_scan_status == 0) {
            $this->session->set_flashdata('swal_icon', 'error');
            $this->session->set_flashdata('swal_title', 'Gagal!');
            $this->session->set_flashdata('swal_text', 'Presensi belum diaktifkan!');
            redirect('user/home');
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
            $this->session->set_flashdata('swal_icon', 'error');
            $this->session->set_flashdata('swal_title', 'Gagal!');
            $this->session->set_flashdata('swal_text', 'Data tidak ditemukan!');
            redirect('user/home');
            return;
        }

        

        // Jika belum presensi, proses presensi
        $data = [
            'id_mahasiswa' => $cek_id->id_mahasiswa,
            'nomor_induk' => $cek_id->nim,
            'id_seminar' => $idSeminar,
            'tgl_khd' => $tgl,
            'jam_khd' => $jam,
            'id_stskhd' => 2,
        ];

        // Insert presensi data
        if ($this->sc->insert_data($data)) {
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

            // Delete data from pendaftaran_seminar where id_stsbyr = 1
            $this->db->where('id_mahasiswa', $cek_id->id_mahasiswa);
            $this->db->where('id_seminar', $idSeminar);
            $this->db->where('id_stsbyr', 1);
            $this->db->delete('pendaftaran_seminar');

            // Set success message dan redirect
            $this->session->set_flashdata('swal_icon', 'success');
            $this->session->set_flashdata('swal_title', 'Berhasil!');
            $this->session->set_flashdata('swal_text', 'Presensi seminar anda berhasil');
            redirect('user/home/seminar_history');
        } else {
            // Jika gagal insert
            $this->session->set_flashdata('swal_icon', 'error');
            $this->session->set_flashdata('swal_title', 'Gagal!');
            $this->session->set_flashdata('swal_text', 'Terjadi kesalahan saat memproses presensi');
            redirect('user/home');
        }
    }
}