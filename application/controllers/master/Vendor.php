<?php

defined('BASEPATH') or exit('No direct script access allowed');


class vendor extends CI_Controller
{
   
    public function __construct()
    {
        parent::__construct();
        // Cek apakah user sudah login, jika belum arahkan ke login
        if (!$this->session->userdata('admin_id')) {
            redirect('master/auth');
        }
        // Load model untuk mengambil data total
        $this->load->model('Home_model'); // Pastikan model sudah diload
        
        $this->load->model('Vendor_model', 'vnd');
    }

    public function index()
    {
        $attradd = array('class' => 'btn  btn-gradient-success');
       
        $tambahdata = anchor('master/vendor/add', '<i class="feather icon-user-plus"></i>Tambah Data', $attradd);
       
        $vnd = $this->vnd->lihat_data();
       
        $data = array(
            'vendor' =>  $vnd,
            'title' => 'Data Vendor Seminar',
            'btntambah' => $tambahdata,
        );
        $this->template->load('master/template/template_v', 'master/vendor/vendor_v', $data);
    }

    


    public function add()
{
    // Aturan validasi
    $this->form_validation->set_rules('nama_vendor', 'Nama Vendor', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|numeric');
    $this->form_validation->set_rules('id_bank', 'Nama Bank', 'required');
    $this->form_validation->set_rules('no_rekening', 'Nomor Rekening', 'required|numeric');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal
        $data = [
            'title' => 'Tambah Data Vendor',
            'parent' => 'Data Vendor',
            'banks' => $this->vnd->get_all_banks() // Ambil data bank
        ];
        $this->template->load('master/template/template_v', 'master/vendor/vendor_add', $data);
    } else {
        // Jika validasi berhasil
        // Hash password 'Admin123' menggunakan md5
        $hashed_password = md5('Admin123'); // Menggunakan password yang sudah ditentukan

        $data = [
            'nama_vendor' => $this->input->post('nama_vendor'),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'id_bank' => $this->input->post('id_bank'),
            'no_rekening' => $this->input->post('no_rekening'),
            'password' => $hashed_password, // Simpan password yang di-hash
            'tgl_subs' => date('Y-m-d'),
            'tgl_berakhir' => date('Y-m-d', strtotime('+1 year')),
            'active' => 0 // Status default: tidak aktif
        ];

        // Simpan data ke database
        if ($this->vnd->insert_data($data)) {
            $this->session->set_flashdata('success', 'Data vendor berhasil ditambahkan!');
            redirect('master/vendor');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data vendor!');
            redirect('master/vendor/add');
        }
    }
}

public function daftar()
{
    // Aturan validasi
    $this->form_validation->set_rules('nama_vendor', 'Nama Vendor', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|numeric');
    $this->form_validation->set_rules('id_bank', 'Nama Bank', 'required');
    $this->form_validation->set_rules('no_rekening', 'Nomor Rekening', 'required|numeric');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, tampilkan form pendaftaran
        $data['title'] = 'Tambah Data Vendor';
        $data['parent'] = 'Data Vendor';
        $data['banks'] = $this->vnd->get_all_banks(); // Ambil data bank

        // Memuat view tanpa template
        $this->load->view('master/vendor/daftar', $data);
    } else {
        // Jika validasi berhasil
        // Generate id_vendor
        $month_year = date('my');
        $last_id = $this->vnd->get_last_vendor_id();
        $new_id = $month_year . str_pad($last_id + 1, 4, '0', STR_PAD_LEFT);

        // Hash password menggunakan md5
        $hashed_password = md5($this->input->post('password'));

        $data = [
            'id_vendor' => $new_id,
            'nama_vendor' => $this->input->post('nama_vendor'),
            'email' => $this->input->post('email'),
            'no_telp' => $this->input->post('no_telp'),
            'id_bank' => $this->input->post('id_bank'),
            'no_rekening' => $this->input->post('no_rekening'),
            'password' => $hashed_password,
            'tgl_subs' => date('Y-m-d'),
            'tgl_berakhir' => date('Y-m-d', strtotime('+1 year')),
            'active' => 0 // Status default: tidak aktif
        ];

        // Simpan data ke database
        if ($this->vnd->insert_data($data)) {
            $this->session->set_flashdata('success', 'Data vendor berhasil ditambahkan!');
            redirect('master/vendor/daftar');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data vendor!');
            redirect('master/vendor/daftar');
        }
    }
}



    

    public function detail($id_vendor)
    {
        // Debugging: Log ID vendor yang diterima
        log_message('debug', 'ID Vendor yang diterima: ' . $id_vendor);
    
        // Ambil data vendor dari model berdasarkan ID vendor
        $get_row = $this->vnd->get_vendor_details($id_vendor);
    
        // Debugging: Periksa hasil query
        if ($get_row && $get_row->num_rows() > 0) {
            $row = $get_row->row();
    
            // Ambil data dari hasil query
            $id_vendor = $row->id_vendor;
            $nama_vendor = $row->nama_vendor;
            $tgl_subs = $row->tgl_subs;
            $tgl_berakhir = $row->tgl_berakhir;
            $status = $row->active;
    
            $email = $row->email;
            $no_telp = $row->no_telp;
            $nama_bank = $row->nama_bank;
            $no_rekening = $row->no_rekening;
    
            // Debugging: Log data vendor yang ditemukan
            log_message('debug', 'Data Vendor Ditemukan: ' . json_encode($row));
    
            // Siapkan data untuk ditampilkan di view
            $data = array(
                'title' => 'Detail Vendor Seminar',
                'parent' => 'Data Vendor',
                'id_vendor' => $id_vendor,
                'nama_vendor' => $nama_vendor,
                'status' => $status,
                'email' => $email,
                'no_telp' => $no_telp,
                'tanggal_langganan' => $tgl_subs,
                'tanggal_berakhir' => $tgl_berakhir,
                'nama_bank' => $nama_bank,
                'no_rekening' => $no_rekening, // Tambahkan ini
            );
    
            // Tampilkan data ke view
            $this->template->load('master/template/template_v', 'master/vendor/vendor_d', $data);
        } else {
            // Debugging: Log pesan jika data tidak ditemukan
            log_message('error', 'Data Vendor Tidak Ditemukan untuk ID: ' . $id_vendor);
    
            // Tampilkan pesan jika data tidak ditemukan
            $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
            redirect('master/vendor');
        }
    }
    
