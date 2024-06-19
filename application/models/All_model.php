<?php

class All_model extends CI_Model
{
    public function get_data()
    {
        $data = $this->db->get('tb_user')->result();
        return $data;
    }

//     public function login($username, $password)
// {
//         $user = $this->db->get_where('tb_user', ['username' => $username, 'password' => $password])->row_array();
//         if ($user !== null) {
//             return [
//                 "success" => true,
//                 'message' => 'Berhasil melakukan login',
//                 'data' => $user
//             ];
//         } else {
//             return [
//                 "success" => false,
//                 'message' => 'Gagal melakukan login',
//                 'data' => $user
//             ];
//         }
// }


    // public function get_pembayaran()
    // {
    //     $query = [
    //         'select' => 'a.id_tagihan, b.nama, a.bulan, a.jumlah, a.status_tagihan',
    //         'from' => 'tb_tagihan a',
    //         'join' => [
    //             'tb_murid b, b.id_murid = a.id_murid'
    //         ]
    //     ];
    //     $result = $this->data->get($query)->result();
    //     echo json_encode($result);
    // }

    public function get_layanan()
    {
        $query = [
            'select' => 'a.id_layanan, b.nama, a.nama_layanan, a.keterangan, a.biaya',
            'from' => 'tb_layanan a',
            'join' => [
                'tb_tentor b, b.id_tentor = a.id_tentor'
            ]
        ];
        $result = $this->data->get($query)->result();
        echo json_encode($result);
    }

    // public function get_rekap()
    // {
    //     $query = [
    //         'select' => 'a.id_rekap, b.nama, a.judul, a.created_at, a.file_name',
    //         'from' => 'tb_rekapabsen a',
    //         'join' => [
    //             'tb_tentor b, b.id_tentor = a.id_tentor'
    //         ]
    //     ];
    //     $result = $this->data->get($query)->result();
    //     echo json_encode($result);
    // }

    public function get_rekap($id_user)
{
    $query = [
        'select' => 'a.id_rekap, b.username, a.judul, a.created_at, a.file_name',
        'from' => 'tb_rekapabsen a',
        'join' => [
            'tb_user b, b.ID = a.id_user'
        ],
        'where' => [
            'a.id_user' => $id_user
        ]
    ];
    $result = $this->data->get($query)->result();
    return $result;
}

public function get_pembayaran($id_user)
{
    $query = [
        'select' => 'a.id_tagihan, b.username, a.bulan, a.jumlah, a.status_tagihan',
        'from' => 'tb_tagihan a',
        'join' => [
            'tb_user b, b.ID = a.id_user',
        ],
        'where' => [
            'a.status_tagihan' => 'lunas',
            'a.id_user' => $id_user
            ]  // Hanya ambil data dengan status belum lunas
    ];
    $result = $this->data->get($query)->result();
    echo json_encode($result);
}


public function get_tentor()
{
    $query = [
        'select' => 'a.id_tentor, b.username, a.nama, a.jenjang, a.foto', 
        'from' => 'tb_tentor a',
        'join' => [
            'tb_user b, b.ID = a.id_user'
        ]
    ];
    $result = $this->data->get($query)->result();
    return $result;
}

public function get_jadwal()
{
    $query = [
        'select' => 'a.id_jadwal, b.nama_layanan, a.hari, a.jam_mulai, a.jam_berakhir',
        'from' => 'tb_jadwal a',
        'join' => [
            'tb_layanan b, b.id_layanan = a.id_layanan'
        ],
    ];
    $result = $this->data->get($query)->result();
    echo json_encode($result);
}

public function get_tagihan($id_user)
{
    $query = [
        'select' => 'a.id_tagihan, b.username, a.bulan, a.jumlah, a.status_tagihan',
        'from' => 'tb_tagihan a',
        'join' => [
            'tb_user b, b.ID = a.id_user',
        ],
        'where' => ['a.status_tagihan' => 'belum lunas',
        'a.id_user' => $id_user 
        ] // Hanya ambil data dengan status belum lunas
    ];
    $result = $this->data->get($query)->result();
    echo json_encode($result);
}

public function get_absen($id_user)
{
    $query = [
        'select' => 'a.id_absensi, a.tgl_absen, a.materi, a.bukti, a.status, b.username',
        'from' => 'tb_absen a',
        'join' => [
            'tb_user b, b.ID = a.id_user'
        ],
        'where' => [
            'a.id_user' => $id_user
        ]
    ];
    $result = $this->data->get($query)->result();
    echo json_encode($result);
}

// public function get_pembayaran()
// {
//     $query = [
//         'select' => 'a.id_tagihan, b.username, a.bulan, a.jumlah, a.status_tagihan',
//         'from' => 'tb_tagihan a',
//         'join' => [
//             'tb_user b, b.ID = a.id_user',
//         ],
//         'where' => ['a.status_tagihan' => 'lunas']  // Hanya ambil data dengan status belum lunas
//     ];
//     $result = $this->data->get($query)->result();
//     echo json_encode($result);
// }

