<?php

use chriskacerguis\RestServer\RestController;

require APPPATH . '/libraries/RestController.php';

class Manage_all extends RestController
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

    // public function login_post()
    // {
    //     $username = $this->post('username');
    //     $password = $this->post('password');
    //     $this->response($this->all->login($username, $password), RestController::HTTP_OK);
    // }

    // public function get_pembayaran_get($id_user)
    // {
    //     $this->response($this->all->get_pembayaran(), RestController::HTTP_OK);
    // }
    
    public function edit_tagihan_post($id)
{
    // $id_tagihan = $this->input->get('id_tagihan');

    $result = $this->all->update_tagihan($id);

    if ($result["success"]) {
        $this->response($result, RestController::HTTP_OK);
    } else {
        $this->response($result, RestController::HTTP_INTERNAL_SERVER_ERROR);
    }
}

    public function get_pembayaran_get($id_user)
    {
        $result = $this->all->get_pembayaran($id_user);
        $this->response($result, RestController::HTTP_OK);
    }

    // public function get_pembayaran_get()
    // {
    //     $this->response($this->all->get_pembayaran(), RestController::HTTP_OK);
    // }

    public function get_tagihan_get($id_user)
    {
        $result = $this->all->get_tagihan($id_user);
        $this->response($result, RestController::HTTP_OK);
    }

    public function get_layanan_get()
    {
        $this->response($this->all->get_layanan(), RestController::HTTP_OK);
    }

    // public function get_rekap_get()
    // {
    //     $this->response($this->all->get_rekap(), RestController::HTTP_OK);
    // }

    public function get_rekap_get($id_user)
    {
    $result = $this->all->get_rekap($id_user);
    $this->response($result, RestController::HTTP_OK);
    }

    public function get_tentor_get()
    {
        $this->response($this->all->get_tentor(), RestController::HTTP_OK);
    }


    public function kelola_android()
    {
        $this->response($this->all->get_layanan(), RestController::HTTP_OK);
    }

    public function get_jadwal_get()
    {
        $this->response($this->all->get_jadwal(), RestController::HTTP_OK);
    }

    public function get_absen_get($id_user)
    {
        $result = $this->all->get_absen($id_user);
        $this->response($result, RestController::HTTP_OK);
    }

    // public function get_produk_terbaru_get()
    // {
    //     $this->response($this->all->get_produk_terbaru(), RestController::HTTP_OK);
    // }

    // public function get_produk_terlaris_get()
    // {
    //     $this->response($this->all->get_produk_terlaris(), RestController::HTTP_OK);
    // }

    // public function get_category_get()
    // {
    //     $this->response($this->all->get_category(), RestController::HTTP_OK);
    // }

    // public function get_detail_produk_get($id)
    // {
    //     $this->response($this->all->get_detail_produk($id), RestController::HTTP_OK);
    // }

    // public function insert_keranjang_post()
    // {
    //     $product_id = $this->post('product_id');
    //     $user_id = $this->post('user_id');
    //     $qty = $this->post('qty');
    //     $price = $this->post('price');
    //     $this->response($this->all->insert_keranjang($product_id, $user_id, $qty, $price), RestController::HTTP_OK);
    // }

    // public function insert_murid_post()
    // {
    //    // $id_murid = $this->post('id_murid');
    //     $id_user = $this->post('id_user');
    //     $id_layanan = $this->post('id_layanan');
    //     $asal_sekolah = $this->post('asal_sekolah');
    //     $kelas = $this->post('kelas');
    //     $this->response($this->all->insert_murid($id_user, $id_layanan, $asal_sekolah, $kelas), RestController::HTTP_OK);
    // }

    public function insert_murid_post()
{
    $id_user = $this->input->post('id_user');
    $id_layanan = $this->input->post('id_layanan');
    $nama = $this->input->post('nama');
    $asal_sekolah = $this->input->post('asal_sekolah');
    $kelas = $this->input->post('kelas');

    $result = $this->all->daftar($id_user, $id_layanan, $nama, $asal_sekolah, $kelas);

    if ($result["success"]) {
        $this->response($result, RestController::HTTP_OK);
    } else {
        $this->response($result, RestController::HTTP_INTERNAL_SERVER_ERROR);
    }
}



// public function absen_post()
// {
//     $id_user = $this->input->post('id_user');
//     $tgl_absen = $this->input->post('tgl_absen');
//     $materi = $this->input->post('materi');
//     $bukti = null;
//     $status = 'menunggu_validasi';