    public function update($id_vendor)
    {
        // Pastikan ID vendor valid
        $get_row = $this->vnd->get_row($id_vendor);
        if ($get_row && $get_row->num_rows() > 0) {
            $row = $get_row->row();
    
            // Ambil data vendor dari hasil query
            $data = array(
                'title' => 'Edit Data Vendor',
                'parent' => 'Data Vendor',
                'id_vendor' => $row->id_vendor,
                'nama_vendor' => $row->nama_vendor,
                'tanggal_langganan' => $row->tgl_subs,
                'tanggal_berakhir' => $row->tgl_berakhir,
                'email' => $row->email,
                'no_telp' => $row->no_telp,
                'id_bank' => $row->id_bank,  // ID bank yang dipilih saat ini
                'no_rekening' => isset($row->no_rekening) ? $row->no_rekening : '',  // Pastikan no_rekening ada
                'banks' => $this->vnd->get_all_banks(), // Ambil data bank untuk dropdown
            );
    
            // Jika form disubmit
            if ($this->input->post()) {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('nama_vendor', 'Nama Vendor', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('no_telp', 'No Telepon', 'required|numeric');
                $this->form_validation->set_rules('id_bank', 'Nama Bank', 'required');  // Validasi bank
                $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required|numeric');  // Validasi no rekening
    
                if ($this->form_validation->run() == TRUE) {
                    // Ambil data dari input form
                    $update_data = array(
                        'nama_vendor' => $this->input->post('nama_vendor'),
                        'tgl_subs' => $this->input->post('tanggal_langganan'),
                        'tgl_berakhir' => $this->input->post('tanggal_berakhir'),
                        'email' => $this->input->post('email'),
                        'no_telp' => $this->input->post('no_telp'),
                        'id_bank' => $this->input->post('id_bank'),  // Update id_bank
                        'no_rekening' => $this->input->post('no_rekening'),  // Update no rekening
                    );
    
                    // Update data melalui model
                    if ($this->vnd->update_data($id_vendor, $update_data)) {
                        $this->session->set_flashdata('success', 'Data vendor berhasil diperbarui!');
                        redirect('master/vendor');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal memperbarui data vendor!');
                    }
                }
            }
    
            // Tampilkan form edit
            $this->template->load('master/template/template_v', 'master/vendor/vendor_edit', $data);
        } else {
            $this->session->set_flashdata('error', 'Data vendor tidak ditemukan!');
            redirect('master/vendor');
        }
    }
    
public function vendor_aktif()
{


    // Ambil data vendor yang aktif
    $vnd = $this->vnd->get_active_vendors();

    $data = array(
        'vendor' => $vnd,
        'title' => 'Data Vendor Aktif/Langganan',
    );

    $this->template->load('master/template/template_v', 'master/vendor/vendor_aktif', $data);
}

public function vendor_nonaktif()
{


    $vnd = $this->vnd->get_nonaktif_vendor();

    $data = array(
        'vendor' => $vnd,
        'title' => 'Data Vendor Tidak Aktif/Tidak Langganan',
    );

    $this->template->load('master/template/template_v', 'master/vendor/vendor_nonaktif', $data);
}

public function nonaktifkan($id_vendor)
{
    // Pastikan data vendor ada
    $get_row = $this->vnd->get_row($id_vendor);

    if ($get_row && $get_row->num_rows() > 0) {
        // Update kolom 'active' menjadi 0
        $update_data = ['active' => 0];
        if ($this->vnd->update_data($id_vendor, $update_data)) {
            $this->session->set_flashdata('success', 'Akun berhasil dinonaktifkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menonaktifkan vendor.');
        }
    } else {
        $this->session->set_flashdata('error', 'Data vendor tidak ditemukan.');
    }

    // Redirect kembali ke halaman vendor
    redirect('master/vendor/vendor_aktif');
}

public function aktifkan($id_vendor)
{
    // Pastikan data vendor ada
    $get_row = $this->vnd->get_row($id_vendor);

    if ($get_row && $get_row->num_rows() > 0) {
        // Update kolom 'active' menjadi 0
        $update_data = ['active' => 1];
        if ($this->vnd->update_data($id_vendor, $update_data)) {
            $this->session->set_flashdata('success', 'Akun berhasil diaktifkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menonaktifkan vendor.');
        }
    } else {
        $this->session->set_flashdata('error', 'Data vendor tidak ditemukan.');
    }

    // Redirect kembali ke halaman vendor
    redirect('master/vendor/vendor_nonaktif');
}






    
   
 
}


/* End of file vendor.php */
/* Location: ./application/controllers/vendor.php */
