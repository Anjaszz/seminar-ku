<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EmailController extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->model('Genqr_model');
        $this->load->model('Mahasiswa_model', 'mhs');
    }

    public function index() {
        $this->load->view('image_view'); 
    }

    public function send_image_emails() {
        $mahasiswa_list = $this->Genqr_model->get_all_mahasiswa()->result();

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'pikanni658@gmail.com';
        $config['smtp_pass'] = 'nczfhawxedbuwlzd';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        foreach ($mahasiswa_list as $mahasiswa) {
            $this->generate_and_send_email($mahasiswa);
        }

        echo "Emails sent successfully.";
    }

    private function generate_and_send_email($mahasiswa) {
        $nim = $mahasiswa->nim;
        $email = $mahasiswa->email;

        if (empty($email)) {
            echo "Email not found for NIM: $nim.<br>";
            return;
        }

        $file_path = './uploads/' . $nim . '.png';

        $this->email->from('admin@simas.com', 'SIMAS');
        $this->email->to($email);
        $this->email->subject('E-Tiket Seminar');

        $message = '
        <p>Kepada Mahasiswa/i</p></p>
        <p>Berikut kami kirimkan E-Tiket kegiatan seminar:</p></p>
        <p><a href="' . base_url('uploads/' . $nim . '.png') . '"></a></p>
        ';
        $this->email->message($message);

        $this->email->attach($file_path);
        if ($this->email->send()) {
            echo 'Email berhasil dikirim.';
        } else {
            echo 'Email gagal dikirim.';
        }

        $this->email->clear(TRUE);
    }

    public function send_image_email($id_mahasiswa) {
        $student_email = $this->Genqr_model->get_student_email_by_id($id_mahasiswa);
        $nim = $this->Genqr_model->get_student_nim_by_id($id_mahasiswa);

        if (empty($nim)) {
            echo 'NIM tidak ditemukan.';
            return;
        }

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'pikanni658@gmail.com';
        $config['smtp_pass'] = 'nczfhawxedbuwlzd';
        $config['mailtype'] = 'html';
        $this->email->initialize($config);

        $to_email = $student_email;
        $this->email->from('admin@simas.com', 'SIMAS');
        $this->email->to($to_email);
        $this->email->subject('E-Tiket Seminar');

        $message = '
            <p>Kepada Mahasiswa/i</p></p>
            <p>Berikut kami kirimkan E-Tiket kegiatan seminar:</p></p>
            <p><a href="' . base_url('uploads/' . $nim . '.png') . '"></a></p>
        ';
        $this->email->message($message);

        $file_path = './uploads/' . $nim . '.png';
        $this->email->attach($file_path);

        if ($this->email->send()) {
            echo 'Email berhasil dikirim.';
        } else {
            echo 'Email gagal dikirim.';
        }
    }

    public function save_image() {
        $nim = $this->input->post('nim');
        
        if (empty($nim)) {
            echo 'NIM tidak ditemukan.';
            return;
        }
    
        $image_data = $this->input->post('image');
        
        if (empty($image_data)) {
            echo 'Data gambar tidak ditemukan.';
            return;
        }
        
        // Mengolah data base64
        $image_data = str_replace('data:image/png;base64,', '', $image_data);
        $image_data = str_replace(' ', '+', $image_data);
        $decoded_image = base64_decode($image_data);
    
        // Pastikan data gambar berhasil didecode
        if (!$decoded_image) {
            echo 'Gagal decode data gambar.';
            return;
        }
    
        // Tentukan path untuk menyimpan gambar
        $image_path = './uploads/' . $nim . '.png';
    
        // Debug untuk memastikan path benar
        echo "Path penyimpanan: " . $image_path . "<br>";
    
        // Simpan gambar
        if (file_put_contents($image_path, $decoded_image)) {
            echo 'Gambar berhasil disimpan.';
        } else {
            echo 'Gagal menyimpan gambar.';
        }
    }
    

    public function save_all_image() {
        $image_data = $this->input->post('image');
        $nim = $this->input->post('nim');

        $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image_data));
        $file_path = 'uploads/qr_image/' . $nim . 'code.png';

        file_put_contents($file_path, $image);

        $data = array(
            'nim' => $nim,
            'image_path' => $file_path
        );
        $this->Genqr_model->save_image($data);

        echo 'Image saved successfully.';
    }
}
?>