//     // Handle file upload
//     if (!empty($_FILES['bukti']['name'])) {
//         $config['upload_path'] = './assets/file/';
//         $config['allowed_types'] = 'jpeg|png|jpg|gif';
//         $config['max_size'] = 2048;
//         $config['file_name'] = time();

//         $this->load->library('upload', $config);

//         if ($this->upload->do_upload('bukti')) {
//             $uploadData = $this->upload->data();
//             $bukti = 'assets/file/' . $uploadData['file_name'];
//         } else {
//             $this->response([
//                 "success" => false,
//                 'message' => 'Gagal mengunggah foto: ' . $this->upload->display_errors()
//             ], RestController::HTTP_INTERNAL_SERVER_ERROR);
//             return;
//         }
//     }

//     $result = $this->all->absen($id_user, $tgl_absen, $materi, $bukti, $status);

//     if ($result["success"]) {
//         $this->response($result, RestController::HTTP_OK);
//     } else {
//         $this->response($result, RestController::HTTP_INTERNAL_SERVER_ERROR);
//     }
// }


public function absen_post()
{
    $id_user = $this->input->post('id_user');
    $tanggal = $this->input->post('tanggal');
    $materi = $this->input->post('materi');
    $status = 'menunggu_validasi';

    $result = $this->all->absen($id_user, $tanggal, $materi, $status);

    if ($result["success"]) {
        $this->response($result, RestController::HTTP_OK);
    } else {
        $this->response($result, RestController::HTTP_INTERNAL_SERVER_ERROR);
    }
}

public function daftar_post()
{
    $id_user = $this->input->post('id_user');
    $id_layanan = $this->input->post('id_layanan');
    $nama = $this->input->post('nama');
    $asal_sekolah = $this->input->post('asal_sekolah');

    $result = $this->all->daftar($id_user, $id_layanan, $nama, $asal_sekolah);

    if ($result["success"]) {
        $this->response($result, RestController::HTTP_OK);
    } else {
        $this->response($result, RestController::HTTP_INTERNAL_SERVER_ERROR);
    }
}

public function register_post()
{
    // Get the POST data
    $id_akses = 'A1'; // Assuming this value is fixed
    $username = $this->input->post('username');
    $alamat = $this->input->post('alamat');
    $telepon = $this->input->post('telepon');
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    // Call the register method to insert data into the database
    $result = $this->all->register($id_akses, $username, $alamat, $telepon, $email, $password);

    // Check the result and respond accordingly
    if ($result["success"]) {
        $this->response($result, RestController::HTTP_OK);
    } else {
        $this->response($result, RestController::HTTP_INTERNAL_SERVER_ERROR);
    }
}

public function login_post()
{
    // Get the POST data
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    // Call the login method to authenticate the user
    $result = $this->all->login($username, $password);

    // Check the result and respond accordingly
    if ($result["success"]) {
        if ($result["access_type"] == "A1") {
            $this->response([
                "success" => true,
                "message" => "Login successful for A1",
                "data" => $result["data"]
            ], RestController::HTTP_OK);
        } elseif ($result["access_type"] == "A2") {
            $this->response([
                "success" => true,
                "message" => "Login successful for A2",
                "data" => $result["data"]
            ], RestController::HTTP_OK);
        }
    } else {
        $this->response($result, RestController::HTTP_UNAUTHORIZED);
    }
}






// Android
// ==============================================
// public function register()
// {
//     //$ID = $this->input->get('ID');
//     $id_akses = 'A3';
//     $username = $this->input->get('username');
//     $alamat = $this->input->get('alamat');
//     $telepon = $this->input->get('telepon');
//     $email = $this->input->get('email');
//     $password = $this->input->get('password');
//     $result = $this->all->insert_user($id_akses, $username, $alamat, $telepon, $email, $password);

//     if ($result["success"]) {
//         $this->response($result, RestController::HTTP_OK);
//     } else {
//         $this->response($result, RestController::HTTP_INTERNAL_SERVER_ERROR);
//     }
// }

// URL yang benar:
// http://localhost/TA_1/api/Manage_all/insert_murid_post



    // public function get_keranjang_get()
    // {
    //     $this->response($this->all->get_keranjang(), RestController::HTTP_OK);
    // }

    // public function get_mitra_get()
    // {
    //     $this->response($this->all->get_mitra(), RestController::HTTP_OK);
    // }

    // public function delete_keranjang_delete($id)
    // {
    //     $this->response($this->all->delete_keranjang($id), RestController::HTTP_OK);
    // }

    // public function update_qty_keranjang_put($id)
    // {
    //     $qty = $this->put('qty');
    //     $this->response($this->all->update_qty_keranjang($id, $qty), RestController::HTTP_OK);
    // }
}
