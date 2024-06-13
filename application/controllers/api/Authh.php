<?php

use chriskacerguis\RestServer\RestController;

require APPPATH . '/libraries/RestController.php';

class Authh extends RestController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('All_model', 'all');
        $this->load->helper(['url', 'file']);
        $this->load->library('upload');
    }

    public function index_get()
    {
        $this->response($this->all->get_data(), RestController::HTTP_OK);
    }
    
    public function register()
    {
        $id_akses = 'A3';
        $username = $this->input->get('username');
        $alamat = $this->input->get('alamat');
        $telepon = $this->input->get('telepon');
        $email = $this->input->get('email');
        $password = $this->input->get('password');
        $result = $this->all->insert_user($id_akses, $username, $alamat, $telepon, $email, $password);

        if ($result["success"]) {
            $this->response($result, RestController::HTTP_OK);
        } else {
            $this->response($result, RestController::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

}