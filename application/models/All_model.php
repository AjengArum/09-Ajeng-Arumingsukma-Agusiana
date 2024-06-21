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
        'select' => 'a.id_absensi, a.tanggal, a.materi, a.status, b.username',
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

public function update_tagihan($id_tagihan)
    {
        $this->data->update('tb_tagihan', array('id_tagihan' => $id_tagihan), array('status_tagihan' => 'lunas'));
        return [
            "success" => "true",
            'message' => 'Data tagihan berhasil diupdate'
        ];
    }


    public function absen($id_user, $tanggal, $materi, $status)
    {
        $data = [
            'id_user' => $id_user,
            'tanggal' => $tanggal,
            'materi' => $materi,
            'status' => 'menunggu_validasi'
        ];
        // Insert the data into the database
        $inserted = $this->db->insert('tb_absen', $data);
        if ($inserted) {
            return [
                "success" => true,
                'message' => 'Berhasil melakukan absensi',
                'data' => $data
            ];
        } else {
            return [
                "success" => false,
                'message' => 'Gagal melakukan absensi'
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

}