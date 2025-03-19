<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mpetugas');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('logged_in')) {
            redirect('Clogin');
        }
    }

    public function index() {
        $data['petugas'] = $this->Mpetugas->get_user_by_id($this->session->userdata('id_user'));
        $this->load->view('admin_dashboard', $data);
    }
}
?>
