<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Seminar_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Sertifikat_model');
        $this->load->library('session');
        $this->load->library('ciqrcode');
    }
    public function index() {
        $this->load->view('user/landingpage');
    }

    public function login() {
        // Cek apakah form dikirim
        if ($this->input->post()) {
            $nim = $this->input->post('nim');
            $password = $this->input->post('password');
    
            // Log input untuk debugging
            log_message('debug', 'NIM: ' . $nim . ', Password: ' . $password);
    
            // Validasi login menggunakan model
            $user = $this->User_model->validate_login($nim, $password);
    
            // Log hasil validasi
            log_message('debug', 'User: ' . json_encode($user));
    
            if ($user) {
                // Set session data
                $this->session->set_userdata('user_data', $user);
                $this->session->set_userdata('id_mahasiswa', $user->id_mahasiswa);
                $this->session->set_userdata('nim', $nim); 
    
                // Cek apakah user harus mengganti password (id_reset = 0)
                if ($user->id_reset == 0) {
                    // Arahkan ke halaman ganti password jika id_reset masih 0
                    redirect('user/ganti_password');
                } else {
                    // Arahkan ke home jika id_reset sudah 1
                    redirect('user/home');
                }
            } else {
                // Set flashdata untuk error
                $this->session->set_flashdata('login_error', 'NIM atau Password salah. Silahkan coba lagi.');
                redirect('user/login');
            }
        } else {
            // Load login view
            $this->load->view('user/login');
        }
    }
    

    public function ubah_password() {
        // Cek apakah user sudah login dan memiliki id_mahasiswa di session
        if (!$this->session->userdata('id_mahasiswa')) {
            // Jika belum login atau tidak ada id_mahasiswa, redirect ke halaman login
            $this->session->set_flashdata('login_error', 'Anda harus login terlebih dahulu!');
            redirect('user/login');
        } else {
            // Load view ganti_password
            $this->load->view('user/ganti_password');
        }
    }
    
    public function ganti_password() {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
    
        if (!$id_mahasiswa) {
            echo json_encode(['status' => 'error', 'message' => 'Anda harus login terlebih dahulu!']);
            return;
        }
    
        if ($this->input->post()) {
            $old_password = $this->input->post('old_password');
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
    
            $user = $this->User_model->get_user_by_id($id_mahasiswa);
    
            if (md5($old_password) == $user->password) {
                $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\[\]{};\':"\\|,.<>\/?~-])[A-Za-z\d!@#$%^&*()_+\[\]{};\':"\\|,.<>\/?~-]{8,}$/';
    
                if (preg_match($password_regex, $new_password)) {
                    if ($new_password == $confirm_password) {
                        $result = $this->User_model->update_password($id_mahasiswa,($new_password));
    
                        if ($result) {
                            echo json_encode(['status' => 'success', 'message' => 'Password berhasil diubah!']);
                        } else {
                            echo json_encode(['status' => 'error', 'message' => 'Gagal mengganti password.']);
                        }
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Password baru dan konfirmasi tidak cocok.']);
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Password harus terdiri dari minimal 8 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Password lama salah.']);
            }
        } else {
            $this->load->view('user/ganti_password');
        }
    }
    
    
    
    
    
    
    
    public function home() {
        // Check if the user is logged in
        if (!$this->session->userdata('user_data')) {
            redirect('user/login'); // Redirect to login if not logged in
        }
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/login'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $this->load->model('User_model');
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/login');
        }
    
        // Ambil ID mahasiswa dari session
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
    
        // Ambil data seminar yang diikuti, belum bayar, dan history
        $jumlah_seminar = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
        $jumlah_belum_bayar = $this->User_model->getJumlahBelumBayar($id_mahasiswa);
        $jumlah_history = $this->User_model->getJumlahHistory($id_mahasiswa);
    
        // Kirim data ke view
        $data['jumlah_seminar'] = $jumlah_seminar;
        $data['jumlah_belum_bayar'] = $jumlah_belum_bayar;
        $data['jumlah_history'] = $jumlah_history;
    
        // Kirim nama mahasiswa ke view
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
    
        // Ambil data seminar dari model
        $this->load->model('Seminar_model');
        $this->load->model('Pendaftaran_model');
        $data['seminar_data'] = $this->Seminar_model->getSeminarData();
    
        // Cek pendaftaran dan history untuk setiap seminar
        foreach ($data['seminar_data'] as &$seminar) {
            $registration = $this->Pendaftaran_model->isRegistered($seminar->id_seminar, $id_mahasiswa);
            if ($registration) {
                $seminar->is_registered = true;
                $seminar->id_stsbyr = $registration->id_stsbyr;
                $seminar->id_pendaftaran = isset($registration->id_pendaftaran) ? $registration->id_pendaftaran : null;
            } else {
                $seminar->is_registered = false;
                $seminar->id_stsbyr = null;
                $seminar->id_pendaftaran = null;
            }
        
            // Cek apakah seminar ada di history
            $seminar->is_history = $this->User_model->isHistory($seminar->id_seminar, $id_mahasiswa);
        
            // Dapatkan slot_tiket dan tiket_terjual dari model
            $tiket_info = $this->User_model->getSlotTiketAndTiketTerjual($seminar->id_seminar);
        
            // Cek apakah tiket sudah habis
            if ($tiket_info && $tiket_info->tiket_terjual >= $tiket_info->slot_tiket) {
                $seminar->is_slot_habis = true;
            } else {
                $seminar->is_slot_habis = false;
            }
        }
    
        // Load views dengan data
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/home', $data);
        $this->load->view('template/user/footer');
    }
    
    
 
    public function profil() {
        // Ambil id_mahasiswa dari session
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
        
        if (empty($id_mahasiswa)) {
            // Jika tidak ada session id_mahasiswa, arahkan ke halaman login
            $this->session->set_flashdata('error', 'Anda belum login.');
            redirect('user/login');
        }

        // Ambil data mahasiswa berdasarkan id_mahasiswa
        $mahasiswa = $this->User_model->getMahasiswaProfile($id_mahasiswa);
        
        // Cek apakah data mahasiswa ditemukan
        if (!$mahasiswa) {
            // Jika data mahasiswa tidak ditemukan, arahkan ke halaman lain
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/home');
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
        // Kirim data ke view
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
            redirect('user/login'); // Redirect to login if not logged in
        }
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/login'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/login');
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
            redirect('user/login');
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
            redirect('user/login'); // Redirect to login if not logged in
        }
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/login'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/login');
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
        redirect('login');  // atau sesuaikan dengan kebutuhan Anda
    }}

    public function terdaftar() {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');  // Mengambil id_mahasiswa dari session
        if (!$this->session->userdata('user_data')) {
            redirect('user/login'); // Redirect to login if not logged in
        }
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/login'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/login');
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
        redirect('login');  // atau sesuaikan dengan kebutuhan Anda
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
        redirect('user/belumbayar');
    }
    

    public function generate($id_mahasiswa) {
        // Ambil NIM berdasarkan id_mahasiswa
        $nim = $this->User_model->getNimByIdMahasiswa($id_mahasiswa);
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');  // Mengambil id_mahasiswa dari session
        if (!$this->session->userdata('user_data')) {
            redirect('user/login'); // Redirect to login if not logged in
        }
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/login'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/login');
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

        // Kirim data ke 
        
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
        $data['jumlah_seminar'] = $jumlah_seminar;
        $data['jumlah_belum_bayar'] = $jumlah_belum_bayar;
        $data['jumlah_history'] = $jumlah_history;
    
    
        if ($nim) {
            // Pengaturan QR Code
            $config['cacheable']    = true; // boolean, default is true
            $config['cachedir']     = './assets/'; // string, the cache directory name
            $config['errorlog']     = './assets/'; // string, the error log directory name
            $config['imagedir']     = './uploads/qr_image/'; // Direktori untuk menyimpan file gambar QR Code
            $config['quality']      = true; // boolean, the default is true
            $config['size']         = '1024'; // Integer, the default is 1024
            $config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
            $config['white']        = array(70, 130, 180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);
    
            // Nama file QR Code
            $image_name = $nim . '.png';
    
            // Buat data untuk QR Code (berisi NIM)
            $params['data'] = $nim;
            $params['level'] = 'H'; // H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
    
            // Generate QR Code
            $this->ciqrcode->generate($params);
    
            // Tampilkan hasil QR Code di view
            $data['nim'] = $nim; // Pastikan NIM juga tersedia di view
            $data['qrcode'] = base_url('uploads/qr_image/' . $image_name);
            
            $this->load->view('template/user/header', $data);
            $this->load->view('template/user/navbar', $data);
            $this->load->view('user/etiket', $data); // Ganti dengan path view yang sesuai
            $this->load->view('template/user/footer');
        } else {
            echo 'NIM tidak ditemukan.';
        }
    }
    
    
