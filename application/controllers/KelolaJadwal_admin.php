<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaJadwal_admin extends CI_Controller
{
    var $module_js = ['kelola_jadwal'];
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
        $this->app_data['select'] = $this->data->get_all('tb_layanan')->result();
        $this->load->view('header');
        $this->load->view('view_jadwal', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $query = [
            'select' => 'a.id_jadwal, b.nama_layanan, a.hari, a.jam_mulai, a.jam_berakhir',
            'from' => 'tb_jadwal a',
            'join' => [
                'tb_layanan b, b.id_layanan = a.id_layanan'
            ],
            'order_by' => 'a.id_jadwal'
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id_jadwal');
        $result = $this->data->find('tb_jadwal', array('id_jadwal' => $id))->result();
        echo json_encode($result);
    }

    public function insert_data()
    {
        $this->form_validation->set_rules('hari', 'hari', 'required|trim');
        $this->form_validation->set_rules('jam_mulai', 'jam_mulai', 'required|trim');
        $this->form_validation->set_rules('jam_berakhir', 'jam_berakhir', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('id_layanan'))) {
                $response['errors']['id_layanan'] = "Layanan harus dipilih";
            }
        } else {
            $hari = $this->input->post('hari');
            $jam_mulai = $this->input->post('jam_mulai');
            $jam_berakhir = $this->input->post('jam_berakhir');
            $id_layanan = $this->input->post('id_layanan');

            if (empty($this->input->post('id_layanan'))) {
                $response['errors']['id_layanan'] = "Layanan harus dipilih";
            } elseif (strtotime($jam_mulai) >= strtotime($jam_berakhir)) {
                $response['errors']['jam_mulai'] = "Jam mulai harus lebih kecil dari jam berakhir";
                $response['errors']['jam_berakhir'] = "Jam berakhir harus lebih besar dari jam mulai";
            } elseif ($this->is_conflict($hari, $jam_mulai, $jam_berakhir, $id_layanan)) {
                $response['errors']['conflict'] = "Jadwal berbenturan dengan jadwal lain pada hari yang sama";
            } else {
                $data = array(
                    'id_layanan' => $id_layanan,
                    'hari' => $hari,
                    'jam_mulai' => $jam_mulai,
                    'jam_berakhir' => $jam_berakhir,
                );
                $this->data->insert('tb_jadwal', $data);
                $response['success'] = "Data berhasil ditambahkan";
            }
        }
        echo json_encode($response);
    }

    public function delete_data()
    {
        $id = $this->input->post('id_jadwal');
        $where = array('id_jadwal' => $id);
        
        $deleted = $this->data->delete('tb_jadwal', $where);
        if ($deleted) {
            $response['success'] = "Data berhasil dihapus";
        } else {
            $response['error'] = "Gagal menghapus data";
        }
        echo json_encode($response);
    }

    public function edit_data()
    {
        $this->form_validation->set_rules('hari', 'hari', 'required|trim');
        $this->form_validation->set_rules('jam_mulai', 'jam_mulai', 'required|trim');
        $this->form_validation->set_rules('jam_berakhir', 'jam_berakhir', 'required|trim');

        if ($this->form_validation->run() == false) {
            $response['errors'] = $this->form_validation->error_array();
            if (empty($this->input->post('id_layanan'))) {
                $response['errors']['id_layanan'] = "Layanan harus dipilih";
            }
        } else {
            $id = $this->input->post('id_jadwal');
            $hari = $this->input->post('hari');
            $jam_mulai = $this->input->post('jam_mulai');
            $jam_berakhir = $this->input->post('jam_berakhir');
            $id_layanan = $this->input->post('id_layanan');

            if (empty($this->input->post('id_layanan'))) {
                $response['errors']['id_layanan'] = "Layanan harus dipilih";
            } elseif (strtotime($jam_mulai) >= strtotime($jam_berakhir)) {
                $response['errors']['jam_mulai'] = "Jam mulai harus lebih kecil dari jam berakhir";
                $response['errors']['jam_berakhir'] = "Jam berakhir harus lebih besar dari jam mulai";
            } elseif ($this->is_conflict($hari, $jam_mulai, $jam_berakhir, $id_layanan, $id)) {
                $response['errors']['conflict'] = "Jadwal berbenturan dengan jadwal lain pada hari yang sama";
            } else {
                $data = array(
                    'id_layanan' => $id_layanan,
                    'hari' => $hari,
                    'jam_mulai' => $jam_mulai,
                    'jam_berakhir' => $jam_berakhir,
                );
                $where = array('id_jadwal' => $id);
                $this->data->update('tb_jadwal', $where, $data);
                $response['success'] = "Data berhasil diedit";
            }
        }
        echo json_encode($response);
    }

    private function is_conflict($hari, $jam_mulai, $jam_berakhir, $id_layanan, $id_jadwal = null)
    {
        $this->db->where('hari', $hari);
        $this->db->where('id_layanan', $id_layanan);

        if ($id_jadwal) {
            $this->db->where('id_jadwal !=', $id_jadwal);
        }
        if ($jam_mulai) {
            $this->db->where('jam_mulai !=', $jam_mulai);
        }

        $this->db->group_start();
        $this->db->where('jam_mulai <', $jam_berakhir);
        $this->db->where('jam_berakhir >', $jam_mulai);
        $this->db->group_end();

        $query = $this->db->get('tb_jadwal');

        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }
}
