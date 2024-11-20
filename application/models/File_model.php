<?php


defined('BASEPATH') or exit('No direct script access allowed');

class File_model extends CI_Model
{
   
public function update_file($id_seminar, $file)
    {
        // Data yang akan diupdate
        $data = array(
            'file' => $file
        );

        // Update data file berdasarkan id_seminar
        $this->db->where('id_seminar', $id_seminar);
        return $this->db->update('seminar', $data);
    }

    public function get_all_seminar()
    {
        return $this->db->get('history_seminar')->result();
    }

    public function hapus_file($id_seminar)
{
    $this->db->where('id_seminar', $id_seminar);
    return $this->db->update('seminar', ['file' => NULL]); // Set file menjadi NULL
}

public function get_by_id($id_seminar)
{
    return $this->db->get_where('seminar', ['id_seminar' => $id_seminar])->row();
}


public function get_by_mahasiswa_id($id_mahasiswa)
{
    $this->db->select('history_seminar.*, seminar.file');
    $this->db->from('history_seminar');
    $this->db->join('seminar', 'seminar.id_seminar = history_seminar.id_seminar', 'left');
    $this->db->where('history_seminar.id_mahasiswa', $id_mahasiswa);
    $query = $this->db->get();
    return $query->result();
}

    // Fungsi untuk mendapatkan nama mahasiswa berdasarkan id_mahasiswa
    public function getMahasiswaNameById($id_mahasiswa)
    {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        return $this->db->get('history_seminar')->row();
    }


}
