<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model untuk autentikasi
        $this->load->model('master_auth_model');
    }

    // Halaman login
    public function index() {
        $this->load->view('master/login');
    }

    // Proses login
    public function login() {
        // Ambil input dari form
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // Cek login
        $result = $this->master_auth_model->cek_login($email, $password);

        if ($result) {
            // Jika berhasil login, simpan session dan redirect ke home
            $this->session->set_userdata('admin_id', $result->id);
            redirect('master/home');
        } else {
            // Jika gagal login, kirimkan pesan error
            $this->session->set_flashdata('error', 'Email atau Password salah.');
            redirect('master/auth');
        }
    }

    // Fungsi untuk logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('master/auth');
    }
}
