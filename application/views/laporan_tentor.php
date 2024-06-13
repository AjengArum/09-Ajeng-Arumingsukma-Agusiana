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
    <h4>Data Tentor</h4>
    <table>
        <tr>
            <th>Nama</th>
            <th>Jenjang</th>
            <th>Foto</th>
        </tr>
        <?php foreach ($tentor as $m): ?>
            <tr>
                <td><?php echo $m->nama; ?></td>
                <td><?php echo $m->jenjang; ?></td>
                <td>
                    <img src="<?php echo base_url('assets/file/' . $m->foto); ?>" alt="Foto Tentor">
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
