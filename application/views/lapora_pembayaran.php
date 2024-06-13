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
<h4>Daftar Tagihan</h4>
        <table>
            <tr>
                <th>Murid</th>
                <th>Bulan</th>
                <th>Jumlah Sekolah</th>
                <th>Status</th>
            </tr>
            <?php foreach ($murid as $m): ?>
                <tr>
                    <td>
                        <?php echo $m->nama; ?>
                    </td>
                    <td>
                        <?php echo $m->bulan; ?>
                    </td>
                    <td>
                        <?php echo $m->jumlah; ?>
                    </td>
                    <td>
                        <?php echo $m->status_tagihan; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

</body>
</html>