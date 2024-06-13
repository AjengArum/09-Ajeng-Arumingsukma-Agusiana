<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    var $module_js = ['auth_password'];
    var $app_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->_init();
    }

    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }

    //==================================================================================== LOGIN

    public function index()
    {
        $this->load->model('user_model');

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() === false) {
            $this->load->view('login', $this->app_data);
            $this->load->view('footer', $this->app_data);
            $this->load->view('js-custom', $this->app_data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->user_model->authenticate($username, $password);

            if ($user) {
                if($user['id_akses'] == 'A3'){
                    $session_data = [
                        'user_id' => $user['id'],
                        'logged_in' => true,
                    ];
                    $this->session->set_userdata($session_data);
                    redirect('dashboard');
                } else if($user['id_akses'] == 'A4'){
                    $session_data = [
                        'user_id' => $user['id'],
                        'logged_in' => true,
                    ];
                    $this->session->set_userdata($session_data);
                    redirect('dashboard_pm');
                } else {
                    $this->session->set_flashdata('error', 'Invalid user');
                    redirect('auth');
                } 
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('auth');
            }
        }
    }

    public function authenticate($username, $password)
    {
    $this->db->where('username', $username);
    $user = $this->db->get('id_akses')->row_array();

    if ($user) {
        if (password_verify($password, $user['password']) && $user['id_akses'] == 'A3') {
            return $user;
        }
    }
    return false;
    }

    //==================================================================================== LOGOUT

    public function logout()
    {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $timestamp = $this->db->query("SELECT NOW() as timestamp")->row()->timestamp;

        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('logged_in');
        // $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //     <strong>Anda telah logout,  </strong>Terima kasih sudah menggunakan sistem ini
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //     </div>');
        redirect('auth');
    }

    
}