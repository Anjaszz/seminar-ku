<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ChatModel extends CI_Model {
    public function getChats($id_vendor, $id_seminar) {
        $this->db->select('chat_komunitas.*, mahasiswa.nama_mhs');
        $this->db->from('chat_komunitas');
        $this->db->join('mahasiswa', 'chat_komunitas.id_mahasiswa = mahasiswa.id_mahasiswa');
        $this->db->where('chat_komunitas.id_vendor', $id_vendor);
        $this->db->where('chat_komunitas.id_seminar', $id_seminar);
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get()->result_array();
    }

    public function saveChat($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('chat_komunitas', $data);
    }

    public function updateChat($id_chat, $data) {
        $this->db->where('id_chat', $id_chat);
        return $this->db->update('chat_komunitas', $data);
    }

    public function deleteChat($id_chat) {
        $this->db->where('id_chat', $id_chat);
        return $this->db->delete('chat_komunitas');
    }

    public function getChatById($id_chat) {
        return $this->db->get_where('chat_komunitas', ['id_chat' => $id_chat])->row_array();
    }
}
