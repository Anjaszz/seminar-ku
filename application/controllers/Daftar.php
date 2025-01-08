<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('daftar_model');
        $this->load->model('Vendor_model', 'vnd');
        require_once APPPATH . 'third_party/Midtrans/Midtrans.php';
        \Midtrans\Config::$serverKey = 'SB-Mid-server-ay9QYxNzmuxRlfXu4ntFRNd8'; // Ganti dengan server key Anda
        \Midtrans\Config::$isProduction = false; // Set true jika di production
    }

    public function user() {
        $data['fakultas'] = $this->daftar_model->getFakultas();
        $data['jenjang'] = $this->daftar_model->getJenjang();
        $this->load->view('user/daftar', $data);
    }

    public function simpan() {
        // Set validasi
        $this->form_validation->set_rules('nama_mhs', 'Nama', 'required|callback_alpha_space', [
            'required' => 'Nama mahasiswa wajib diisi!',
            'alpha_space' => 'Inputan nama tidak valid'
        ]);
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[mahasiswa.email]', [
            'required' => 'Email wajib diisi!',
            'valid_email' => 'Format email tidak valid!',
            'is_unique' => 'Email sudah digunakan!'
        ]);
        $this->form_validation->set_rules('no_telp', 'No. Telpon', 'required|numeric', [
            'required' => 'Nomor telepon wajib diisi!',
            'numeric' => 'Nomor telepon hanya boleh berupa angka!'
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required', [
            'required' => 'Tanggal lahir wajib diisi!'
        ]);
        $this->form_validation->set_rules('id_fakultas', 'Fakultas', 'required', [
            'required' => 'Fakultas wajib dipilih!'
        ]);
        $this->form_validation->set_rules('id_prodi', 'Prodi', 'required', [
            'required' => 'Program studi wajib dipilih!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]', [
            'required' => 'Password wajib diisi!',
            'min_length' => 'Password minimal 6 karakter!'
        ]);
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]', [
            'required' => 'Konfirmasi password wajib diisi!',
            'matches' => 'Password dan konfirmasi password tidak cocok!'
        ]);
    
        // Jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            // Ambil error dari form_validation
            $errors = validation_errors();
            
            // Mengirimkan error melalui response JSON
            $response = [
                'status' => 'error',
                'message' => $errors
            ];
        } else {
            // Jika validasi berhasil
            $dataMahasiswa = [
                'nim' => $this->generate_nim(), // Menghasilkan NIM
                'nama_mhs' => strip_tags($this->input->post('nama_mhs')), // Hapus tag HTML
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'id_fakultas' => $this->input->post('id_fakultas'),
                'id_prodi' => $this->input->post('id_prodi')
            ];
    
            // Menyimpan data mahasiswa
            $insertMahasiswa = $this->daftar_model->simpanMahasiswa($dataMahasiswa);
    
            if ($insertMahasiswa) {
                // Menyimpan data ke user_mhs
                $dataUserMhs = [
                    'id_mahasiswa' => $insertMahasiswa, // ID dari tabel mahasiswa yang baru saja dimasukkan
                    'nim' => $dataMahasiswa['nim'], // Menggunakan NIM yang dihasilkan
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('password')), // Hash MD5 dari password yang diinput
                    'id_reset' => 0
                ];
    
                // Menyimpan data ke tabel user_mhs
                $insertUserMhs = $this->daftar_model->simpanUserMhs($dataUserMhs);
    
                // Jika penyimpanan ke kedua tabel berhasil
                if ($insertUserMhs) {
                    $response = [
                        'status' => 'success',
                        'message' => 'Pendaftaran berhasil!'
                    ];
                } else {
                    $response = [
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan saat menyimpan data ke tabel user_mhs.'
                    ];
                }
            } else {
                $response = [
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat menyimpan data mahasiswa.'
                ];
            }
        }
    
        // Kirim response JSON
        echo json_encode($response);
    }

    // Fungsi untuk menghasilkan NIM
    private function generate_nim() {
        $year = date('y'); // Tahun dua digit
        $month = date('m'); // Bulan dua digit
        $count = $this->daftar_model->get_last_nim_count($year, $month); // Ambil angka urut berdasarkan tahun dan bulan
        $new_nim = $year . $month . str_pad($count + 1, 3, '0', STR_PAD_LEFT); // Format NIM
        return $new_nim;
    }

    // Custom validation function untuk nama
    public function alpha_space($str) {
        if (preg_match('/^[a-zA-Z ]+$/', $str)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('alpha_space', 'Nama hanya boleh berisi huruf dan spasi.');
            return FALSE;
        }
    }

    
    public function get_prodi_by_fakultas() {
        $id_fakultas = $this->input->post('id_fakultas');
        $prodi = $this->daftar_model->get_prodi_by_fakultas($id_fakultas);
        echo json_encode($prodi);
    }

    public function vendor()
{
    // Aturan validasi
    $this->form_validation->set_rules('nama_vendor', 'Nama Vendor', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|numeric');
    $this->form_validation->set_rules('id_bank', 'Nama Bank', 'required');
    $this->form_validation->set_rules('no_rekening', 'Nomor Rekening', 'required|numeric');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
    $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
    $this->form_validation->set_rules('lama_berlangganan', 'Lama Berlangganan', 'required');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal
        $data = [
            'title' => 'Tambah Data Vendor',
            'parent' => 'Data Vendor',
            'banks' => $this->vnd->get_all_banks() // Ambil data bank
        ];
        $this->load->view('master/vendor/daftar', $data);
    } else {
        // Jika validasi berhasil, siapkan data untuk vendor
        $vendor_data = [
            'nama_vendor' => $this->input->post('nama_vendor'),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'id_bank' => $this->input->post('id_bank'),
            'no_rekening' => $this->input->post('no_rekening'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'tgl_subs' => date('Y-m-d'),
            'active' => 0 // Status default: tidak aktif
        ];

        // Ambil lama berlangganan dan tentukan harga
        $lama_berlangganan = $this->input->post('lama_berlangganan');
        $harga = 0;

        switch ($lama_berlangganan) {
            case '3':
                $harga = 50000;
                $vendor_data['tgl_berakhir'] = date('Y-m-d', strtotime('+3 months'));
                break;
            case '6':
                $harga = 70000;
                $vendor_data['tgl_berakhir'] = date('Y-m-d', strtotime('+6 months'));
                break;
            case '12':
                $harga = 100000;
                $vendor_data['tgl_berakhir'] = date('Y-m-d', strtotime('+1 year'));
                break;
        }

        // Simpan data vendor ke session untuk digunakan setelah pembayaran
        $this->session->set_userdata('vendor_data', $vendor_data);
        $this->session->set_userdata('harga', $harga); // Simpan harga ke session

        // Buat transaksi
        $transaction_details = [
            'order_id' => uniqid(), // ID unik untuk transaksi
            'gross_amount' => $harga, // Jumlah yang harus dibayar
        ];

        $item_details = [
            [
                'id' => 'item1',
                'price' => $harga,
                'quantity' => 1,
                'name' => 'Pendaftaran Vendor'
            ]
        ];

        $customer_details = [
            'first_name' => $this->input->post('nama_vendor'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('no_telp'),
        ];

        $transaction_data = [
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
        ];

        // Dapatkan URL pembayaran
        $snapToken = \Midtrans\Snap::getSnapToken($transaction_data);
        $data['snap_token'] = $snapToken;

        // Tampilkan halaman pembayaran
        $this->load->view('master/vendor/payment', $data);
    }
}

public function handle_payment()
{
    $result = json_decode(file_get_contents('php://input'), true);

    // Cek status pembayaran
    if ($result['transaction_status'] == 'settlement') {
        // Ambil data vendor dari session
        $vendor_data = $this->session->userdata('vendor_data');

        // Simpan data vendor ke database
        $vendor_id = $this->vnd->insert_data($vendor_data);

        // Ambil harga dari session
        $harga = $this->session->userdata('harga');

        // Simpan data transaksi
        $transaction_data = [
            'id_transaksi' => $result['order_id'],
            'id_vendor' => $vendor_id, // Gunakan id_vendor dari session
            'tgl_transaksi' => date('Y-m-d H:i:s', strtotime($result['transaction_time'])),
            'jumlah_masuk' => $harga // Gunakan harga berlangganan
        ];

        $this->db->insert('transaksi_master', $transaction_data); // Ganti 'transaksi_master' dengan nama tabel Anda

        // Hapus data vendor dari session
        $this->session->unset_userdata('vendor_data');
        $this->session->unset_userdata('harga'); // Hapus harga dari session

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

public function success()
{
    $this->load->view('auth/login'); // Buat view success.php
}
}
