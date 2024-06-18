<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

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
        $this->app_data['select'] = $this->data->find('tb_user',  array('id_akses' => 'A1'))->result();
        $this->load->view('header_pm');
        $this->load->view('view_pembayaran_pm', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    public function get_data()
    {
    $user = $this->input->post('id_user');
    $query = [
        'select' => 'a.id_tagihan, b.username, a.bulan, a.jumlah, a.status_tagihan',
        'from' => 'tb_tagihan a',
        'join' => [
            'tb_user b, b.ID = a.id_user',
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
        $id = $this->input->post('id_tagihan');
        $result = $this->data->find('tb_tagihan', array('id_tagihan' => $id))->result();
        echo json_encode($result);
    }

    public function export_pdf()
	{
        $id_user = $this->input->post('filterUser');
        $query = [
            'select' => 'a.id_tagihan, b.username, a.bulan, a.jumlah, a.status_tagihan',
            'from' => 'tb_tagihan a',
            'join' => [
                'tb_user b, b.ID = a.id_user',
            ],
            'where' => []  // Hanya ambil data dengan status belum lunas
        ];
        if ($id_user !== '') {
            $query['where']['a.id_user'] = $id_user;
        }

        $this->app_data['pembayaran'] = $this->data->get($query)->result();

        $options = new Options();
        $options->set('isHtml5ParseEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $html = $this->load->view('lapora_pembayaran', $this->app_data, true);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Lapora-pembayaran.pdf", array("Attachment" => 0));
    } 
	}