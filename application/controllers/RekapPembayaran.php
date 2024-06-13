<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapPembayaran extends CI_Controller
{
    var $module_js = ['rekap_pembayaran'];
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
        $this->load->view('header');
        $this->load->view('view_rekap_pembayaran', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }

    // public function get_data()
    // {
    //     $query = [
    //         'select' => 'a.id_tagihan, b.username, a.bulan, a.jumlah, a.status_tagihan',
    //         'from' => 'tb_tagihan a',
    //         'join' => [
    //             'tb_user b, b.ID = a.id_user',
    //         ]
    //     ];
    //     $result = $this->data->get($query)->result();
    //     echo json_encode($result);
    // }

    public function get_data()
    {
    $query = [
        'select' => 'a.id_tagihan, b.username, a.bulan, a.jumlah, a.status_tagihan',
        'from' => 'tb_tagihan a',
        'join' => [
            'tb_user b, b.ID = a.id_user',
        ],
        'where' => ['a.status_tagihan' => 'lunas']  // Hanya ambil data dengan status belum lunas
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

    public function delete_data()
    {
        $id = $this->input->post('id_tagihan');
        $where = array('id_tagihan' => $id);
        
        $deleted = $this->data->delete('tb_tagihan', $where);
        if ($deleted) {
            $response['success'] = "Data berhasil dihapus";
        } else {
            $response['error'] = "Gagal menghapus data";
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