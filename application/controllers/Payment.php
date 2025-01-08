<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Include Midtrans PHP Library
require_once APPPATH . 'third_party/Midtrans/Midtrans.php';

class Payment extends MY_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_vendor')) {
            redirect('auth'); // Redirect ke halaman login
        } 
        $this->load->model('ModelPayment');
        \Midtrans\Config::$serverKey = 'SB-Mid-server-ay9QYxNzmuxRlfXu4ntFRNd8';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    public function bayar($id_seminar) {
        $logged_in_user_id = $this->session->userdata('id_mahasiswa'); // Ambil id_mahasiswa dari session
        
        // Ambil data berdasarkan id_seminar dan user yang login
        $paymentData = $this->ModelPayment->getPaymentDataBySeminar($id_seminar, $logged_in_user_id);
    
        if ($paymentData) {
            $full_name = explode(' ', $paymentData->nama_mhs, 2);
            $first_name = $full_name[0];
            $last_name = isset($full_name[1]) ? $full_name[1] : '';
            $order_id = 'order_' . time() . '_' . $paymentData->id_pendaftaran; 
    
            $params = array(
                'transaction_details' => array(
                    'order_id' => $order_id,
                    'gross_amount' => $paymentData->harga_tiket,
                ),
                'customer_details' => array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $paymentData->email,
                    'phone' => $paymentData->no_telp,
                ),
            );
    
            $snapToken = \Midtrans\Snap::getSnapToken($params);
    
            $data['snap_token'] = $snapToken;
            $data['id_seminar'] = $id_seminar;
            $data['id_pendaftaran'] = $paymentData->id_pendaftaran;
            $this->load->view('template/user/header', $data);
            $this->load->view('payment_view', $data);
            $this->load->view('template/user/footer', $data);

        } else {
            show_404();
        }
    }

    public function confirm_payment() {
        $input = json_decode(file_get_contents('php://input'), true);
        
        log_message('debug', 'Input: ' . json_encode($input));
        
        $id_pendaftaran = $input['id_pendaftaran'];
        $status = $input['status'];
        
        if ($this->ModelPayment->updatePaymentStatus($id_pendaftaran, $status)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
