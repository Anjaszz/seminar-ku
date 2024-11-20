<?php
class ModelPayment extends CI_Model {

    public function getPaymentDataBySeminar($id_seminar, $id_mahasiswa) {
        // Mengambil data berdasarkan id_seminar dan id_mahasiswa
        $this->db->select('pendaftaran_seminar.id_pendaftaran, 
                           pendaftaran_seminar.id_seminar, 
                           tiket.harga_tiket, 
                           mahasiswa.nama_mhs, 
                           mahasiswa.email, 
                           mahasiswa.no_telp');
        $this->db->from('pendaftaran_seminar');
        $this->db->join('tiket', 'pendaftaran_seminar.id_seminar = tiket.id_seminar', 'left');
        $this->db->join('mahasiswa', 'pendaftaran_seminar.id_mahasiswa = mahasiswa.id_mahasiswa', 'left');
        $this->db->where('pendaftaran_seminar.id_seminar', $id_seminar);
        $this->db->where('mahasiswa.id_mahasiswa', $id_mahasiswa); // Menambahkan kondisi id_mahasiswa
        return $this->db->get()->row();
    }

    public function updatePaymentStatus($id_pendaftaran, $status) {
        // Update status pembayaran di pendaftaran_seminar
        $this->db->where('id_pendaftaran', $id_pendaftaran);
        
        if ($this->db->update('pendaftaran_seminar', array('id_stsbyr' => $status))) {
            log_message('debug', 'Update successful for id_pendaftaran: ' . $id_pendaftaran);
    
            // Ambil id_seminar berdasarkan id_pendaftaran
            $this->db->select('id_seminar');
            $this->db->where('id_pendaftaran', $id_pendaftaran);
            $seminar_data = $this->db->get('pendaftaran_seminar')->row();
    
            if ($seminar_data) {
                $id_seminar = $seminar_data->id_seminar;
    
                // Tambahkan 1 ke kolom tiket_terjual di tabel tiket berdasarkan id_seminar
                $this->db->set('tiket_terjual', 'tiket_terjual + 1', FALSE);
                $this->db->where('id_seminar', $id_seminar);
                if ($this->db->update('tiket')) {
                    log_message('debug', 'Tiket terjual berhasil ditambahkan untuk id_seminar: ' . $id_seminar);
                } else {
                    log_message('error', 'Gagal menambah tiket terjual untuk id_seminar: ' . $id_seminar);
                }
            } else {
                log_message('error', 'id_seminar tidak ditemukan untuk id_pendaftaran: ' . $id_pendaftaran);
            }
    
            return true;
        } else {
            log_message('error', 'Update failed for id_pendaftaran: ' . $id_pendaftaran);
            return false;
        }
    }

}