public function seminar_history()
{

    $id_mahasiswa = $this->session->userdata('id_mahasiswa');  // Mengambil id_mahasiswa dari session
        if (!$this->session->userdata('user_data')) {
            redirect('user/login'); // Redirect to login if not logged in
        }
        $sertifikat = $this->Seminar_model->get_data();
    
        // Ambil NIM dari session
        $nim = $this->session->userdata('nim');
    
        if (!$nim) {
            redirect('user/login'); // Jika NIM tidak ada di session, redirect ke login
        }
    
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/login');
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
        
        
    
    // Fetch history seminar data based on the mahasiswa ID
    $history_seminar = $this->Sertifikat_model->get_by_mahasiswa_id($id_mahasiswa);

    $data = array(
        'history_seminar' => $history_seminar,
        'jumlah_seminar' => $jumlah_seminar,
        'jumlah_belum_bayar' => $jumlah_belum_bayar,
        'jumlah_history' => $jumlah_history,
        
        'nama_mahasiswa' => $mahasiswa->nama_mhs,
    
    );
    $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/history-seminar', $data); // Ganti dengan path view yang sesuai
        $this->load->view('template/user/footer');
    // Load the entire template, including the footer
    
}

// Tampilkan halaman forgot password
public function forgot_password() {
    $this->load->view('user/forgot_password');
}

