<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('daftar_model');
    }

    public function index() {
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
}
