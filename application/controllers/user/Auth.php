<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

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
        // Cek apakah form dikirim
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
    
            // Log input untuk debugging
            log_message('debug', 'Email: ' . $email . ', Password: ' . $password);
    
            // Validasi login menggunakan model
            $user = $this->User_model->validate_login($email, $password);
    
            // Log hasil validasi
            log_message('debug', 'User: ' . json_encode($user));
    
            if ($user) {
                // Set session data
                $this->session->set_userdata('user_data', $user);
                $this->session->set_userdata('id_mahasiswa', $user->id_mahasiswa);
                $this->session->set_userdata('nim', $user->nim);
                $this->session->set_userdata('email', $email); 
    
                    // Arahkan ke home jika id_reset sudah 1
                redirect('user/home');
                
            } else {
                // Set flashdata untuk error
                $this->session->set_flashdata('login_error', 'Email atau Password salah. Silahkan coba lagi.');
                redirect('user/auth');
            }
        } else {
            // Load login view
            $this->load->view('user/login');
        }
    }
    
    public function logout() {
        // Hapus semua session
        $this->session->unset_userdata('user_data');
        $this->session->sess_destroy();
    
        // Alihkan ke halaman login atau halaman lain
        redirect('user/auth');
    }
    

    public function ubah_password() {
        // Cek apakah user sudah login dan memiliki id_mahasiswa di session
        if (!$this->session->userdata('id_mahasiswa')) {
            // Jika belum login atau tidak ada id_mahasiswa, redirect ke halaman login
            $this->session->set_flashdata('login_error', 'Anda harus login terlebih dahulu!');
            redirect('user/auth');
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

    public function forgot_password() {
        $this->load->view('user/forgot_password');
    }

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
    
            $reset_link = 'https://simaseminar.web.id/user/auth/reset_password/' . urlencode($reset_token) . '?email=' . urlencode($email);
    
            // Kirim email dengan link reset password
            $this->load->library('email');
            $this->email->from('admin@simaseminar.web.id', 'Admin SIMAS');
            $this->email->to($email);
            $this->email->subject('Reset Password Akun SIMAS Anda');
            $this->email->message('Klik link berikut untuk mereset password Anda: <a href="'.$reset_link.'">Reset Password</a>');
    
            // Kirim email
            if ($this->email->send()) {
                $this->session->set_flashdata('email_sent', 'Link reset password telah dikirim ke email Anda.');
            } else {
                $this->session->set_flashdata('email_error', 'Gagal mengirim email. Silakan coba lagi.');
            }
    
            redirect('user/auth/forgot_password');
        } else {
            $this->session->set_flashdata('email_error', 'Email tidak ditemukan.');
            redirect('user/auth/forgot_password');
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
            
            redirect('user/auth/forgot_password');
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
            redirect('user/auth');
        } else {
            $this->session->set_flashdata('password_error', 'Gagal mengubah password. Email tidak valid.');
            redirect('user/auth/reset_password/' . md5($email) . '?email=' . urlencode($email));
        }
    }
}