    // public function get_produk_terbaru()
    // {
    //     $query = "
    //         SELECT p.id, p.id_mitra, c.name as id_category, p.nama_produk, p.image, p.type, p.harga, p.stok, p.deskripsi
    //         FROM product p
    //         JOIN category c ON c.id = p.id_category
    //         ORDER BY p.created_date DESC
    //         LIMIT 3
    //     ";
    //     $data = $this->db->query($query)->result();
    //     $modifiedData = $this->modify_data($data, 'produk');
    //     return $modifiedData;
    // }

    // public function get_produk_terlaris()
    // {
    //     $query = "
    //         SELECT p.id, p.id_mitra, c.name as id_category, p.nama_produk, p.image, p.type, p.harga, p.stok, p.deskripsi
    //         FROM product p
    //         JOIN category c ON c.id = p.id_category
    //         ORDER BY p.created_date DESC
    //         LIMIT 3
    //     ";
    //     $data = $this->db->query($query)->result();
    //     $modifiedData = $this->modify_data($data, 'produk');
    //     return $modifiedData;
    // }

    // public function get_category()
    // {
    //     $data = $this->db->get('category')->result();
    //     $modifiedData = $this->modify_data($data, 'category');
    //     return $modifiedData;
    // }

    // public function get_detail_produk($id)
    // {
    //     $query = "
    //         SELECT p.id, p.id_mitra, c.name as id_category, p.nama_produk, p.image, p.type, p.harga, p.stok, p.deskripsi
    //         FROM product p
    //         JOIN category c ON c.id = p.id_category
    //         WHERE p.id = $id
    //     ";
    //     $data = $this->db->query($query)->result();
    //     $modifiedData = $this->modify_data($data, 'produk');
    //     return $modifiedData;
    // }

    // public function insert_murid($id_user, $id_layanan, $asal_sekolah, $kelas)
    // {
    //     // $cekData = $this->db->get_where('tb_murid', ['id_user' => $id_user, 'id_layanan' => $id_layanan])->row();
    //     // if ($cekData) {
    //     //     $this->db->where(['id_user' => $id_user, 'id_layanan' => $id_layanan])
    //     //         ->update('tb_murid', [
    //     //             'qty' => $cekData->qty + $qty,
    //     //             'updated_date' => date('Y-m-d H:i:s')
    //     //         ]);
    //     // } else {
    //         $data = [
    //             'id_user' => $id_user,
    //             'id_layanan' => $id_layanan,
    //             'asal_sekolah' => $asal_sekolah,
    //             'kelas' => $kelas
    //         ];
    //         $this->db->insert('tb_murid', $data);
        
    //     return [
    //         "success" => "true",
    //         'message' => 'Berhasil melakukan pendaftaran'
    //     ];
    // }

    // public function insert_murid($id_user, $id_layanan, $nama, $asal_sekolah, $kelas)
    // {
    //     $data = [
    //         'id_user' => $id_user,
    //         'id_layanan' => $id_layanan,
    //         'nama' => $nama,
    //         'asal_sekolah' => $asal_sekolah,
    //         'kelas' => $kelas
    //     ];
    //     $inserted = $this->db->insert('tb_murid', $data);

    //     if ($inserted) {
    //         return [
    //             "success" => true,
    //             'message' => 'Berhasil melakukan pendaftaran',
    //             'data' => $data
    //         ];
    //     } else {
    //         return [
    //             "success" => false,
    //             'message' => 'Gagal melakukan pendaftaran'
    //         ];
    //     }
    // }

    // public function absen($id_user, $tgl_absen, $materi, $bukti, $status)
    // {
    //     // Handle file upload
    //     $bukti = null;
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
    //             return [
    //                 "success" => false,
    //                 'message' => 'Gagal mengunggah foto: ' . $this->upload->display_errors()
    //             ];
    //         }
    //     }

