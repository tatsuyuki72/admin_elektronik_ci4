<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Produk</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .sub {
            text-align: center;
            margin-bottom: 20px;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 6px;
        }

        table th {
            background-color: #f0f0f0;
            text-align: center;
        }

        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>

<!-- ================= HEADER ================= -->
<h1>LAPORAN DATA PRODUK</h1>

<div class="sub">
    Sistem Admin Penjualan Elektronik<br>
    Tanggal Cetak: <?= $tanggal ?>
</div>

<!-- ================= TABEL DATA ================= -->
<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="25%">Kategori</th>
            <th width="40%">Produk</th>
            <th width="30%">Harga</th>
        </tr>
    </thead>

    <tbody>
        <?php 
        $totalHarga = 0; 
        ?>

        <?php if (!empty($produk)) : ?>
            <?php $no = 1; foreach ($produk as $p) : 
                $totalHarga += $p['harga'];
            ?>
            <tr>
                <td align="center"><?= $no++ ?></td>
                <td><?= esc($p['kategori']) ?></td>
                <td><?= esc($p['produk']) ?></td>
                <td align="right">
                    Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                </td>
            </tr>
            <?php endforeach ?>

            <!-- ================= TOTAL ================= -->
            <tr class="total-row">
                <td colspan="3" align="right">Total</td>
                <td align="right">
                    Rp <?= number_format($totalHarga, 0, ',', '.') ?>
                </td>
            </tr>

        <?php else : ?>
            <tr>
                <td colspan="4" align="center">
                    Data laporan belum tersedia
                </td>
            </tr>
        <?php endif ?>
    </tbody>
</table>

<!-- ================= FOOTER ================= -->
<div class="footer">
    Mengetahui,<br><br><br>
    <strong>Admin</strong>
</div>

</body>
</html>
