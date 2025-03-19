<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mpetugas extends CI_Model {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->database(); // PENTING: Load database
    }

    // Validasi login
    public function login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('statususer', 'aktif');
        $query = $this->db->get('petugas', 1);

        if ($query->num_rows() == 1) {
            $user = $query->row();
            // Verifikasi password dengan hash
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    // Simpan percobaan login ke database
    public function log_login_attempt($username, $status) {
        $data = [
            'username'   => $username,
            'ip_address' => $this->input->ip_address(),
            'status'     => $status
        ];
        return $this->db->insert('login_attempts', $data);
    }

    // Batasi percobaan login (5 kali dalam 10 menit)
    public function check_login_attempts($username) {
        $this->db->where('username', $username);
        $this->db->where('ip_address', $this->input->ip_address());
        $this->db->where('status', 'failed');
        $this->db->where('timestamp >=', date('Y-m-d H:i:s', strtotime('-10 minutes')));
        return $this->db->count_all_results('login_attempts') >= 5;
    }
    public function get_user_by_id($id) {
        $this->db->select('id, namapetugas, jabatan, alamat, nohp, username, level, statususer');
        $this->db->from('petugas');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if ($query->num_rows() == 0) {
            return null; // Jika tidak ditemukan
        }
        return $query->row(); // Mengembalikan sebagai objek
    }
}
