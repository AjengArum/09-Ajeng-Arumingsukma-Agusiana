<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

class KelolaAbsensi_admin extends CI_Controller
{
    var $module_js = ['kelola_absen'];
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
        $this->load->view('view_absen', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $user = $this->input->post('id_user');
        $query = [
            'select' => 'a.id_absensi, a.tgl_absen, a.materi, a.bukti, a.status, b.username',
            'from' => 'tb_absen a',
            'join' => [
                'tb_user b, b.ID = a.id_user'
            ],
            'where' => []
        ];
        if ($user !== '') {
            $query['where']['a.id_user'] = $user;
        }
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id_absensi');
        // $query = [
        //     'select' => 'a.id_member, a.nama, a.alamat, a.asal_sekolah, a.kelas, a.telepon, a.email, b.username',
        //     'from' => 'tb_member a',
        //     'join' => [
        //         'tb_user b, b.id.user = a.id_user'
        //     ],
        //     'where' => [
        //         'a.id_member' => $id
        //     ]
        // ];
        $where = array('id_absensi' => $id);
        $result = $this->data->find('tb_absen', $where)->result();
        echo json_encode($result);
    }


    public function insert_data()
    {
        $this->form_validation->set_rules('tgl_absen', 'tgl_absen', 'required|trim');
        $this->form_validation->set_rules('materi', 'materi', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($_FILES['bukti']['name'])) {
                $response['errors']['bukti'] = "Bukti gambar harus diupload";
            }
            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Tentor harus dipilih";
            }
        } else {
            $tgl_absen = $this->input->post('tgl_absen');
            $materi = $this->input->post('materi');
            $status = $this->input->post('status');

            if (empty($_FILES['bukti']['name'])) {
                $response['errors']['bukti'] = "Bukti gambar harus diupload";
            }
            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Tentor harus dipilih";
            } else {
                $data = array(
                    'id_user' => $id_user = $this->input->post('id_user'),
                    'tgl_absen' => $tgl_absen,
                    'materi' => $materi,
                    'status' => $status,
                );

                if (!empty($_FILES['bukti']['name'])) {
                    $currentDateTime = date('Y-m-d_H-i-s');
                    $config['upload_path'] = './assets/file/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['file_name'] = 'Bukti_' . $currentDateTime;
                    $config['max_size'] = 2048;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('bukti')) {
                        $response['errors']['bukti'] = strip_tags($this->upload->display_errors());
                    } else {
                        $uploaded_data = $this->upload->data();
                        $data['bukti'] = $uploaded_data['file_name'];

                        $this->data->insert('tb_absen', $data);
                        $response['success'] = "Data berhasil ditambahkan";
                    }
                } else {
                    $response['errors']['bukti'] = "Foto harus diupload";
                }
            }
        }
        echo json_encode($response);
    }

    public function delete_data()
    {
        $id = $this->input->post('id_absensi');
        $where = array('id_absensi' => $id);
        $data_absen = $this->data->find('tb_absen', $where)->row_array();
        $deleted = $this->data->delete('tb_absen', $where);

        if ($deleted) {
            $file_path = './assets/file/' . $data_absen['bukti'];

            // Cek apakah $bukti bukan direktori
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
        $this->form_validation->set_rules('tgl_absen', 'tgl_absen', 'required|trim');
        $this->form_validation->set_rules('materi', 'materi', 'required|trim');
        $this->form_validation->set_rules('status', 'status', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Tentor harus dipilih";
            }
        } else {
            $id = $this->input->post('id_absensi');
            $id_user = $this->input->post('id_user');
            $tgl_absen = $this->input->post('tgl_absen');
            $materi = $this->input->post('materi');
            $status = $this->input->post('status');

            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Tentor harus dipilih";
            } else {
                $data = array(
                    'id_user' => $id_user,
                    'tgl_absen' => $tgl_absen,
                    'materi' => $materi,
                    'status' => $status,
                );

                if (!empty($_FILES['bukti']['name'])) {
                    $currentDateTime = date('Y-m-d_H-i-s');
                    $config['upload_path'] = './assets/file/';
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['file_name'] = 'Bukti_' . $currentDateTime;
                    $config['max_size'] = 2048;

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('bukti')) {
                        $response['errors']['bukti'] = strip_tags($this->upload->display_errors());
                    } else {
                        $uploaded_data = $this->upload->data();
                        $data['bukti'] = $uploaded_data['file_name'];
                    }
                }
                $where = array('id_absensi' => $id);
                $this->data->update('tb_absen', $where, $data);
                $response['success'] = "Data berhasil diedit";
            }
        }
        echo json_encode($response);
    }

    public function export_pdf()
    {
        $id_user = $this->input->post('filterUser');
        $query = [
            'select' => 'a.id_absensi, a.tgl_absen, a.materi, a.bukti, a.status, b.username',
            'from' => 'tb_absen a',
            'join' => [
                'tb_user b, b.ID = a.id_user'
            ],
            'where' => []
        ];

        if ($id_user != '') {
            $query['where']['a.id_user'] = $id_user;
        }

        $this->app_data['absen'] = $this->data->get($query)->result();

        $options = new Options();
        $options->set('isHtml5ParseEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $html = $this->load->view('laporan_absen', $this->app_data, true);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Laporan-absen-tentor.pdf", array("Attachment" => 0));
    }
}