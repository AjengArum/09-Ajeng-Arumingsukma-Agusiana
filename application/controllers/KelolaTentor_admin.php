<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class KelolaTentor_admin extends CI_Controller
{
    var $module_js = ['kelola_tentor_admin'];
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
        $this->load->view('header_pm');
        $this->load->view('view_tentor_admin', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $query = [
            'select' => 'a.id_tentor, b.username, a.nama, a.jenjang, a.foto', 
            'from' => 'tb_tentor a',
            'join' => [
                'tb_user b, b.ID = a.id_user'
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id_tentor');
        $result = $this->data->find('tb_tentor', array('id_tentor' => $id))->result();
        echo json_encode($result);
    }


    public function insert_data()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('jenjang', 'jenjang', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($_FILES['foto']['name'])) {
                $response['errors']['foto'] = "Foto harus diupload";
            }
            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Username harus dipilih";
            }
        } else {
            $nama = $this->input->post('nama');
            $jenjang = $this->input->post('jenjang');
            //$id_user = $this->input->post('id_user');
            if ($this->form_validation->run() == false) {
                $response['errors'] = $this->form_validation->error_array();
                if (empty($_FILES['foto']['name'])) {
                    $response['errors']['foto'] = "Foto harus diupload";
                }
                if (empty($this->input->post('id_user'))) {
                    $response['errors']['id_user'] = "Username harus dipilih";
                }
            } else {
                $data = array(
                    'id_user' => $id_user = $this->input->post('id_user'),
                    'nama' => $nama,
                    'jenjang' => $jenjang,
                );
                if (!empty($_FILES['foto']['name'])) {
                    $currentDateTime = date('Y-m-d_H-i-s');
                    $config['upload_path'] = './assets/file/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['file_name'] = 'Foto_' . $currentDateTime;
                    $config['max_size'] = 2048;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('foto')) {
                        $response['errors']['foto'] = strip_tags($this->upload->display_errors());
                    } else {
                        $uploaded_data = $this->upload->data();
                        $data['foto'] = $uploaded_data['file_name'];

                        $this->data->insert('tb_tentor', $data);
                        $response['success'] = "Data berhasil ditambahkan";
                    }
                } else {
                    $response['errors']['foto'] = "Foto harus diupload";
                }
            }
        }
        echo json_encode($response);
    }

    public function delete_data()
    {
        $id = $this->input->post('id_tentor');
        $where = array('id_tentor' => $id);
        $data_absen = $this->data->find('tb_tentor', $where)->row_array();
        $deleted = $this->data->delete('tb_tentor', $where);

        if ($deleted) {
            $file_path = './assets/file/' . $data_absen['foto'];
            if (!is_dir($file_path) && file_exists($file_path)) {
                unlink($file_path);
            }
            $response['success'] = "Data berhasil dihapus";
        } else {
            $response['error'] = "Gagal menghapus data";
        }
        echo json_encode($response);
    }

    public function edit_data()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('jenjang', 'jenjang', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($_FILES['foto']['name'])) {
                $response['errors']['foto'] = "Foto harus diupload";
            }
            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Username harus dipilih";
            }
        } else {
            $id = $this->input->post('id_tentor');
            $nama = $this->input->post('nama');
            $jenjang = $this->input->post('jenjang');
            $id_user = $this->input->post('id_user');

            if (empty($_FILES['foto']['name'])) {
                $response['errors']['foto'] = "Foto harus diupload";
            }

            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Username harus dipilih";
            } else {
                $data = array(
                    'id_user' => $id_user,
                    'nama' => $nama,
                    'jenjang' => $jenjang,
                );

                if (!empty($_FILES['foto']['name'])) {
                    $currentDateTime = date('Y-m-d_H-i-s');
                    $config['upload_path'] = './assets/file/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['file_name'] = 'Foto_' . $currentDateTime;
                    $config['max_size'] = 2048;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('foto')) {
                        $response['errors']['foto'] = strip_tags($this->upload->display_errors());
                    } else {
                        $uploaded_data = $this->upload->data();
                        $data['foto'] = $uploaded_data['file_name'];
                    }
                } else {
                    $response['errors']['foto'] = "Foto harus diupload";
                };
                
                $where = array('id_tentor' => $id);
                $this->data->update('tb_tentor', $where, $data);
                $response['success'] = "Data berhasil diedit";

            }
        }
        echo json_encode($response);
    }

    public function export_pdf()
    {
        $query = [
            'select' => 'a.id_tentor, b.username, a.nama, a.jenjang, a.foto', 
            'from' => 'tb_tentor a',
            'join' => [
                'tb_user b, b.ID = a.id_user'
            ]
        ];
        $this->app_data['tentor'] = $this->data->get($query)->result();

        $options = new Options();
        $options->set('isHtml5ParseEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $html = $this->load->view('laporan_tentor', $this->app_data, true);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Laporan-data-tentor.pdf", array("Attachment" => 0));
    }

 } 