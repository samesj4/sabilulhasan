<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cberita extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Mberita');
        $this->load->library('session');
        $this->load->helper('url');

        if (!$this->session->userdata('logged_in')) {
            redirect('Clogin');
        }
    }

    public function berita() {
       
        $this->load->view('berita/berita');
    }
    public function search_berita() {
        $page = $this->input->post('page') ? (int)$this->input->post('page') : 1;
        $baris = $this->input->post('baris') ? (int)$this->input->post('baris') : 10;
        $search_berita_by = $this->input->post('search_berita_by');

        $start = ($page - 1) * $baris;

        $data_berita = $this->Mberita->get_berita($search_berita_by, $baris, $start);
        $total_berita = $this->Mberita->count_berita($search_berita_by);

        if (!empty($data_berita)) {
            $list_berita = '';
            $no=1;
            foreach ($data_berita as $row) {
                
               
                $list_berita .= '<tr>
                    <td>'.$no++.'</td>
                    <td><button type="button" class="btn btn-xs btn-info" onclick=form_edit_berita("' .$row['id']. '")><i class="nav-icon fas fa-edit"></i></button>  <button type="button" class="btn btn-xs btn-danger" onclick=form_hapus_berita("' .$row['id']. '")><i class="nav-icon fas fa-trash"></i></button> ' . $row['judul'] . '<br>
                        <img src="'.base_url('assets/image/berita/'.$row['gambar']).'" width="300" height="300" class="img-thumbnail">
                    </td>
                    <td>'.$row['tanggal'].'</td>
                    <td style="max-width: 250px; white-space: normal; word-wrap: break-word;">
'.$row['ringkasan'].'</td>
                   
                </tr>';
            }

            $response = [
                'sukses' => 'ya',
                'list_berita' => $list_berita,
                'total_berita' => $total_berita,
                'baris' => $baris,
                'current_page' => $page
            ];
        } else {
            $response = [
                'sukses' => 'tidak',
                'list_berita' => '<tr><td colspan="8">Tidak ditemukan</td></tr>',
                'total_berita' => 0
            ];
        }

        echo json_encode($response);
    }
    
    public function form_tambah_berita() {
        $this->load->view('berita/tambah_berita');
    }
    public function simpan_berita() {
        $namaberita = $this->input->post('namaberita');
        $tanggal = $this->input->post('tanggal');
        $ringkasan = $this->input->post('ringkasan');
        
        if ($namaberita == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'Berita Tidak Boleh Kosong', 'error' => 'namaberita'];
        } else if ($tanggal == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'tanggal Tidak Boleh Kosong', 'error' => 'tanggal'];
        } else if ($ringkasan == "") {
            $response = ['sukses' => 'tidak', 'pesan' => 'ringkasan Tidak Boleh Kosong', 'error' => 'ringkasan'];
        } else {
                $data = [
                    'judul' => $this->input->post('namaberita'),
                    'tanggal' => $this->input->post('tanggal'),
                    'ringkasan' => $this->input->post('ringkasan'),
                    'gambar' => $this->_uploadFoto()
                ];

                $simpan = $this->Mberita->simpanberita($data);

                if ($simpan) {
                    $response = [
                        'sukses' => 'ya',
                        'pesan' => 'Data berita berhasil disimpan.'
                    ];
                } else {
                    $response = [
                        'sukses' => 'tidak',
                        'pesan' => 'Gagal menyimpan data berita.'
                    ];
                }
        }
        echo json_encode($response);
    
    }

    private function _uploadFoto() {
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './assets/image/berita';
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
    // Tampilkan form edit berita
    public function form_edit_berita() {
        $id = $this->input->post('id'); // Ambil ID dari AJAX
        if (!$id) {
            show_error('ID tidak ditemukan', 500);
        }
    
        $data['berita'] = $this->Mberita->get_berita_by_id($id);
        $this->load->view('berita/edit_berita', $data);
    }
    public function form_edit_berita_hapus() {
        $id = $this->input->post('id'); // Ambil ID dari AJAX
        if (!$id) {
            show_error('ID tidak ditemukan', 500);
        }
    
        $data = [
            'status' => 'non-aktif',
        ];
    
        $this->Mberita->update_berita($id, $data);
    }

    
    


    // Simpan perubahan data berita
    public function update_berita() {
        $id = $this->input->post('id');
        $berita_lama = $this->Mberita->get_berita_by_id($id); // Data lama
        
        $data = [
            'judul' => $this->input->post('judul'),
            'tanggal' => $this->input->post('tanggal'),
            'ringkasan' => $this->input->post('ringkasan'),
        ];

              // Cek apakah ada file yang diupload
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './assets/image/berita/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;
            $config['file_name'] = 'berita_' . time();

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $upload_data = $this->upload->data();
                $data['gambar'] = $upload_data['file_name'];

                // Hapus foto lama jika bukan default.jpg
                if ($berita_lama['gambar'] != 'default.jpg' && file_exists('./assets/image/berita/' . $berita_lama['gambar'])) {
                    unlink('./assets/image/berita/' . $berita_lama['gambar']);
                }
            } else {
                echo json_encode(['sukses' => 'tidak', 'pesan' => $this->upload->display_errors()]);
                return;
            }
        }

        $update = $this->Mberita->update_berita($id, $data);
        if ($update) {
            echo json_encode(['sukses' => 'ya', 'pesan' => 'Data berita berhasil diperbarui']);
        } else {
            echo json_encode(['sukses' => 'tidak', 'pesan' => 'Gagal memperbarui data']);
        }
    }
}
