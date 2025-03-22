<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mberita extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->database(); // PENTING: Load database
    }
 
    public function get_all_berita() {
        return $this->db->get('berita')->result();
    }

   

    public function simpanberita($data) {
        return $this->db->insert('berita', $data);
    }

    // Ambil data berita berdasarkan ID
    public function get_berita_by_id($id) {
        return $this->db->get_where('berita', ['id' => $id])->row_array();
    }

    // Update data berita
    public function update_berita($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('berita', $data);
    }

    public function delete_berita($id) {
        return $this->db->delete('berita', ['id' => $id]);
    }
    public function get_berita($search = '', $limit = 10, $start = 0) {
        $this->db->select('id, judul, date(tanggal) as tanggal, ringkasan, gambar,status');
        $this->db->from('berita');

        // Jika ada pencarian
        if (!empty($search)) {
            $this->db->like('judul', $search);
            $this->db->or_like('ringkasan', $search);
        }
        $this->db->order_by('id', 'DESC');
        $this->db->where('status', 'aktif');
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }

    // Fungsi untuk menghitung total data berita
    public function count_berita($search = '') {
        $this->db->from('berita');

        if (!empty($search)) {
            $this->db->like('judul', $search);
            $this->db->or_like('ringkasan', $search);
        }

        return $this->db->count_all_results();
    }
    
}
