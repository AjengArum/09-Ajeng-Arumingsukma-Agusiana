<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaMember_admin extends CI_Controller
{
    var $module_js = ['kelola_member_admin'];
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
        $this->app_data['select_user'] = $this->data->find('tb_user',  array('id_akses' => 'A1'))->result();
        $this->app_data['select'] = $this->data->get_all('tb_layanan')->result(); 
        $this->load->view('header');
        $this->load->view('view_member', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $query = [
            'select' => 'a.id_murid, b.username, c.nama_layanan, a.nama, a.asal_sekolah',
            'from' => 'tb_murid a',
            'join' => [
                'tb_user b, b.ID = a.id_user',
                'tb_layanan c, c.id_layanan = a.id_layanan, left',
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id_murid');
        $result = $this->data->find('tb_murid', array('id_murid' => $id))->result();
        echo json_encode($result);
    }


    public function insert_data()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('asal_sekolah', 'asal_sekolah', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Username harus dipilih";
            }
            if (empty($this->input->post('id_layanan'))) {
                $response['errors']['id_layanan'] = "Nama layanan harus dipilih";
            }
        } else {
            $nama = $this->input->post('nama');
            $asal_sekolah = $this->input->post('asal_sekolah');
            $id_user = $this->input->post('id_user');
            $id_layanan = $this->input->post('id_layanan');

            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Username harus dipilih";
            }
            if (empty($this->input->post('id_layanan'))) {
                $response['errors']['id_layanan'] = "Nama layanan harus dipilih";
            } else {
                $data = array(
                    'id_user' => $id_user,
                    'id_layanan' => $id_layanan,
                    'nama' => $nama,
                    'asal_sekolah' => $asal_sekolah,
                );
                $this->data->insert('tb_murid', $data);
                $response['success'] = "Data berhasil ditambahkan";
            }
        }
        echo json_encode($response);
    }

    public function delete_data()
    {
        $id = $this->input->post('id_murid');
        $where = array('id_murid' => $id);
        
        $deleted = $this->data->delete('tb_murid', $where);
        if ($deleted) {
            $response['success'] = "Data berhasil dihapus";
        } else {
            $response['error'] = "Gagal menghapus data";
        }
        echo json_encode($response);
    }

    public function edit_data()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required|trim');
        $this->form_validation->set_rules('asal_sekolah', 'asal_sekolah', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Username harus dipilih";
            }
            if (empty($this->input->post('id_layanan'))) {
                $response['errors']['id_layanan'] = "Nama layanan harus dipilih";
            }
        } else {
            $id = $this->input->post('id_murid');
            $nama = $this->input->post('nama');
            $asal_sekolah = $this->input->post('asal_sekolah');
            $id_user = $this->input->post('id_user');
            $id_layanan = $this->input->post('id_layanan');

            if (empty($this->input->post('id_user'))) {
                $response['errors']['id_user'] = "Username harus dipilih";
            }
            if (empty($this->input->post('id_layanan'))) {
                $response['errors']['id_layanan'] = "Nama layanan harus dipilih";
            } else {
                $data = array(
                    'id_user' => $id_user,
                    'nama' => $nama,
                    'id_layanan' => $id_layanan,
                    'asal_sekolah' => $asal_sekolah,
                );

                $where = array('id_murid' => $id);
                $this->data->update('tb_murid', $where, $data);
                $response['success'] = "Data berhasil diedit";
            }
        }
        echo json_encode($response);
    }

//     public function export_pdf()
// 	{
//         $query = [
//             'select' => 'a.id_murid, b.username, c.nama_layanan, a.nama, a.asal_sekolah, a.kelas',
//             'from' => 'tb_murid a',
//             'join' => [
//                 'tb_user b, b.ID = a.id_user',
//                 'tb_layanan c, c.id_layanan = a.id_layanan, left',
//             ]
//         ];
//         $data['murid'] = $this->data->get($query)->result();
// 		$this->load->library('pdf');
// 		$this->pdf->setPaper('A4', 'potrait');
// 		$this->pdf->filename = "laporan-data-gendeng.pdf";
// 		$this->pdf->load_view('laporan_murid', $data);
// 	}
} 