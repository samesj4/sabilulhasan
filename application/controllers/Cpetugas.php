<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cpetugas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Mpetugas');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('logged_in')) {
            redirect('Clogin');
        }
    }

    public function petugas() {
       
        $this->load->view('petugas/petugas');
    }
    public function search_petugas() {
        $page = $this->input->post('page') ? (int)$this->input->post('page') : 1;
        $baris = $this->input->post('baris') ? (int)$this->input->post('baris') : 10;
        $search_petugas_by = $this->input->post('search_petugas_by');

        $start = ($page - 1) * $baris;

        $data_petugas = $this->Mpetugas->get_petugas($search_petugas_by, $baris, $start);
        $total_petugas = $this->Mpetugas->count_petugas($search_petugas_by);

        if (!empty($data_petugas)) {
            $list_petugas = '';
            foreach ($data_petugas as $row) {
                $list_petugas .= '<tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['namapetugas'].'</td>
                    <td>'.$row['jabatan'].'</td>
                    <td>'.$row['alamat'].'</td>
                    <td>'.$row['nohp'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$row['level'].'</td>
                    <td>'.$row['statususer'].'</td>
                </tr>';
            }

            $response = [
                'sukses' => 'ya',
                'list_petugas' => $list_petugas,
                'total_petugas' => $total_petugas,
                'baris' => $baris,
                'current_page' => $page
            ];
        } else {
            $response = [
                'sukses' => 'tidak',
                'list_petugas' => '<tr><td colspan="8">Tidak ditemukan</td></tr>',
                'total_petugas' => 0
            ];
        }

        echo json_encode($response);
    }
    

    public function create() {
        $this->load->view('petugas/create');
    }

    public function store() {
        $data = [
            'namapetugas' => $this->input->post('namapetugas'),
            'jabatan'     => $this->input->post('jabatan'),
            'alamat'      => $this->input->post('alamat'),
            'nohp'        => $this->input->post('nohp'),
            'foto'        => $this->input->post('foto'),
            'username'    => $this->input->post('username'),
            'password'    => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'level'       => $this->input->post('level'),
            'statususer'  => $this->input->post('statususer')
        ];
        $this->Mpetugas->insert_petugas($data);
        redirect('Cpetugas');
    }

    public function edit($id) {
        $data['petugas'] = $this->Mpetugas->get_petugas_by_id($id);
        $this->load->view('petugas/edit', $data);
    }

    public function update($id) {
        $data = [
            'namapetugas' => $this->input->post('namapetugas'),
            'jabatan'     => $this->input->post('jabatan'),
            'alamat'      => $this->input->post('alamat'),
            'nohp'        => $this->input->post('nohp'),
            'foto'        => $this->input->post('foto'),
            'username'    => $this->input->post('username'),
            'level'       => $this->input->post('level'),
            'statususer'  => $this->input->post('statususer')
        ];
        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }
        $this->Mpetugas->update_petugas($id, $data);
        redirect('Cpetugas');
    }

    public function delete($id) {
        $this->Mpetugas->delete_petugas($id);
        redirect('Cpetugas');
    }
}
