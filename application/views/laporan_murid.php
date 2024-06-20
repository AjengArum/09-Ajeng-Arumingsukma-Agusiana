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
    </style>
</head>
<body>
<h4>Data Murid</h4>
        <table>
            <tr>
                <th>Nama</th>
                <th>layanan</th>
                <th>Asal Sekolah</th>
            </tr>
            <?php foreach ($murid as $m): ?>
                <tr>
                    <td>
                        <?php echo $m->nama; ?>
                    </td>
                    <td>
                        <?php echo $m->nama_layanan; ?>
                    </td>
                    <td>
                        <?php echo $m->asal_sekolah; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

</body>
</html>