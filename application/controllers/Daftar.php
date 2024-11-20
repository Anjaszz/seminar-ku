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
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric|is_unique[mahasiswa.nim]', [
            'required' => 'NIM wajib diisi!',
            'numeric' => 'NIM tidak valid',
            'is_unique' => 'NIM sudah digunakan!'
        ]);
        
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
        $this->form_validation->set_rules('id_jenjang', 'Jenjang', 'required', [
            'required' => 'Jenjang wajib dipilih!'
        ]);
        $this->form_validation->set_rules('id_prodi', 'Prodi', 'required', [
            'required' => 'Program studi wajib dipilih!'
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
                'nim' => $this->input->post('nim'),
                'nama_mhs' => strip_tags($this->input->post('nama_mhs')), // Hapus tag HTML
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'id_fakultas' => $this->input->post('id_fakultas'),
                'id_jenjang' => $this->input->post('id_jenjang'),
                'id_prodi' => $this->input->post('id_prodi')
            ];
    
            // Menyimpan data mahasiswa
            $insertMahasiswa = $this->daftar_model->simpanMahasiswa($dataMahasiswa);
    
            if ($insertMahasiswa) {
                // Menyimpan data ke user_mhs
                $dataUserMhs = [
                    'id_mahasiswa' => $insertMahasiswa, // ID dari tabel mahasiswa yang baru saja dimasukkan
                    'nim' => $this->input->post('nim'),
                    'email' => $this->input->post('email'),
                    'password' => md5($this->input->post('tanggal_lahir')), // Hash MD5 dari tanggal lahir
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
