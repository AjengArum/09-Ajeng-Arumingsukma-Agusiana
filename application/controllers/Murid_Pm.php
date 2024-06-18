<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Murid_Pm extends CI_Controller
{
    var $module_js = ['kelola_member_pm'];
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
        $this->load->view('header_pm');
        $this->load->view('view_member_pm', $this->app_data);
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

    public function export_pdf()
	{
        $query = [
            'select' => 'a.id_murid, b.username, c.nama_layanan, a.nama, a.asal_sekolah',
            'from' => 'tb_murid a',
            'join' => [
                'tb_user b, b.ID = a.id_user',
                'tb_layanan c, c.id_layanan = a.id_layanan, left',
            ]
        ];
        $data['murid'] = $this->data->get($query)->result();
		$this->load->library('pdf');
		$this->pdf->setPaper('A4', 'potrait');
		$this->pdf->filename = "laporan-data-murid.pdf";
		$this->pdf->load_view('laporan_murid', $data);
	}
 } 