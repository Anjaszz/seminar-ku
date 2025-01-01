<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Seminar_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Sertifikat_model');
        $this->load->model('Prodi_model');
        $this->load->library('session');
        $this->load->library('ciqrcode');
    }

    public function index() {
        // Check login and get user data
        if (!$this->session->userdata('user_data')) {
            redirect('user/auth');
        }
     
        $nim = $this->session->userdata('nim');
        if (!$nim) {
            redirect('user/auth');
        }
     
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/auth');
        }
     
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
     
        // Get seminar data
        $data['jumlah_seminar'] = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
        $data['jumlah_belum_bayar'] = $this->User_model->getJumlahBelumBayar($id_mahasiswa); 
        $data['jumlah_history'] = $this->User_model->getJumlahHistory($id_mahasiswa);
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
        $data['lokasi_seminar'] = $this->Seminar_model->getLokasiSeminar();
     
        // Get filtered seminar data
        $id_lokasi = $this->input->get('id_lokasi');
        if ($id_lokasi && $id_lokasi != 0) {
            $data['seminar_data'] = $this->Seminar_model->getSeminarDataByLocation($id_lokasi);
        } else {
            $data['seminar_data'] = $this->Seminar_model->getSeminarData();
        }
        // Process each seminar
   if (!empty($data['seminar_data'])) {
    foreach ($data['seminar_data'] as &$seminar) {
        $registration = $this->Pendaftaran_model->isRegistered($seminar->id_seminar, $id_mahasiswa);
        $seminar->is_registered = $registration ? true : false;
        $seminar->id_stsbyr = $registration ? $registration->id_stsbyr : null;
        $seminar->id_pendaftaran = $registration ? $registration->id_pendaftaran : null;

        $seminar->is_history = $this->User_model->isHistory($seminar->id_seminar, $id_mahasiswa);

        $tiket_info = $this->User_model->getSlotTiketAndTiketTerjual($seminar->id_seminar);
        $seminar->is_slot_habis = ($tiket_info && $tiket_info->tiket_terjual >= $tiket_info->slot_tiket);

        // Calculate remaining days & progress
        $today = new DateTime();
    $seminar_date = new DateTime($seminar->tgl_pelaksana);
    $interval = $today->diff($seminar_date);
    $remaining_days = $interval->days;
    
    // Untuk progress bar gunakan skala 100 hari
    $total_duration = 100;
    $progress = 100 - (($remaining_days / $total_duration) * 100);
    
    $seminar->remaining_days = $remaining_days;
    $seminar->progress = round(max(0, min(100, $progress))); // Pastikan antara 0-100 dan dibulatkan
    }
}

