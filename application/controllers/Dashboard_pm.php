<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_pm extends CI_Controller
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
        $this->app_data['murid'] = $this->data->count('tb_murid');
        $this->app_data['tentor'] = $this->data->count('tb_tentor');
        $this->app_data['tagihan'] = $this->data->count('tb_tagihan');


        $this->load->view('header_pm');
        $this->load->view('view_dashboard_pm', $this->app_data);
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }
}