// Kirim email dengan link reset password
public function send_reset_link() {
    $email = $this->input->post('email');
    $this->load->model('User_model');

    // Cek apakah email ada di tabel mahasiswa
    $mahasiswa = $this->User_model->get_mahasiswa_by_email($email);

    if ($mahasiswa) {
        // Buat token reset password (sebagai hash dari email dan waktu)
        $reset_token = bin2hex(random_bytes(16)); // Token yang lebih aman
        $expiry_time = date('Y-m-d H:i:s', strtotime('+5 minutes')); // Waktu kadaluarsa 5 menit

        // Simpan token dan waktu kadaluarsa ke database
        $this->User_model->save_reset_token($email, $reset_token, $expiry_time);

        $reset_link = 'http://192.168.83.130/SIMAS/SIMAS/user/reset_password/' . urlencode($reset_token) . '?email=' . urlencode($email);

        // Kirim email dengan link reset password
        $this->load->library('email');
        $this->email->from('sistemmanajemenseminar@gmail.com', 'Admin SIMAS');
        $this->email->to($email);
        $this->email->subject('Reset Password Akun SIMAS Anda');
        $this->email->message('Klik link berikut untuk mereset password Anda: <a href="'.$reset_link.'">Reset Password</a>');

        // Kirim email
        if ($this->email->send()) {
            $this->session->set_flashdata('email_sent', 'Link reset password telah dikirim ke email Anda.');
        } else {
            $this->session->set_flashdata('email_error', 'Gagal mengirim email. Silakan coba lagi.');
        }

        redirect('user/forgot_password');
    } else {
        $this->session->set_flashdata('email_error', 'Email tidak ditemukan.');
        redirect('user/forgot_password');
    }
}


// Tampilkan form untuk reset password
public function reset_password($token = null) {
    $email = $this->input->get('email'); // Ambil email dari parameter URL
    
    if (!$token || !$email) {
        show_404(); // Token atau email tidak valid
    }

    // Load model untuk mengambil data pengguna
    $this->load->model('User_model');
    $user = $this->User_model->get_mahasiswa_by_email($email);

    if (!$user || $user->reset_token !== $token) {
        show_404(); // Token tidak valid
    }

    // Cek apakah token sudah kedaluwarsa
    $current_time = new DateTime();
    $expiry_time = new DateTime($user->expiry_time);

    if ($current_time > $expiry_time) {
        // Jika token kedaluwarsa
        $this->session->set_flashdata('error', 'Link reset password sudah kedaluwarsa. Silakan minta link baru.');
        
        redirect('user/forgot_password');
    } else {
        // Token valid dan tidak kedaluwarsa
        $data['email'] = $email; // Bawa email ke view
        $this->load->view('user/reset_password', $data);
    }
}




// Update password di tabel user_mhs
public function update_password() {
    $new_password = md5($this->input->post('password'));
    $email = $this->input->post('email'); // Ambil email dari input form

    $this->load->model('User_model');
    $mahasiswa = $this->User_model->get_mahasiswa_by_email($email);
    

    if ($mahasiswa) {
        // Update password di tabel user_mhs
        $this->User_model->update_password_by_id_mahasiswa($mahasiswa->id_mahasiswa, $new_password);
        $this->User_model->clear_reset_token($email);
        $this->session->set_flashdata('password_updated', 'Password berhasil diubah.');
        redirect('user/login');
    } else {
        $this->session->set_flashdata('password_error', 'Gagal mengubah password. Email tidak valid.');
        redirect('user/reset_password/' . md5($email) . '?email=' . urlencode($email));
    }
}
public function file()
{
    $id_mahasiswa = $this->session->userdata('id_mahasiswa');  // Mengambil id_mahasiswa dari session
    if (!$this->session->userdata('user_data')) {
        redirect('user/login'); // Redirect to login if not logged in
    }
    
    $nim = $this->session->userdata('nim');
    if (!$nim) {
        redirect('user/login'); // Jika NIM tidak ada di session, redirect ke login
    }

    $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
    if (!$mahasiswa) {
        $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
        redirect('user/login');
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






}
