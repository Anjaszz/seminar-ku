<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Seminar_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Sertifikat_model');
        $this->load->model('Komunitas_model');
        $this->load->model('Prodi_model');
        $this->load->library('session');
        $this->load->library('ciqrcode');
    }

   public function index() {
    // Data testimoni
    $testimonials = [
        [
            'avatar' => 'https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/man-user-circle-icon.png',
            'name' => 'Ahmad Fadhil',
            'rating' => 5,
            'content' => 'Seminar yang sangat informatif dan bermanfaat. Pembicara sangat kompeten dan materi yang disampaikan sangat relevan dengan kebutuhan industri saat ini.'
        ],
        [
            'avatar' => 'https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/man-user-circle-icon.png',
            'name' => 'Sarah Putri',
            'rating' => 5,
            'content' => 'Pengalaman yang luar biasa! Saya mendapatkan banyak insight baru dan koneksi yang bermanfaat untuk pengembangan karir saya.'
        ],
        [
            'avatar' => 'https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/man-user-circle-icon.png',
            'name' => 'Reza Prakasa',
            'rating' => 5,
            'content' => 'Platform seminar terbaik yang pernah saya ikuti. Sistem pendaftaran yang mudah dan materi yang berkualitas. Sangat direkomendasikan!'
        ],
        [
            'avatar' => 'https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/man-user-circle-icon.png',
            'name' => 'Putri Rahayu',
            'rating' => 5,
            'content' => 'SIMAS sangat membantu dalam mengelola seminar! Proses registrasi dan presensi jadi lebih cepat berkat fitur QR code.'
        ],
        [
            'avatar' => 'https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/man-user-circle-icon.png',
            'name' => 'Amelia Putri',
            'rating' => 5,
            'content' => '"Sistem ini sangat menghemat waktu dan tenaga. Semua terorganisir dengan baik, dari registrasi hingga laporan akhir.'
        ],
        [
            'avatar' => 'https://uxwing.com/wp-content/themes/uxwing/download/peoples-avatars/man-user-circle-icon.png',
            'name' => 'Daniel Wijaya',
            'rating' => 5,
            'content' => 'SIMAS adalah solusi terbaik untuk seminar modern! Tidak perlu kertas lagi, semua serba digital dan praktis.'
        ],
    ];

    // Data statistik
    $data['total_seminars'] = 50;
    $data['total_participants'] = 1500;
    $data['success_rate'] = 98;
    $data['testimonials'] = $testimonials;

    // Cek apakah pengguna sudah login
    if ($this->session->userdata('user_data')) {
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

        // Ambil data pengguna
        $data['jumlah_seminar'] = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
        $data['jumlah_belum_bayar'] = $this->User_model->getJumlahBelumBayar($id_mahasiswa);
        $data['jumlah_history'] = $this->User_model->getJumlahHistory($id_mahasiswa);
        $data['jumlah_komunitas'] = $this->User_model->getJumlahKomunitas($id_mahasiswa);
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
        $data['lokasi_seminar'] = $this->Seminar_model->getLokasiSeminar();
        $data['kategori_seminar'] = $this->Seminar_model->getKategoriSeminar();
        $data['jenis_seminar'] = $this->Seminar_model->getJenisSeminar();
    } else {
        $data['jumlah_seminar'] = 0;
        $data['jumlah_belum_bayar'] = 0;
        $data['jumlah_history'] = 0;
        $data['jumlah_komunitas'] = 0;
        $data['nama_mahasiswa'] = null;
        $data['lokasi_seminar'] = $this->Seminar_model->getLokasiSeminar();
        $data['kategori_seminar'] = $this->Seminar_model->getKategoriSeminar();
        $data['jenis_seminar'] = $this->Seminar_model->getJenisSeminar();
    }

     // Tangani filter tambahan
     $search = $this->input->get('search');
     $id_lokasi = $this->input->get('id_lokasi');
     $price_range = $this->input->get('price_range');
     $date = $this->input->get('date');
     $lat = $this->input->get('lat');
     $lng = $this->input->get('lng');
     $id_kategori = $this->input->get('id_kategori');
     $id_jenis = $this->input->get('id_jenis');
 
     // Mulai query filter untuk semua seminar
     $filtered_data = $this->Seminar_model->getSeminarData();
 
     // Terapkan filter untuk semua seminar
     if ($search) {
         $filtered_data = $this->Seminar_model->searchSeminars($search);
     }
     if ($id_lokasi) {
         $filtered_data = $this->Seminar_model->getSeminarDataByLocation($id_lokasi);
     }
     if ($price_range) {
         $filtered_data = $this->Seminar_model->getSeminarsByPriceRange($price_range);
     }
     if ($date === 'today') {
         $filtered_data = $this->Seminar_model->getTodaySeminars();
     }
     if ($lat && $lng) {
         $filtered_data = $this->Seminar_model->getNearbySeminars($lat, $lng);
     }
     if ($id_kategori) {
         $filtered_data = $this->Seminar_model->getSeminarsByCategory($id_kategori);
     }
     if ($id_jenis) {
         $filtered_data = $this->Seminar_model->getSeminarDataByType($id_jenis);
     }
 
     // Get dan filter upcoming seminars menggunakan filter yang sama
     $upcoming_seminars = array_filter($filtered_data, function($seminar) {
        return strtotime($seminar->tgl_pelaksana) >= strtotime(date('Y-m-d'));
    });

    // Urutkan berdasarkan tanggal terdekat
    usort($upcoming_seminars, function($a, $b) {
        return strtotime($a->tgl_pelaksana) - strtotime($b->tgl_pelaksana);
    });

    // Ambil 6 seminar terdekat
    $upcoming_seminars = array_slice($upcoming_seminars, 0, 6);

    // Urutkan filtered_data berdasarkan tanggal
    usort($filtered_data, function($a, $b) {
        return strtotime($a->tgl_pelaksana) - strtotime($b->tgl_pelaksana);
    });

    // Proses data seminar
    if (!empty($filtered_data)) {
        foreach ($filtered_data as &$seminar) {
            $this->_processSeminarData($seminar);
        }
    }

    // Proses data upcoming seminars
    if (!empty($upcoming_seminars)) {
        foreach ($upcoming_seminars as &$seminar) {
            $this->_processSeminarData($seminar);
        }
    }
 
     $data['upcoming_seminars'] = $upcoming_seminars;
     $data['seminar_data'] = $filtered_data;
     $data['categories'] = $this->Seminar_model->getCategories();
 
     // Load views
     $this->load->view('template/user/header', $data);
     $this->load->view('template/user/navbar', $data);
     $this->load->view('user/home', $data);
     $this->load->view('template/user/footer');
 }
 // In Controller (update the _processSeminarData method):
