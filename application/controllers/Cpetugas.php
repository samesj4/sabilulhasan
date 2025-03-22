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
            $no=1;
            foreach ($data_petugas as $row) {
                if($row['level']=='1'){
                    $akses='<span class="text-info" style="text-transform: uppercase"><b>Super Admin</b></span>';
                }else if($row['level']=='2'){
                    $akses='<span class="text-default" style="text-transform: uppercase"><b>Administrator</b></span>';
                }else if($row['level']=='3'){
                    $akses='<span class="text-succes" style="text-transform: uppercase"><b>Keuangan</b></span>';
                }
                if($row['statususer']=='aktif'){
                    $status='<span class="text-succes" style="text-transform: uppercase">Aktif</span>';
                }else{
                    $status='<span class="text-danger" style="text-transform: uppercase">Non Aktif</span>';
                }
               
                $list_petugas .= '<tr>
                    <td>'.$no++.'</td>
                    <td>
                        <img src="'.base_url('assets/image/petugas/'.$row['foto']).'" width="50" height="50" class="img-thumbnail">
                    </td>
<<<<<<< HEAD
                    <td><button type="button" class="btn btn-xs btn-info" onclick=form_edit_petugas("' .$row['id']. '")><i class="nav-icon fas fa-edit"></i></button>  <button type="button" class="btn btn-xs btn-danger" onclick=form_hapus_petugas("' .$row['id']. '")><i class="nav-icon fas fa-trash"></i></button> ' . $row['namapetugas'] . '</td>
=======
                    <td>
                    <button type="button" class="btn btn-xs btn-info" 
                    onclick=form_edit_petugas("' .$row['id']. '")>
                    <i class="nav-icon fas fa-edit"></i></button> 
                     
                    
                    <button type="button" class="btn btn-xs btn-danger"
                     onclick=form_hapus_petugas("' .$row['id']. '")>
                     <i class="nav-icon fas fa-trash"></i></button> 
                     
                     ' . $row['namapetugas'] . '</td>
>>>>>>> ba995a9 (Menyelesaikan berita)
                    <td>'.$row['jabatan'].'</td>
                    <td>'.$row['alamat'].'</td>
                    <td>'.$row['nohp'].'</td>
                    <td>'.$row['username'].'</td>
                    <td>'.$akses.'</td>
                    <td>'.$status.'</td>
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
    
    public function form_tambah_petugas() {
        $this->load->view('petugas/tambah_petugas');
    }
    public function simpan_petugas() {
        $nama = $this->input->post('namapetugas');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $jabatan = $this->input->post('jabatan');
        $alamat = $this->input->post('alamat');
        $nohp = $this->input->post('nohp');
        $level = $this->input->post('level');
        $status_user = $this->input->post('statususer');
        
        if ($nama == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'Nama Tidak Boleh Kosong', 'error' => 'namapetugas'];
        } else if ($username == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'Username Tidak Boleh Kosong', 'error' => 'username'];
        } else if ($password == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'Password Tidak Boleh Kosong', 'error' => 'password'];
        } else if ($jabatan == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'Jabatan Tidak Boleh Kosong', 'error' => 'jabatan'];
        } else if ($alamat == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'Alamat Tidak Boleh Kosong', 'error' => 'alamat'];
        } else if ($nohp == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'No HP Tidak Boleh Kosong', 'error' => 'nohp'];
        } else if ($level == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'Level Tidak Boleh Kosong', 'error' => 'level'];
        } else if ($status_user == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'Status User Tidak Boleh Kosong', 'error' => 'statususer'];
        } else {
                $data = [
                    'namapetugas' => $this->input->post('namapetugas'),
                    'jabatan' => $this->input->post('jabatan'),
                    'alamat' => $this->input->post('alamat'),
                    'nohp' => $this->input->post('nohp'),
                    'username' => $this->input->post('username'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'level' => $this->input->post('level'),
                    'statususer' => $this->input->post('statususer'),
                    'foto' => $this->_uploadFoto()
                ];

                $simpan = $this->Mpetugas->simpanPetugas($data);

                if ($simpan) {
                    $response = [
                        'sukses' => 'ya',
                        'pesan' => 'Data petugas berhasil disimpan.'
                    ];
                } else {
                    $response = [
                        'sukses' => 'tidak',
                        'pesan' => 'Gagal menyimpan data petugas.'
                    ];
                }
        }
        echo json_encode($response);
    
    }

    private function _uploadFoto() {
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './assets/image/petugas';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_' . $_FILES['foto']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                return $this->upload->data('file_name');
            }
        }
        return 'default.jpg'; // Jika tidak ada foto yang diunggah
    }
    // Tampilkan form edit petugas
    public function form_edit_petugas() {
        $id = $this->input->post('id'); // Ambil ID dari AJAX
        if (!$id) {
            show_error('ID tidak ditemukan', 500);
        }
    
        $data['petugas'] = $this->Mpetugas->get_petugas_by_id($id);
        $this->load->view('petugas/edit_petugas', $data);
    }


    public function form_edit_petugas_hapus (){
        $id = $this->input->post('id'); // Ambil ID dari AJAX
        if (!$id) {
            show_error('ID tidak ditemukan', 500);
        }
        $data = [
            'statususer' => 'non-aktif',
        ];
    
        $this->Mpetugas->update_petugas($id, $data);

    }


    // Simpan perubahan data petugas
    public function update_petugas() {
        $id = $this->input->post('id');
        $petugas_lama = $this->Mpetugas->get_petugas_by_id($id); // Data lama
        
        $data = [
            'namapetugas' => $this->input->post('namapetugas'),
            'jabatan' => $this->input->post('jabatan'),
            'alamat' => $this->input->post('alamat'),
            'nohp' => $this->input->post('nohp'),
            'username' => $this->input->post('username'),
            'level' => $this->input->post('level'),
            'statususer' => $this->input->post('statususer')
        ];

        // Cek apakah password diubah
        $password = $this->input->post('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Cek apakah ada file yang diupload
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './assets/image/petugas/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = 'petugas_' . time();

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $data['foto'] = $upload_data['file_name'];

                // Hapus foto lama jika bukan default.jpg
                if ($petugas_lama['foto'] != 'default.jpg' && file_exists('./assets/image/petugas/' . $petugas_lama['foto'])) {
                    unlink('./assets/image/petugas/' . $petugas_lama['foto']);
                }
            } else {
                echo json_encode(['sukses' => 'tidak', 'pesan' => $this->upload->display_errors()]);
                return;
            }
        }

        $update = $this->Mpetugas->update_petugas($id, $data);
        if ($update) {
            echo json_encode(['sukses' => 'ya', 'pesan' => 'Data petugas berhasil diperbarui']);
        } else {
            echo json_encode(['sukses' => 'tidak', 'pesan' => 'Gagal memperbarui data']);
        }
    }
}