    //     $data = [
    //         'id_user' => $id_user,
    //         'tgl_absen' => $tgl_absen,
    //         'materi' => $materi,
    //         'bukti' => $bukti,
    //         'status' => $status
    //     ];

    //     $this->db->insert('tb_absen', $data);

    //     if ($this->db->affected_rows() > 0) {
    //         return ["success" => true];
    //     } else {
    //         return ["success" => false];
    //     }
    // }

    public function absen($id_user, $tgl_absen, $materi, $bukti, $status)
    {
        // Check if the username or email already exists
        $existingMurid = $this->db->get_where('tb_absen', ['id_user' => $id_user])->row_array();
        if ($existingMurid) {
            return [
                "success" => false,
                'message' => 'id_user already exists'
            ];
        }
        $data = [
            'id_user' => $id_user,
            'tgl_absen' => $tgl_absen,
            'materi' => $materi,
            'bukti' => $bukti,
            'status' => $status
        ];
        // Insert the data into the database
        $inserted = $this->db->insert('tb_absen', $data);
        if ($inserted) {
            return [
                "success" => true,
                'message' => 'Berhasil melakukan pendaftaran',
                'data' => $data
            ];
        } else {
            return [
                "success" => false,
                'message' => 'Gagal melakukan pendaftaran'
            ];
        }
    }

    public function daftar($id_user, $id_layanan, $nama, $asal_sekolah)
    {
        // Check if the username or email already exists
        $existingMurid = $this->db->get_where('tb_murid', ['id_user' => $id_user])->row_array();
        if ($existingMurid) {
            return [
                "success" => false,
                'message' => 'id_user already exists'
            ];
        }
        $data = [
            'id_user' => $id_user,
            'nama' => $nama,
            'asal_sekolah' => $asal_sekolah,
            'id_layanan' => $id_layanan
        ];
        // Insert the data into the database
        $inserted = $this->db->insert('tb_murid', $data);
        if ($inserted) {
            return [
                "success" => true,
                'message' => 'Berhasil melakukan pendaftaran',
                'data' => $data
            ];
        } else {
            return [
                "success" => false,
                'message' => 'Gagal melakukan pendaftaran'
            ];
        }
    }

    public function register($id_akses, $username, $alamat, $telepon, $email, $password)
    {
        // Check if the username or email already exists
        $existingUser = $this->db->get_where('tb_user', ['username' => $username])->row_array();
        if ($existingUser) {
            return [
                "success" => false,
                'message' => 'Username already exists'
            ];
        }
        $existingEmail = $this->db->get_where('tb_user', ['email' => $email])->row_array();
        if ($existingEmail) {
            return [
                "success" => false,
                'message' => 'Email already exists'
            ];
        }
        // Prepare the data for insertion
        $data = [
            'id_akses' => $id_akses,
            'username' => $username,
            'alamat' => $alamat,
            'telepon' => $telepon,
            'email' => $email,
            'password' => $password
        ];
        // Insert the data into the database
        $inserted = $this->db->insert('tb_user', $data);
        if ($inserted) {
            return [
                "success" => true,
                'message' => 'Berhasil melakukan registrasi',
                'data' => $data
            ];
        } else {
            return [
                "success" => false,
                'message' => 'Gagal melakukan registrasi'
            ];
        }
    }

    public function login($username, $password)
{
    // Check if the username exists
    $user = $this->db->get_where('tb_user', ['username' => $username])->row_array();

    if ($user) {
        // Verify the password by directly comparing the plain text passwords
        if ($password === $user['password']) {
            // Password is correct, check the id_akses
            if ($user['id_akses'] == 'A1') {
                return [
                    "success" => true,
                    "message" => "Login successful for A1",
                    "data" => $user,
                    "access_type" => "A1"
                ];
            } elseif ($user['id_akses'] == 'A2') {
                return [
                    "success" => true,
                    "message" => "Login successful for A2",
                    "data" => $user,
                    "access_type" => "A2"
                ];
            } else {
                // Handle other access types if needed
                return [
                    "success" => false,
                    "message" => "Invalid access type"
                ];
            }
        } else {
            // Password is incorrect
            return [
                "success" => false,
                "message" => "Invalid password"
            ];
        }
    } else {
        // Username not found
        return [
            "success" => false,
            "message" => "Invalid username"
        ];
    }
}

    