private function _processSeminarData(&$seminar) {
    $id_mahasiswa = $this->session->userdata('id_mahasiswa');
    
    if ($this->session->userdata('user_data')) {
        $registration = $this->Pendaftaran_model->isRegistered($seminar->id_seminar, $id_mahasiswa);
        $seminar->is_registered = $registration ? true : false;
        $seminar->id_stsbyr = $registration ? $registration->id_stsbyr : null;
        $seminar->id_pendaftaran = $registration ? $registration->id_pendaftaran : null;
        $seminar->is_history = $this->User_model->isHistory($seminar->id_seminar, $id_mahasiswa);
    } else {
        $seminar->is_registered = false;
        $seminar->id_stsbyr = null;
        $seminar->id_pendaftaran = null;
        $seminar->is_history = false;
    }

    // Get seminar type name
    $jenis_seminar = $this->Seminar_model->getJenisSeminarById($seminar->id_jenis);
    $seminar->nama_jenis = $jenis_seminar ? $jenis_seminar->nama_jenis : null;

    $tiket_info = $this->User_model->getSlotTiketAndTiketTerjual($seminar->id_seminar);
    $seminar->is_slot_habis = ($tiket_info && $tiket_info->tiket_terjual >= $tiket_info->slot_tiket);

    $today = new DateTime();
    $seminar_date = new DateTime($seminar->tgl_pelaksana);
    $interval = $today->diff($seminar_date);
    $remaining_days = $interval->days;

    $total_duration = 100;
    $progress = 100 - (($remaining_days / $total_duration) * 100);

    $seminar->remaining_days = $remaining_days;
    $seminar->progress = round(max(0, min(100, $progress)));
}

