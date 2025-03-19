<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clogin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['form', 'security']);
        $this->load->library(['form_validation', 'session']);
        $this->load->model('Mpetugas');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('admin');
        }
        $this->load->view('login');
    }

    public function auten() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['pesan' => "Validasi gagal!"]);
            return;
        }

        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        // Cek percobaan login
        if ($this->Mpetugas->check_login_attempts($username)) {
            echo json_encode(['pesan' => "Terlalu banyak percobaan login. Coba lagi nanti!"]);
            return;
        }

        $user = $this->Mpetugas->login($username, $password);

        if ($user) {
            // Simpan sesi
            

            // Simpan log berhasil login
            $this->Mpetugas->log_login_attempt($username, 'success');

            $session_data = [
                'id_user' => $user->id,
                'nama'    => $user->namapetugas,
                'akses'   => $user->level,
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($session_data);

            echo json_encode(['pesan' => "sukses", 'redirect' => site_url('admin_dashboard')]);
        } else {
            // Simpan log gagal login
            $this->Mpetugas->log_login_attempt($username, 'failed');

            echo json_encode(['pesan' => "Username atau password salah!"]);
        }
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('login');
    }
}
