<?php
session_start();
require_once __DIR__ . '/../koneksi.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['id'];

if (!isset($_GET['id'])) {
    header("Location: riwayat.php");
    exit;
}

$id = (int)$_GET['id'];

/* Ambil data pesanan */
$pesanan = mysqli_query($conn, "
SELECT *
FROM pesanan
WHERE id='$id'
AND user_id='$user_id'
");

if (mysqli_num_rows($pesanan) == 0) {
    die("Pesanan tidak ditemukan.");
}

$order = mysqli_fetch_assoc($pesanan);

/* Ambil detail produk */
$detail = mysqli_query($conn, "
SELECT
detail_pesanan.*,
produk.gambar
FROM detail_pesanan
JOIN produk
ON detail_pesanan.produk_id = produk.id
WHERE detail_pesanan.pesanan_id='$id'
");
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Detail Pesanan</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Segoe UI;
        }

        body {
            background: #f5f7fa;
        }

        nav {
            background: #111827;
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
        }

        .logo i {
            color: #3b82f6;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-weight: bold;
        }

        .container {
            width: 95%;
            max-width: 1200px;
            margin: auto;
            padding: 40px 0;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
            margin-bottom: 25px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .info {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .info div {
            background: #f8fafc;
            padding: 15px;
            border-radius: 12px;
        }

        .item {
            display: flex;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            align-items: center;
        }

        .item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 15px;
        }

        .nama {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .harga {
            color: #2563eb;
            font-weight: bold;
        }

        .total {
            text-align: right;
            margin-top: 30px;
            font-size: 30px;
            font-weight: bold;
            color: #2563eb;
        }

        .badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }

        .menunggu {
            background: #fef3c7;
            color: #92400e;
        }

        .diproses {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .dikirim {
            background: #dcfce7;
            color: #166534;
        }

        .selesai {
            background: #ede9fe;
            color: #6d28d9;
        }

        .back {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 22px;
            background: #2563eb;
            color: white;
            border-radius: 10px;
            text-decoration: none;
        }
    </style>

</head>

<body>

    <nav>

        <div class="logo">
            <i class="fa-solid fa-shoe-prints"></i>
            ShoeStore
        </div>

        <div>
            <a href="dashboard.php">Home</a>
            <a href="produk.php">Produk</a>
            <a href="keranjang.php">Keranjang</a>
            <a href="riwayat.php">Riwayat</a>
        </div>

    </nav>

    <div class="container">

        <div class="card">

            <h2>Detail Pesanan</h2>

            <div class="info">

                <div>
                    <b>Kode Pesanan</b><br>
                    <?= $order['kode_pesanan']; ?>
                </div>

                <div>
                    <b>Tanggal</b><br>
                    <?= date("d F Y H:i", strtotime($order['tanggal'])); ?>
                </div>

                <div>
                    <b>Nama</b><br>
                    <?= $order['nama_pelanggan']; ?>
                </div>

                <div>
                    <b>Status</b><br>

                    <span class="badge <?= strtolower($order['status']); ?>">
                        <?= $order['status']; ?>
                    </span>

                </div>

                <div>
                    <b>Pembayaran</b><br>
                    <?= $order['pembayaran']; ?>
                </div>

                <div>
                    <b>Alamat</b><br>
                    <?= $order['alamat']; ?>,
                    <?= $order['kota']; ?>,
                    <?= $order['provinsi']; ?>
                </div>

            </div>

            <?php while ($d = mysqli_fetch_assoc($detail)) { ?>

                <div class="item">

                    <img src="../uploads/<?= $d['gambar']; ?>">

                    <div>

                        <div class="nama">
                            <?= $d['nama_produk']; ?>
                        </div>

                        <div class="harga">
                            Rp <?= number_format($d['harga'], 0, ',', '.'); ?>
                        </div>

                        <p>Jumlah : <?= $d['qty']; ?></p>

                        <p>
                            Subtotal :
                            Rp <?= number_format($d['subtotal'], 0, ',', '.'); ?>
                        </p>

                    </div>

                </div>

            <?php } ?>

            <div class="total">

                Total Pembayaran

                <br>

                Rp <?= number_format($order['total'], 0, ',', '.'); ?>

            </div>

            <a href="riwayat.php" class="back">

                <i class="fa-solid fa-arrow-left"></i>

                Kembali ke Riwayat

            </a>

        </div>

    </div>

</body>

</html>