// In Seminar_model (add this new method):

    
    public function profil() {
        // Ambil id_mahasiswa dari session
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
        
        if (empty($id_mahasiswa)) {
            $this->session->set_flashdata('error', 'Anda belum login.');
            redirect('user/auth');
        }

        // Ambil data mahasiswa berdasarkan id_mahasiswa
        $mahasiswa = $this->User_model->getMahasiswaProfile($id_mahasiswa);
        
        // Cek apakah data mahasiswa ditemukan
        if (!$mahasiswa) {
            $this->session->set_flashdata('error', 'Data mahasiswa tidak ditemukan.');
            redirect('user/home');
        }
        $data['jumlah_seminar'] = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
        $data['jumlah_belum_bayar'] = $this->User_model->getJumlahBelumBayar($id_mahasiswa);
        $data['jumlah_history'] = $this->User_model->getJumlahHistory($id_mahasiswa);
        $data['jumlah_komunitas'] = $this->User_model->getJumlahKomunitas($id_mahasiswa);
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
        // Ambil data jurusan dari tabel prodi
        $data['prodi'] = $this->User_model->getAllProdi();

        $data['mahasiswa'] = $mahasiswa;
    
        // Load view
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/profil', $data);
        $this->load->view('template/user/footer');
    }

    public function updateProfil() {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
        if (!$id_mahasiswa) {
            redirect('user/auth/login');
        }

        $nama_mhs = $this->input->post('nama_mhs');
        $email = $this->input->post('email');
        $no_telp = $this->input->post('no_telp');
        $id_prodi = $this->input->post('id_prodi');

        // Handle file upload
        $config['upload_path'] = './assets/images/profil/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['file_name'] = 'profil_' . $id_mahasiswa;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];
        } else {
            $foto = null;
        }

        $this->User_model->updateMahasiswa($id_mahasiswa, $nama_mhs, $email, $no_telp, $id_prodi, $foto);
        $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        redirect('user/home/profil');
    }

    public function detail($id_seminar) {
        // Ambil data seminar berdasarkan ID
        $data['seminar'] = $this->User_model->getDetailSeminarByID($id_seminar);
    
        // Periksa apakah data seminar ada
        if (!$data['seminar']) {
            show_404(); // Jika seminar tidak ditemukan, tampilkan halaman 404
        }
    
        // Cek apakah pengguna sudah login
        if ($this->session->userdata('user_data')) {
            // Ambil NIM dari session
            $nim = $this->session->userdata('nim');
    
            if ($nim) {
                // Ambil data mahasiswa berdasarkan NIM
                $mahasiswa = $this->User_model->getMahasiswaByNIM($nim);
    
                if ($mahasiswa) {
                    $data['jumlah_seminar'] = $this->User_model->getJumlahSeminarDiikuti($mahasiswa->id_mahasiswa);
                    $data['jumlah_belum_bayar'] = $this->User_model->getJumlahBelumBayar($mahasiswa->id_mahasiswa);
                    $data['jumlah_history'] = $this->User_model->getJumlahHistory($mahasiswa->id_mahasiswa);
                    $data['jumlah_komunitas'] = $this->User_model->getJumlahKomunitas($mahasiswa->id_mahasiswa);
                    $data['nama_mahasiswa'] = "Hi, " . $mahasiswa->nama_mhs;
                } else {
                    $data['jumlah_seminar'] = 0;
                    $data['jumlah_belum_bayar'] = 0;
                    $data['jumlah_history'] = 0;
                    $data['jumlah_komunitas'] = 0;
                    $data['nama_mahasiswa'] = "Hi, Pengunjung";
                }
            } else {
                $data['jumlah_seminar'] = 0;
                $data['jumlah_belum_bayar'] = 0;
                $data['jumlah_history'] = 0;
                $data['jumlah_komunitas'] = 0;
                $data['nama_mahasiswa'] = "Hi, Pengunjung";
            }
        } else {
            // Jika pengguna belum login, set data default
            $data['jumlah_seminar'] = 0;
            $data['jumlah_belum_bayar'] = 0;
            $data['jumlah_history'] = 0;
            $data['jumlah_komunitas'] = 0;
            $data['nama_mahasiswa'] = "Hi, Pengunjung";
        }
    
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
    
        // Cek harga tiket
        $harga_tiket = $this->Pendaftaran_model->getHargaTiket($id_seminar);
    
        // Set id_stsbyr berdasarkan harga_tiket
        $id_stsbyr = ($harga_tiket == 0) ? 1 : 2; // 1: Gratis, 2: Berbayar
    
        $data = array(
            'id_seminar' => $id_seminar,
            'id_mahasiswa' => $id_mahasiswa,
            'tgl_daftar' => date('Y-m-d'),
            'jam_daftar' => date('H:i:s'),
            'id_stsbyr' => $id_stsbyr,
            'id_metode' => 3
        );
    
        if ($this->Pendaftaran_model->daftarkanSeminar($data)) {
            if ($id_stsbyr == 1) {
                $this->session->set_flashdata('message_success', 'Pendaftaran seminar berhasil! Anda sudah terdaftar.');
            } else {
                $this->session->set_flashdata('message_success', 'Pendaftaran seminar berhasil! Silahkan lanjutkan pembayaran.');
            }
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

        $jumlah_komunitas = $this->User_model->getJumlahKomunitas($id_mahasiswa);

        // Kirim data ke view
        $data['jumlah_seminar'] = $jumlah_seminar;
        $data['jumlah_belum_bayar'] = $jumlah_belum_bayar;
        $data['jumlah_history'] = $jumlah_history;
        $data['jumlah_komunitas'] = $jumlah_komunitas;
    
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
        // Ambil jumlah history seminar
        $jumlah_komunitas = $this->User_model->getJumlahKomunitas($id_mahasiswa);


        // Kirim data ke view
        $data['jumlah_seminar'] = $jumlah_seminar;
        $data['jumlah_belum_bayar'] = $jumlah_belum_bayar;
        $data['jumlah_history'] = $jumlah_history;
        $data['jumlah_komunitas'] = $jumlah_komunitas;
    
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

    public function linkseminar($id_seminar) {
        // Cek login
        if (!$this->session->userdata('user_data')) {
            redirect('user/auth');
        }
    
        // Ambil data seminar
        $seminar = $this->Seminar_model->getSeminarlink($id_seminar);
        
        if (!$seminar) {
            $this->session->set_flashdata('error', 'Seminar tidak ditemukan.');
            redirect('user/home/terdaftar');
        }
    
        // Cek apakah mahasiswa terdaftar di seminar ini
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
        $is_registered = $this->Pendaftaran_model->isRegistered($id_seminar, $id_mahasiswa);
        
        if (!$is_registered) {
            $this->session->set_flashdata('error', 'Anda tidak terdaftar di seminar ini.');
            redirect('user/home/terdaftar');
        }
    
        // Siapkan data untuk view
        $data['seminar'] = $seminar;
        
        // Debug: Periksa struktur data
        // var_dump($seminar); die;
    
        // Load view dengan template
        $data['nama_mahasiswa'] = $this->session->userdata('nama_mahasiswa');
        $data['jumlah_seminar'] = $this->User_model->getJumlahSeminarDiikuti($id_mahasiswa);
        $data['jumlah_belum_bayar'] = $this->User_model->getJumlahBelumBayar($id_mahasiswa);
        $data['jumlah_history'] = $this->User_model->getJumlahHistory($id_mahasiswa);
        $data['jumlah_komunitas'] = $this->User_model->getJumlahKomunitas($id_mahasiswa);
    
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/link_seminar', $data);
        $this->load->view('template/user/footer');
    }
    public function gabungKomunitas($id_seminar)
    {
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
        
        if (!$id_mahasiswa) {
            // Redirect to login if not logged in
            redirect('user/auth');
        }
    
        // Ambil data seminar berdasarkan id_seminar
        $seminar = $this->Seminar_model->getSeminarlink($id_seminar);
        
        if (!$seminar) {
            // Jika seminar tidak ditemukan, tampilkan error
            $this->session->set_flashdata('error', 'Seminar tidak ditemukan.');
            redirect('user/home/terdaftar');
        }
    
        // Ambil id_vendor dari seminar
        $id_vendor = $seminar->id_vendor;
    
        // Cek apakah sudah ada data id_mahasiswa dan id_seminar di tabel komunitas
        
        $existing_community = $this->Komunitas_model->cekKeanggotaan($id_mahasiswa, $id_seminar);
    
        if ($existing_community) {
            // Jika sudah ada data, arahkan ke halaman chat
            redirect('user/chat/index/' . $id_vendor . '/' . $id_seminar);
        } else {
            // Data yang akan disimpan ke tabel komunitas
            $data = [
                'id_seminar' => $id_seminar,
                'id_mahasiswa' => $id_mahasiswa,
                'id_vendor' => $id_vendor
            ];
    
            // Menyimpan data ke tabel komunitas
            $this->Komunitas_model->gabungKomunitas($data);
    
            // Set pesan sukses dan redirect kembali
            $this->session->set_flashdata('success', 'Anda berhasil bergabung dengan komunitas seminar.');
            redirect('user/home/komunitas');
        }
    }

    public function komunitas() {

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

        $jumlah_komunitas = $this->User_model->getJumlahKomunitas($id_mahasiswa);

        // Kirim data ke view
        $data['jumlah_seminar'] = $jumlah_seminar;
        $data['jumlah_belum_bayar'] = $jumlah_belum_bayar;
        $data['jumlah_history'] = $jumlah_history;
        $data['jumlah_komunitas'] = $jumlah_komunitas;
    
        // Kirim nama mahasiswa ke view
        $data['nama_mahasiswa'] = $mahasiswa->nama_mhs;
        // Mendapatkan id_mahasiswa dari session
        $id_mahasiswa = $this->session->userdata('id_mahasiswa');
        $komunitas_chats = $this->Komunitas_model->get_seminar_by_mahasiswa($id_mahasiswa);
        // Pastikan id_mahasiswa ada dalam session
      
        $data['komunitas_chats'] = $komunitas_chats;

        // Memuat view dan mengirimkan data komunitas_chats ke view
        $this->load->view('template/user/header', $data);
        $this->load->view('template/user/navbar', $data);
        $this->load->view('user/komunitas', $data);
        $this->load->view('template/user/footer');
        
    }

    public function keluar() {
        if (!$this->session->userdata('user_data')) {
            $response = array('success' => false, 'message' => 'Unauthorized access');
            echo json_encode($response);
            return;
        }
    
        $id_seminar = $this->input->post('id_seminar');
        $id_mahasiswa = $this->input->post('id_mahasiswa');
    
        // Validasi input
        if (!$id_seminar || !$id_mahasiswa) {
            $response = array('success' => false, 'message' => 'Invalid input');
            echo json_encode($response);
            return;
        }
    
        // Hapus data dari tabel komunitas
        $this->db->where('id_seminar', $id_seminar);
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $result = $this->db->delete('komunitas');
    
        if ($result) {
            $response = array('success' => true, 'message' => 'Berhasil keluar dari grup');
        } else {
            $response = array('success' => false, 'message' => 'Gagal keluar dari grup');
        }
    
        echo json_encode($response);
    }


    
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
        $jumlah_komunitas = $this->User_model->getJumlahKomunitas($id_mahasiswa);
    
        // Ambil data history seminar termasuk tanggal pelaksanaan
        $history_seminar = $this->Sertifikat_model->get_by_mahasiswa_id($id_mahasiswa);
    
        // Kirim data ke view
        $data = array(
            'history_seminar' => $history_seminar,
            'jumlah_seminar' => $jumlah_seminar,
            'jumlah_belum_bayar' => $jumlah_belum_bayar,
            'jumlah_history' => $jumlah_history,
            'jumlah_komunitas' => $jumlah_komunitas,
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
    $jumlah_komunitas = $this->User_model->getJumlahKomunitas($id_mahasiswa);
    $file_data = $this->File_model->get_by_mahasiswa_id($id_mahasiswa);

    

    // Kirim data ke view
    $data = array(
        'jumlah_seminar' => $jumlah_seminar,
        'jumlah_belum_bayar' => $jumlah_belum_bayar,
        'jumlah_history' => $jumlah_history,
        'jumlah_komunitas' => $jumlah_komunitas,
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