<?php
class Sertif_model extends CI_Model {

    public function get_student($id) {
        return $this->db->where('id', $id)->get('students')->row();
    }

    public function get_all_students() {
        return $this->db->get('students')->result();
    }
}
?>
