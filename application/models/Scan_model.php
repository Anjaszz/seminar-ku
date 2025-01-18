<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scan_model extends CI_Model
{
    public function is_student_registered_for_seminar($id_mahasiswa, $id_seminar)
    {
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->where('id_seminar', $id_seminar);
        $query = $this->db->get('pendaftaran_seminar');
        
        return $query->num_rows() > 0;
    }
    public function get_id_scan_status($id_mahasiswa, $id_seminar) {
        $this->db->select('id_scan');
        $this->db->from('pendaftaran_seminar');
        $this->db->where('id_mahasiswa', $id_mahasiswa);
        $this->db->where('id_seminar', $id_seminar);
        $query = $this->db->get();
        $result = $query->row();
        return isset($result->id_scan) ? $result->id_scan : null;
    }
    public function get_id_scan_status_online($id_seminar) {
        $this->db->select('id_scan');
        $this->db->from('seminar');
        $this->db->where('id_seminar', $id_seminar);
        $query = $this->db->get();
        $result = $query->row();
        return isset($result->id_scan) ? $result->id_scan : null;
    }
    
    public function get_sm_id($id)
    {
        $this->db->where('pendaftaran_seminar.id_seminar', $id);
        return $this->db->get('seminar');
    }
    public function get_seminar_by_id()
    {
        return $this->db->get_where('pendaftaran_seminar', array('id_seminar' => $id))->row();
    }

    public function get_latest_seminar_id()
    {
        $this->db->select('id_seminar');
        $this->db->order_by('id_seminar', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('seminar');
        
        if ($query->num_rows() > 0) {
            return $query->row()->id_seminar;
        } else {
            return null;
        }
    }


    public function cek_id($id)
    {
        $query =  $this->db->where('nim', $id)
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = pendaftaran_seminar.id_mahasiswa', 'left')
            ->join('fakultas', 'fakultas.id_fakultas = mahasiswa.id_fakultas', 'left')
            ->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left')
            ->get('pendaftaran_seminar');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }


    public function cek_khd($id,$seminar)
    {
        $query = $this->db
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = presensi_seminar.id_mahasiswa', 'left')
            ->join('fakultas', 'fakultas.id_fakultas = mahasiswa.id_fakultas', 'left')
            ->join('prodi', 'prodi.id_prodi = mahasiswa.id_prodi', 'left')
            ->get_where('presensi_seminar', ['presensi_seminar.nomor_induk' => $id, 'presensi_seminar.id_seminar' => $seminar]);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function insert_data($data)
    {
        return $this->db->insert('presensi_seminar', $data);
    }

    public function get_nama_seminar_by_id($id)
    {
        $this->db->select('nama_seminar');
        $this->db->from('seminar');
        $this->db->where('id_seminar', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->nama_seminar;
        } else {
            return null;
        }
    }

    public function insert_data_history($history_data) {
        return $this->db->insert('history_seminar', $history_data);
    }

    
    
}