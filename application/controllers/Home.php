
<?php
defined('BASEPATH') or exit('no direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Vendor_model', 'vnd');
    }

    public function index()
    {
        // Judul halaman
        $title = 'Home';

        // Data navigasi
        $mahasiswa = anchor('mahasiswa', 'Data Mahasiswa');
        $fakultas = anchor('fakultas', 'Data Fakultas');
        $prodi = anchor('prodi', 'Data Prodi');
        $jenjang = anchor('jenjang', 'Data Jenjang');

        // Informasi box
        $box = $this->info_box();

        // Ambil id_vendor dari session
        $id_vendor = $this->session->userdata('id_vendor');

        $monthly_income = $this->home->get_monthly_income_by_vendor($id_vendor);
        
        // Data untuk view
        $data = [
            'mahasiswa' => $mahasiswa,
            'fakultas' => $fakultas,
            'prodi' => $prodi,
            'jenjang' => $jenjang,
            'title' => $title,
            'box' => $box,
            'monthly_income' => $monthly_income
        ];

        // Load template dan view
        $this->template->load('template/template_v', 'home/home_v', $data);
    }

    // ... rest of your Home controller code (info_box method) ...


    public function info_box()
    {
        // Method info_box tetap sama
        $id_vendor = $this->session->userdata('id_vendor');

        $total_mahasiswa = $this->home->total_mahasiswa_by_vendor($id_vendor);
        $total_mhs = !empty($total_mahasiswa) ? count($total_mahasiswa) : 0;

        $total_sponsor = $this->home->total_sponsor_by_vendor($id_vendor);
        $total_sp = !empty($total_sponsor) ? count($total_sponsor) : 0;

        $total_seminar = $this->home->total_seminar_by_vendor($id_vendor);
        $total_sm = !empty($total_seminar) ? count($total_seminar) : 0;

        $total_tiket_terjual = $this->home->total_tiket_by_vendor($id_vendor);
        $total_tr = !empty($total_tiket_terjual) ? $total_tiket_terjual : 0;

        $total_transaksi = $this->home->total_transaksi_by_vendor($id_vendor);
        $total_trx = !empty($total_transaksi) ? $total_transaksi : 0;

        $box = [
            [
                'color' => 'facebook',
                'total' => $total_mhs,
                'title' => 'Total Peserta',
                'icon' => 'users',
                'link' => site_url('pendaftaran'),
            ],
            [
                'color' => 'success',
                'total' => $total_sp,
                'title' => 'Total Sponsor',
                'icon' => 'handshake',
                'link' => site_url('sponsor'),
            ],
            [
                'color' => 'warning',
                'total' => $total_sm,
                'title' => 'Total Seminar',
                'icon' => 'chalkboard-teacher',
                'link' => site_url('seminar'),
            ],
            [
                'color' => 'info',
                'total' => $total_tr,
                'title' => 'Total Tiket Terjual',
                'icon' => 'ticket-alt',
                'link' => site_url('tiket'),
            ],
            [
                'color' => 'primary',
                'total' => $total_trx,
                'title' => 'Total Uang Masuk',
                'icon' => 'money-bill-wave',
                'link' => site_url('laporankeuangan'),
            ],
        ];

        return json_decode(json_encode($box), FALSE);
    }

    public function edit($id_vendor)
    {
        $data['title'] = 'Edit Vendor';
        $data['user'] = $this->vnd->getUserById($id_vendor);
        $data['banks'] = $this->vnd->getAllBanks();

        if (!$data['user']) {
            show_404();
        }

        // Validasi Form
        $this->form_validation->set_rules('nama_vendor', 'Nama Vendor', 'required');
        $this->form_validation->set_rules('no_telp', 'No Telepon', 'required');
        $this->form_validation->set_rules('no_rekening', 'Nomor Rekening', 'required');
        $this->form_validation->set_rules('id_bank', 'Nama Bank', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header', $data);
            $this->load->view('template/navbar', $data);
            $this->load->view('home/edit_data', $data);
        } else {
            $updateData = [
                'nama_vendor' => $this->input->post('nama_vendor'),
                'no_telp' => $this->input->post('no_telp'),
                'no_rekening' => $this->input->post('no_rekening'),
                'id_bank' => $this->input->post('id_bank'),
            ];

            if ($this->vnd->update_data($id_vendor, $updateData)) {
                $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
                redirect('home');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui data.');
                redirect('home/edit/' . $id_vendor);
            }
        }
    }

   
    
}