// Load views
$this->load->view('template/user/header', $data);
$this->load->view('template/user/navbar', $data);
$this->load->view('user/home', $data);
$this->load->view('template/user/footer');
}
    
    
    public function profil() {
        // Ambil id_mahasiswa dari session
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
        
        if (empty($id_mahasiswa)) {
            $this->session->set_flashdata('error', 'Anda belum login.');
            redirect('user/auth');
        }
    
        $mahasiswa = $this->User_model->getMahasiswaProfile($id_mahasiswa);
        
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/home');
        }
    
        $data['prodi'] = $this->User_model->getAllProdi();
    
        // Tangani pengiriman formulir untuk pembaruan profil
        if ($this->input->post('submit')) {
            // Debug: Cek data yang diterima
            log_message('info', 'Data POST: ' . print_r($this->input->post(), true));
            // Tangani unggahan file untuk foto profil
            $config['upload_path'] = './uploads/profil/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // 2MB
    
            $this->load->library('upload', $config);
            $foto = $mahasiswa->foto; // Simpan foto lama jika tidak ada upload baru
    
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $foto = $upload_data['file_name'];
                $this->User_model->updateProfilePicture($id_mahasiswa, $foto);
                $this->session->set_flashdata('message_success', 'Foto profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('message_error', $this->upload->display_errors());
            }
    
            // Perbarui data mahasiswa lainnya
            $data_update = [
                'nama_mhs' => $this->input->post('nama_mhs'),
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'id_prodi' => $this->input->post('id_prodi')
            ];
    
            // Perbarui data mahasiswa di database
            if ($this->User_model->updateMahasiswa($id_mahasiswa, $data_update)) {
                $this->session->set_flashdata('message_success', 'Data profil berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('message_error', 'Gagal memperbarui data profil.');
            }
    
            redirect('user/home/profil');
        }
    
        // Ambil data jumlah
        $data['jumlah_seminar'] = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
        $data['jumlah_belum_bayar'] = $this->User_model->getJumlahBelumBayar($id_mahasiswa);
        $data['jumlah_history'] = $this->User_model->getJumlahHistory($id_mahasiswa);
        $data['mahasiswa'] = $mahasiswa;
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
    
        // Load view
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/profil', $data);
        $this->load->view('template/user/footer');
    }
    
    
    

    public function detail($id_seminar) {
        // Get seminar details
        if (!$this->session->userdata('user_data')) {
            redirect('user/auth'); // Redirect to login if not logged in
        }
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/auth'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/auth');
        }
        $this->load->model('User_model'); // Sesuaikan nama model Anda
        
        // Ambil data jumlah
        $id_mahasiswa = $this->session->userdata('id_mahasiswa'); // Ambil id mahasiswa dari session

        // Ambil jumlah seminar yang diikuti
        $jumlah_seminar = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);

        // Ambil jumlah belum bayar
        $jumlah_belum_bayar = $this->User_model->getJumlahBelumBayar($id_mahasiswa);

        // Ambil jumlah history seminar
        $jumlah_history = $this->User_model->getJumlahHistory($id_mahasiswa);

        // Kirim data ke view
        $data['jumlah_seminar'] = $jumlah_seminar;
        $data['jumlah_belum_bayar'] = $jumlah_belum_bayar;
        $data['jumlah_history'] = $jumlah_history;
    
        // Kirim nama mahasiswa ke view
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
    
        $data['seminar'] = $this->User_model->getDetailSeminarByID($id_seminar);
        
        // Check if seminar exists
        if (!$data['seminar']) {
            show_404();
        }

        
        
        // Load the Pendaftaran_model to check registration status
        $this->load->model('Pendaftaran_model');
        $data['isRegistered'] = $this->Pendaftaran_model->isRegistered($id_seminar, $this->session->userdata('id_mahasiswa'));
        
        // Load views
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/detail', $data);
        $this->load->view('template/user/footer');
    }
    

    public function daftar($id_seminar) {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
    
        if (empty($id_mahasiswa)) {
            $this->session->set_flashdata('message_error', 'Anda harus login terlebih dahulu!');
            redirect('user/auth');
            return;
        }
    
        if ($this->Pendaftaran_model->isRegistered($id_seminar, $id_mahasiswa)) {
            $this->session->set_flashdata('message_error', 'Anda sudah terdaftar untuk seminar ini!');
            redirect('user/home');
            return;
        }
    
        $data = array(
            'id_seminar' => $id_seminar,
            'id_mahasiswa' => $id_mahasiswa,
            'tgl_daftar' => date('Y-m-d'),
            'jam_daftar' => date('H:i:s'),
            'id_stsbyr' => 2,
            'id_metode' => 3
        );
    
        if ($this->Pendaftaran_model->daftarkanSeminar($data)) {
            
            $this->session->set_flashdata('message_success', 'Pendaftaran seminar berhasil!, Silahkan lanjutkan pembayaran');
            
        } else {
            $this->session->set_flashdata('message_error', 'Pendaftaran seminar gagal!');
            
        }
        redirect('user/home');
    
        
    }
    

    public function belumbayar() {
        if (!$this->session->userdata('user_data')) {
            redirect('user/auth'); // Redirect to login if not logged in
        }
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/auth'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/auth');
        }
        $this->load->model('User_model'); // Sesuaikan nama model Anda
        
        // Ambil data jumlah
        $id_mahasiswa = $this->session->userdata('id_mahasiswa'); // Ambil id mahasiswa dari session

        // Ambil jumlah seminar yang diikuti
        $jumlah_seminar = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);

        // Ambil jumlah belum bayar
        $jumlah_belum_bayar = $this->User_model->getJumlahBelumBayar($id_mahasiswa);

        // Ambil jumlah history seminar
        $jumlah_history = $this->User_model->getJumlahHistory($id_mahasiswa);

        // Kirim data ke view
        $data['jumlah_seminar'] = $jumlah_seminar;
        $data['jumlah_belum_bayar'] = $jumlah_belum_bayar;
        $data['jumlah_history'] = $jumlah_history;
    
        // Kirim nama mahasiswa ke view
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
        // Mengambil data seminar dengan id_stsbyr = 2
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');  // Mengambil id_mahasiswa dari session
    
        if ($id_mahasiswa) {
            // Mengambil data seminar yang sudah terdaftar dengan id_stsbyr = 1
            $seminar_data = $this->Seminar_model->getSeminarDaftar($id_mahasiswa);
        // Filter data untuk hanya mengambil yang id_stsbyr = 2
        $filtered_data = array_filter($seminar_data, function($seminar) {
            return $seminar->id_stsbyr == 2;
        });

        // Mengirim data ke view
        $data['seminar_data'] = $filtered_data;
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/belumbayar', $data); // Ganti dengan path view yang sesuai
        $this->load->view('template/user/footer');
    }else {
        // Jika id_mahasiswa tidak ditemukan, arahkan ke halaman login atau tampilkan pesan error
        redirect('user/auth');  // atau sesuaikan dengan kebutuhan Anda
    }}

    public function terdaftar() {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');  // Mengambil id_mahasiswa dari session
        if (!$this->session->userdata('user_data')) {
            redirect('user/auth'); // Redirect to login if not logged in
        }
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/auth'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/auth');
        }

        $this->load->model('User_model'); // Sesuaikan nama model Anda
        
        // Ambil data jumlah
        $id_mahasiswa = $this->session->userdata('id_mahasiswa'); // Ambil id mahasiswa dari session

        // Ambil jumlah seminar yang diikuti
        $jumlah_seminar = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);

        // Ambil jumlah belum bayar
        $jumlah_belum_bayar = $this->User_model->getJumlahBelumBayar($id_mahasiswa);

        // Ambil jumlah history seminar
        $jumlah_history = $this->User_model->getJumlahHistory($id_mahasiswa);

        // Kirim data ke view
        $data['jumlah_seminar'] = $jumlah_seminar;
        $data['jumlah_belum_bayar'] = $jumlah_belum_bayar;
        $data['jumlah_history'] = $jumlah_history;
    
        // Kirim nama mahasiswa ke view
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
    
        if ($id_mahasiswa) {
            // Mengambil data seminar yang sudah terdaftar dengan id_stsbyr = 1
            $seminar_data = $this->Seminar_model->getSeminarDaftar($id_mahasiswa);
        // Filter data untuk hanya mengambil yang id_stsbyr = 2
        $filtered_data = array_filter($seminar_data, function($seminar) {
            return $seminar->id_stsbyr == 1;
        });

        // Mengirim data ke view
        $data['seminar_data'] = $filtered_data;
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/seminar-terdaftar', $data); // Ganti dengan path view yang sesuai
        $this->load->view('template/user/footer');
    }else {
        // Jika id_mahasiswa tidak ditemukan, arahkan ke halaman login atau tampilkan pesan error
        redirect('user/auth');  // atau sesuaikan dengan kebutuhan Anda
    }}
    
    public function batal($id_pendaftaran) {
        // Load model
        $this->load->model('User_model');
    
        // Hapus data pendaftaran berdasarkan id_pendaftaran
        $result = $this->User_model->hapusPendaftaran($id_pendaftaran);
    
        if ($result) {
            $this->session->set_flashdata('success', 'Pendaftaran seminar berhasil dibatalkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal membatalkan pendaftaran seminar.');
        }
    
        // Redirect kembali ke halaman seminar yang belum dibayar
        redirect('user/home/belumbayar');
    }

    public function seminar_history() {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
    
        // Cek login dan session
        if (!$this->session->userdata('user_data')) {
            redirect('user/auth');
        }
    
        $nim = $this->session->userdata('nim');
        if (!$nim) {
            redirect('user/auth');
        }
    
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/auth');
        }
    
        // Ambil jumlah seminar
        $jumlah_seminar = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
        $jumlah_belum_bayar = $this->User_model->getJumlahBelumBayar($id_mahasiswa);
        $jumlah_history = $this->User_model->getJumlahHistory($id_mahasiswa);
    
        // Ambil data history seminar termasuk tanggal pelaksanaan
        $history_seminar = $this->Sertifikat_model->get_by_mahasiswa_id($id_mahasiswa);
    
        // Kirim data ke view
        $data = array(
            'history_seminar' => $history_seminar,
            'jumlah_seminar' => $jumlah_seminar,
            'jumlah_belum_bayar' => $jumlah_belum_bayar,
            'jumlah_history' => $jumlah_history,
            'nama_mahasiswa' => $mahasiswa->nama_mhs,
        );
    
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/history-seminar', $data);
        $this->load->view('template/user/footer');
    }
    

