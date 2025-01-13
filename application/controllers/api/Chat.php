<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller {
    
    private $api_key = 'AIzaSyDzlzf9di9yJzpS9SW74Ga0qmSNJF1Aye0'; // Ganti dengan API key Anda
    
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header('Access-Control-Allow-Headers: Content-Type');
    }

    public function index() {
        $input = json_decode(file_get_contents('php://input'), true);
        $message = isset($input['message']) ? $input['message'] : '';

        if (empty($message)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'No message provided'
                ]));
            return;
        }

        try {
            $response = $this->getGeminiResponse($message);
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success',
                    'response' => $response
                ]));
        } catch (Exception $e) {
            log_message('error', 'Gemini API Error: ' . $e->getMessage());
            
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Failed to get response from AI'
                ]));
        }
    }

    private function getGeminiResponse($message) {
        // Endpoint Gemini API
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . $this->api_key;
        
        // Data yang akan dikirim ke Gemini
        $data = [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $message
                        ]
                    ]
                ]
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'topK' => 40,
                'topP' => 0.95,
                'maxOutputTokens' => 1024,
            ]
        ];

        // Inisialisasi cURL
        $ch = curl_init($url);
        
        // Set opsi cURL
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json'
            ],
            CURLOPT_SSL_VERIFYPEER => false // Hanya untuk development/testing
        ]);

        // Eksekusi request
        $response = curl_exec($ch);
        
        // Cek error cURL
        if (curl_errno($ch)) {
            throw new Exception('Curl error: ' . curl_error($ch));
        }
        
        // Tutup koneksi cURL
        curl_close($ch);
        
        // Decode response
        $responseData = json_decode($response, true);
        
        // Debug log
        log_message('debug', 'Gemini API Response: ' . print_r($responseData, true));
        
        // Cek dan ambil teks response
        if (isset($responseData['candidates'][0]['content']['parts'][0]['text'])) {
            return $responseData['candidates'][0]['content']['parts'][0]['text'];
        } else {
            // Jika format response tidak sesuai, cek error
            if (isset($responseData['error'])) {
                throw new Exception($responseData['error']['message'] ?? 'Unknown error from Gemini API');
            }
            throw new Exception('Invalid response format from Gemini API');
        }
    }
}