    // public function get_keranjang()
    // {
    //     $query = "
    //     SELECT k.id, p.id AS product_id, k.user_id, u.name AS nama_user, c.name AS nama_category,
    //     p.id_mitra, (SELECT um.name FROM st_user um WHERE um.id = p.id_mitra) AS nama_mitra,
    //     (SELECT um.image FROM st_user um WHERE um.id = p.id_mitra) AS image_mitra,
    //     k.qty, p.nama_produk, p.image, p.type, p.harga, p.stok, p.deskripsi
    //     FROM keranjang k
    //     JOIN product p ON k.product_id = p.id
    //     JOIN st_user u ON u.id = k.user_id
    //     JOIN category c ON c.id = p.id_category
    //     WHERE k.user_id = 1
    // ";
    //     $data = $this->db->query($query)->result();
    //     $modifiedData = $this->modify_data($data, 'produk');

    //     $result = [];
    //     foreach ($modifiedData as $key => $value) {
    //         $mitraFound = false;
    //         foreach ($result as &$item) {
    //             if ($item["id_mitra"] == $value->id_mitra) {
    //                 $item["produk"][] = [
    //                     "id" => $value->id,
    //                     "id_mitra" => $value->id_mitra,
    //                     "id_product" => $value->product_id,
    //                     "nama_produk" => $value->nama_produk,
    //                     "image" => $value->image,
    //                     "type" => $value->type,
    //                     "harga" => $value->harga,
    //                     "qty" => $value->qty,
    //                     "deskripsi" => $value->deskripsi,
    //                     "gambar_url" => $value->gambar_url,
    //                 ];
    //                 $mitraFound = true;
    //                 break;
    //             }
    //         }
    //         if (!$mitraFound) {
    //             $result[] = [
    //                 "id" => $value->id,
    //                 "id_mitra" => $value->id_mitra,
    //                 "nama_mitra" => $value->nama_mitra,
    //                 "image_mitra" => base_url('assets/image/user/' . $value->image_mitra),
    //                 "produk" => [
    //                     [
    //                         "id" => $value->id,
    //                         "id_mitra" => $value->id_mitra,
    //                         "id_product" => $value->product_id,
    //                         "nama_produk" => $value->nama_produk,
    //                         "image" => $value->image,
    //                         "type" => $value->type,
    //                         "harga" => $value->harga,
    //                         "qty" => $value->qty,
    //                         "deskripsi" => $value->deskripsi,
    //                         "gambar_url" => $value->gambar_url,
    //                     ]
    //                 ]
    //             ];
    //         }
    //     }
    //     return $result;
    //  }
    // public function get_mitra()
    // {
    //     $data = $this->db->get_where('st_user', ['id_credential' => 2, 'is_aktif' => 1])->result();
    //     $modifiedData = $this->modify_data($data, 'user');
    //     return $modifiedData;
    // }

    // public function delete_keranjang($id)
    // {
    //     $this->db->delete('keranjang', ['id' => $id]);
    //     return [
    //         "success" => "true",
    //         'message' => 'Data keranjang berhasil dihapus'
    //     ];
    // }

    // public function update_qty_keranjang($id, $qty)
    // {
    //     $this->db->update('keranjang', ['qty' => $qty], ['id' => $id]);
    //     return [
    //         "success" => "true",
    //         'message' => 'Data keranjang berhasil diupdate'
    //     ];
    // }

    // private function modify_data($data, $type)
    // {
    //     $modifiedData = [];
    //     foreach ($data as $item) {
    //         if ($type == 'produk') {
    //             $namaGambar = $item->image;
    //             $gambarUrl = base_url('assets/image/produk/' . $namaGambar);
    //             $item->gambar_url = $gambarUrl;
    //         } elseif ($type == 'category') {
    //             $namaGambar = $item->image;
    //             $gambarUrl = base_url('assets/image/category/' . $namaGambar);
    //             $item->gambar_url = $gambarUrl;
    //         } elseif ($type == 'user') {
    //             $namaGambar = $item->image;
    //             $gambarUrl = base_url('assets/image/user/' . $namaGambar);
    //             $item->gambar_url = $gambarUrl;
    //         }
    //         $modifiedData[] = $item;
    //     }
    //     return $modifiedData;
    // }
}