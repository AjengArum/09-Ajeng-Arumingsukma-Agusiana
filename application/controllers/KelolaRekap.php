<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaRekap extends CI_Controller
{
    var $module_js = ['kelola_rekap'];
    var $app_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->_init();
    }

    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }

    public function index()
    {
        $this->app_data['select'] = $this->data->find('tb_user', array('id_akses' => 'A2'))->result();

        $this->load->view('header');
        $this->load->view('view_rekap_absen', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $query = [
            'select' => 'a.id_rekap, b.username, a.judul, a.created_at, a.file_name',
            'from' => 'tb_rekapabsen a',
            'join' => [
                'tb_user b, b.ID = a.id_user'
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id_rekap');
        $query = [
            'select' => 'a.id_rekap, a.judul, a.created_at, a.file_name, b.username',
            'from' => 'tb_rekapabsen a',
            'join' => [
                'tb_user b, b.ID = a.id_user'
            ],
            'where' => [
                'a.id_rekap' => $id
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }


    public function insert_data()
    {
       // $this->form_validation->set_rules('id_rekap', 'id_rekap', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($_FILES['file']['name'])) {
                $response['errors']['file'] = "File harus diupload";
            }
            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Tentor harus dipilih";
            }
        } else {
           // $id = $this->input->post('id_rekap');
            $keterangan = $this->input->post('keterangan');
            $id_user = $this->input->post('id_user');

            if (empty($_FILES['file']['name'])) {
                $response['errors']['file'] = "File harus diupload";
            }
            if (empty($id_user)) {
                $response['errors']['id_user'] = "Tentor harus dipilih";
            } else {
                $data = array(
                   // 'id_rekap' => $id,
                    'id_user' => $id_user,
                    'judul' => $keterangan,
                );

                if (!empty($_FILES['file']['name'])) {
                    $currentDateTime = date('Y-m-d_H-i-s');
                    $config['upload_path'] = './assets/file/';
                    $config['allowed_types'] = 'pdf';
                    $config['file_name'] = "Rekap-" . $currentDateTime;
                    $config['max_size'] = 5000;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('file')) {
                        $response['errors']['file'] = strip_tags($this->upload->display_errors());
                    } else {
                        $uploaded_data = $this->upload->data();
                        $data['file_name'] = $uploaded_data['file_name'];
                        $this->data->insert('tb_rekapabsen', $data);
                    }
                }
                $response['success'] = "Data berhasil ditambahkan";
            }
        }
        echo json_encode($response);
    }

    public function delete_data()
{
    $id = $this->input->post('id_rekap');
    $where = array('id_rekap' => $id);

    $file_name = $this->data->get_file_name('tb_rekapabsen', $where, 'file_name');

    $deleted = $this->data->delete('tb_rekapabsen', $where);
    if ($deleted) {
        if ($file_name) {
            $file_path = './assets/file/' . $file_name;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        $response['success'] = "Data berhasil dihapus";
    } else {
        $response['error'] = "Gagal menghapus data";
    }
    echo json_encode($response);
}

    public function download_file($fileName)
    {
        $filePath = FCPATH . 'assets/file/' . $fileName;

        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $fileName . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        } else {
            echo "File not found";
        }
    }

    public function edit_data()
    {
        $id = $this->input->post('id_rekap');
        $timestamp = $this->db->query("SELECT NOW() as timestamp")->row()->timestamp;
        $where = array('id_rekap' => $id);
        $file_name = $this->data->get_file_name('tb_rekapabsen', $where, 'file_name');

        if (!empty($_FILES['file2']['name'])) {
            $currentDateTime = date('Y-m-d_H-i-s');
            $config['upload_path'] = './assets/file/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = "Rekap-" . $currentDateTime;
            $config['max_size'] = 5000;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file2')) {
                $upload_data = $this->upload->data();
                $data = array(
                    'file_name' => $upload_data['file_name'],
                );
                $where = array('id_rekap' => $id);
                $updated = $this->data->update('tb_rekapabsen', $where, $data);
                if ($updated) {
                    if (isset($file_name)) {
                        $file_path = './assets/file/' . $file_name;
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                    $response['success'] = "Data berhasil diupdate";
                } else {
                    $response['error'] = "Gagal menghapus data";
                }

            } else {
                $response['errors']['file2'] = strip_tags($this->upload->display_errors());
            }
        } else {
            $response['success'] = "Tidak melakukan update data";
        }
        echo json_encode($response);
    }
}