public function file()
{
    $id_mahasiswa = $this->session->userdata('id_mahasiswa');  // Mengambil id_mahasiswa dari session
    if (!$this->session->userdata('user_data')) {
        redirect('user/auth'); // Redirect to login if not logged in
    }
    
    $nim = $this->session->userdata('nim');
    if (!$nim) {
        redirect('user/auth'); // Jika NIM tidak ada di session, redirect ke login
    }

    $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
    if (!$mahasiswa) {
        $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
        redirect('user/auth');
    }

    // Pastikan memuat model File_model
    $this->load->model('File_model'); // Tambahkan ini jika belum ada
    $this->load->model('Seminar_model');
    
    // Ambil data jumlah
    $jumlah_seminar = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
    $jumlah_belum_bayar = $this->User_model->getJumlahBelumBayar($id_mahasiswa);
    $jumlah_history = $this->User_model->getJumlahHistory($id_mahasiswa);
    $file_data = $this->File_model->get_by_mahasiswa_id($id_mahasiswa);

    

    // Kirim data ke view
    $data = array(
        'jumlah_seminar' => $jumlah_seminar,
        'jumlah_belum_bayar' => $jumlah_belum_bayar,
        'jumlah_history' => $jumlah_history,
        'nama_mahasiswa' => $mahasiswa->nama_mhs,
        'file_data' => $file_data,  // Pastikan seminar_data dikirim ke view
    );

    $this->load->view('template/user/header', $data);
    $this->load->view('template/user/navbar', $data);
    $this->load->view('user/file', $data); // Ganti dengan path view yang sesuai
    $this->load->view('template/user/footer');
}

public function cari_seminar()
{
    $nama_seminar = $this->input->get('nama_seminar');
    $data['seminar_data'] = $this->Seminar_model->cariSeminarByNama($nama_seminar);
    $this->load->view('user/home', $data);
}


}