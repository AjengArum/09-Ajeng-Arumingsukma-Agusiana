<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px; /* Menentukan ukuran maksimum gambar */
            height: auto;
        }
    </style>
</head>
<body>
<h4>Data Absen Tentor</h4>
        <table>
            <tr>
                <th>Tentor</th>
                <th>Tanggal</th>
                <th>Materi</th>
                <th>Bukti</th>
                <th>Status</th>
            </tr>
            <?php foreach ($absen as $m): ?>
                <tr>
                    <td>
                        <?php echo $m->nama; ?>
                    </td>
                    <td>
                        <?php echo $m->tgl_absen; ?>
                    </td>
                    <td>
                        <?php echo $m->materi; ?>
                    </td>
                    <td>
                    <img src="<?php echo base_url('assets/file/' . $m->bukti); ?>" alt="Bukti Absensi">
                    </td>
                    <td>
                        <?php echo $m->status; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

</body>
</html>