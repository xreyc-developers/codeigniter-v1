<?php
class Faqs_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_faqs($slug = FALSE) {
        if ($slug === FALSE) {
            $query = $this->db->get('faqs');
            return $query->result_array();
        }
        $query = $this->db->get_where('faqs', array('slug' => $slug));
        return $query->row_array();
    }

    public function get_faqs_by_id($id = 0) {
        if ($id === 0) {
            $query = $this->db->get('faqs');
            return $query->result_array();
        }
        $query = $this->db->get_where('faqs', array('id' => $id));
        return $query->row_array();
    }

    public function set_faqs($id = 0) {
        $this->load->helper('url');
        $slug = url_title($this->input->post('title'), 'dash', TRUE);
        $data = array(
        'title' => $this->input->post('title'),
        'slug' => $slug,
        'text' => $this->input->post('text')
        );
        if ($id == 0) {
            return $this->db->insert('faqs', $data);
        } else {
            $this->db->where('id', $id);
            return $this->db->update('faqs', $data);
        }
    }

    public function delete_faqs($id) {
        $this->db->where('id', $id);
        return $this->db->delete('faqs');
    }
}