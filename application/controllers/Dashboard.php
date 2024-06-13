<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    var $module_js = [];
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
        $this->app_data['layanan'] = $this->data->count('tb_layanan');
        $this->app_data['tagihan'] = $this->data->count('tb_tagihan');
        $this->app_data['murid'] = $this->data->count('tb_murid');


        $this->load->view('header');
        $this->load->view('view_dashboard', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }
}