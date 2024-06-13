<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran_Pm extends CI_Controller
{
    var $module_js = ['kelola_pembayaran_pm'];
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
        $this->app_data['select'] = $this->data->get_all('tb_murid')->result();
        $this->load->view('header_pm');
        $this->load->view('view_pembayaran_pm', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
        $query = [
            'select' => 'a.id_tagihan, b.nama, a.bulan, a.jumlah, a.status_tagihan',
            'from' => 'tb_tagihan a',
            'join' => [
                'tb_murid b, b.id_murid = a.id_murid'
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    public function get_data_id()
    {
        $id = $this->input->post('id_tagihan');
        $result = $this->data->find('tb_tagihan', array('id_tagihan' => $id))->result();
        echo json_encode($result);
    }



    // public function insert_data()
    // {
    //     $this->form_validation->set_rules('id_tagihan', 'id_tagihan', 'required|trim');
    //     $this->form_validation->set_rules('bulan', 'bulan', 'required|trim');
    //     $this->form_validation->set_rules('jumlah', 'jumlah', 'required|trim');
    //     $this->form_validation->set_rules('status_tagihan', 'status_tagihan', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $response['errors'] = $this->form_validation->error_array();
    //         if (empty($this->input->post('id_murid'))) {
    //             $response['errors']['id_murid'] = "Murid harus dipilih";
    //         }
    //     } else {
    //         $id = $this->input->post('id_tagihan');
    //         $bulan = $this->input->post('bulan');
    //         $jumlah = $this->input->post('jumlah');
    //         $status_tagihan = $this->input->post('status_tagihan');
    //         $id_murid = $this->input->post('id_murid');

    //         if (empty($this->input->post('id_murid'))) {
    //             $response['errors']['id_murid'] = "Murid harus dipilih";
    //         } else {
    //             $data = array(
    //                 'id_tagihan' => $id,
    //                 'id_murid' => $id_murid,
    //                 'bulan' => $bulan,
    //                 'jumlah' => $jumlah,
    //                 'status_tagihan' => $status_tagihan,
    //             );
    //             $this->data->insert('tb_tagihan', $data);
    //             $response['success'] = "Data berhasil ditambahkan";
    //         }
    //     }
    //     echo json_encode($response);
    // }

    // public function delete_data()
    // {
    //     $id = $this->input->post('id_tagihan');
    //     $where = array('id_tagihan' => $id);
        
    //     $deleted = $this->data->delete('tb_tagihan', $where);
    //     if ($deleted) {
    //         $response['success'] = "Data berhasil dihapus";
    //     } else {
    //         $response['error'] = "Gagal menghapus data";
    //     }
    //     echo json_encode($response);
    // }

    // public function edit_data()
    // {
    //     $this->form_validation->set_rules('id_tagihan_1', 'id_tagihan', 'required|trim');
    //     $this->form_validation->set_rules('bulan_1', 'bulan', 'required|trim');
    //     $this->form_validation->set_rules('jumlah_1', 'jumlah', 'required|trim');
    //     $this->form_validation->set_rules('status_tagihan_1', 'status_tagihan', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $response['errors'] = $this->form_validation->error_array();
    //         if (empty($this->input->post('murid'))) {
    //             $response['errors']['murid'] = "Murid harus dipilih";
    //         }
    //     } else {
    //         $id = $this->input->post('id_tagihan_1');
    //         $bulan = $this->input->post('bulan_1');
    //         $jumlah = $this->input->post('jumlah_1');
    //         $status_tagihan = $this->input->post('status_tagihan_1');
    //         $id_murid = $this->input->post('murid');

    //         if (empty($this->input->post('murid'))) {
    //             $response['errors']['murid'] = "Murid harus dipilih";
    //         } else {
    //             $data = array(
    //                 'id_murid' => $id_murid,
    //                 'bulan' => $bulan,
    //                 'jumlah' => $jumlah,
    //                 'status_tagihan' => $status_tagihan,
    //             );
    //             $where = array('id_tagihan' => $id);
    //             $this->data->update('tb_tagihan', $where, $data);
    //             $response['success'] = "Data berhasil diedit";
    //         }
    //     }
    //     echo json_encode($response);
    // }

    public function export_pdf()
	{
        $query = [
            'select' => 'a.id_tagihan, b.nama, a.bulan, a.jumlah, a.status_tagihan',
            'from' => 'tb_tagihan a',
            'join' => [
                'tb_murid b, b.id_murid = a.id_murid'
            ]
        ];
        $data['tagihan'] = $this->data->get($query)->result();
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-data-tagihan.pdf";
		$this->pdf->load_view('laporan_tagihan', $data);
	}
}