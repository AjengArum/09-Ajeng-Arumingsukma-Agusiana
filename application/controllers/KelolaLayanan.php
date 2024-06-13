<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaLayanan extends CI_Controller
{
    var $module_js = ['kelola_layanan'];
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
        $this->app_data['select'] = $this->data->get_all('tb_tentor')->result();
        $this->load->view('header');
        $this->load->view('view_layanan', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $query = [
            'select' => 'a.id_layanan, b.nama, a.nama_layanan, a.keterangan, a.biaya, a.kuota',
            'from' => 'tb_layanan a',
            'join' => [
                'tb_tentor b, b.id_tentor = a.id_tentor'
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id_layanan');
        $result = $this->data->find('tb_layanan', array('id_layanan' => $id))->result();
        echo json_encode($result);
    }

    public function insert_data()
    {
       // $this->form_validation->set_rules('id_layanan', 'id_layanan', 'required|trim');
        $this->form_validation->set_rules('nama_layanan', 'nama_layanan', 'required|trim');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim');
        $this->form_validation->set_rules('biaya', 'biaya', 'required|trim');
        $this->form_validation->set_rules('kuota', 'kuota', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('id_tentor'))) {
                $response['errors']['id_tentor'] = "Tentor harus dipilih";
            }
        } else {
           // $id = $this->input->post('id_layanan');
            $nama_layanan = $this->input->post('nama_layanan');
            $keterangan = $this->input->post('keterangan');
            $biaya = $this->input->post('biaya');
            $kuota = $this->input->post('kuota');
            $id_tentor = $this->input->post('id_tentor');

            if (empty($this->input->post('id_tentor'))) {
                $response['errors']['id_tentor'] = "Tentor harus dipilih";
            } else {
                $data = array(
                   // 'id_layanan' => $id,
                    'id_tentor' => $id_tentor,
                    'nama_layanan' => $nama_layanan,
                    'keterangan' => $keterangan,
                    'biaya' => $biaya,
                    'kuota' => $kuota,
                );
            $this->data->insert('tb_layanan', $data);
            $response['success'] = "Data berhasil ditambahkan";
        }
    }
        echo json_encode($response);
    }

    public function edit_data()
{
    //$this->form_validation->set_rules('id_layanan_1', 'id_layanan', 'required|trim');
    $this->form_validation->set_rules('nama_layanan', 'nama layanan', 'required|trim');
    $this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim');
    $this->form_validation->set_rules('biaya', 'biaya', 'required|trim');
    $this->form_validation->set_rules('kuota', 'kuota', 'required|trim');

    if ($this->form_validation->run() == false) {
        $response['errors'] = $this->form_validation->error_array();
        if (empty($this->input->post('id_tentor'))) {
            $response['errors']['id_tentor'] = "Tentor harus dipilih";
        }
    } else {
        $id = $this->input->post('id_layanan');
        $nama_layanan = $this->input->post('nama_layanan');
        $keterangan = $this->input->post('keterangan');
        $biaya = $this->input->post('biaya');
        $kuota = $this->input->post('kuota');
        $id_tentor = $this->input->post('id_tentor');

        if (empty($this->input->post('id_tentor'))) {
            $response['errors']['id_tentor'] = "Tentor harus dipilih";
        } else {
        $data = array(
            // 'id_layanan' => $id,
            'id_tentor' => $id_tentor,
            'nama_layanan' => $nama_layanan,
            'keterangan' => $keterangan,
            'biaya' => $biaya,
            'kuota' => $kuota,
        );

        $where = array('id_layanan' => $id);
        $this->data->update('tb_layanan', $where, $data);
        $response['success'] = "Data berhasil diedit";
    }
}

    echo json_encode($response);
}


    public function delete_data()
    {
        $id = $this->input->post('id_layanan');
        $where = array('id_layanan' => $id);

        $deleted = $this->data->delete('tb_layanan', $where);
        if ($deleted) {
            $response['success'] = "Data berhasil dihapus";
        } else {
            $response['error'] = "Gagal menghapus data";
        }
        echo json_encode($response);
    }
}