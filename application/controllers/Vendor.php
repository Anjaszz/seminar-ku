<?php

defined('BASEPATH') or exit('No direct script access allowed');


class vendor extends MY_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Vendor_model', 'vnd');
    }

    public function register() {
        if ($this->input->method() === 'post') {
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
    
            // Validasi Password dan Konfirmasi Password
            if ($password !== $confirm_password) {
                $this->session->set_flashdata('error', 'Password dan konfirmasi password tidak cocok!');
                redirect('vendor/register');
            }
    
            // Hash Password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
            $data = [
                'nama_vendor' => $this->input->post('nama_vendor'),
                'email' => $this->input->post('email'),
                'no_telp' => $this->input->post('no_telp'),
                'id_bank' => $this->input->post('id_bank'),
                'no_rekening' => $this->input->post('no_rekening'),
                'password' => $hashed_password, // Simpan password yang telah di-hash
                'tgl_subs' => date('Y-m-d'),
                'tgl_berakhir' => date('Y-m-d', strtotime('+1 year')),
                'active' => 0
            ];
    
            $this->vnd->insert_data($data);
            $this->session->set_flashdata('success', 'Pendaftaran berhasil! Silakan login dengan akun Anda.');
            redirect('vendor/register'); // Arahkan ke halaman login vendor
        }
    
        $data['banks'] = $this->vnd->get_all_banks();
        $this->load->view('vendor/daftar_vendor', $data);
    }
    
}