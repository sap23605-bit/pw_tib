<?php
session_start();
require_once __DIR__.'/../koneksi.php';

$user_id = $_SESSION['id'];

$data = mysqli_query($conn,"
SELECT *
FROM pesanan
WHERE user_id='$user_id'
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - ShoeStore</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f5f7fa;
        }

        /* NAVBAR */

        nav {
            background: #111827;
            padding: 18px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
        }

        .logo i {
            color: #3b82f6;
        }

        .menu a {
            color: white;
            text-decoration: none;
            margin-left: 25px;
            font-weight: 600;
        }

        .menu a:hover {
            color: #60a5fa;
        }

        /* HEADER */

        .header {
            height: 260px;
            background:
                linear-gradient(rgba(0, 0, 0, .55), rgba(0, 0, 0, .55)),
                url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1600&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }

        .header h1 {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 18px;
            opacity: .9;
        }

        /* CONTENT */

        .container {
            width: 95%;
            max-width: 1300px;
            margin: auto;
            padding: 40px 0;
        }

        .order-card {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
            margin-bottom: 20px;
            transition: .3s;
        }

        .order-card:hover {
            transform: translateY(-5px);
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .order-id {
            font-size: 22px;
            font-weight: bold;
        }

        .date {
            color: #64748b;
        }

        .total {
            font-size: 26px;
            font-weight: bold;
            color: #2563eb;
            margin: 15px 0;
        }

        /* STATUS */

        .badge {
            padding: 10px 18px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
        }

        .menunggu {
            background: #fef3c7;
            color: #92400e;
        }

        .diproses {
            background: #dbeafe;
            color: #1e40af;
        }

        .dikirim {
            background: #dcfce7;
            color: #166534;
        }

        .selesai {
            background: #ede9fe;
            color: #6d28d9;
        }

        /* DETAIL */

        .info {
            display: flex;
            gap: 40px;
            flex-wrap: wrap;
            margin-top: 15px;
            color: #475569;
        }

        .empty {
            background: white;
            padding: 50px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        }

        .empty i {
            font-size: 70px;
            color: #cbd5e1;
            margin-bottom: 20px;
        }

        footer {
            margin-top: 50px;
            background: #111827;
            color: white;
            text-align: center;
            padding: 40px;
        }

        .produk-item {

            display: flex;

            gap: 20px;

            align-items: center;

            padding: 18px 0;

            border-bottom: 1px solid #eee;

            margin-bottom: 20px;

        }

        .produk-item img {

            width: 120px;

            height: 120px;

            object-fit: cover;

            border-radius: 15px;

        }

        .produk-info {

            flex: 1;

        }

        .produk-info h3 {

            margin-bottom: 10px;

            font-size: 22px;

        }

        .produk-info p {

            margin: 6px 0;

            color: #555;

        }

        .alamat {

            background: #f8fafc;

            padding: 15px;

            border-radius: 12px;

            margin-top: 20px;

            margin-bottom: 20px;

            line-height: 1.8;

        }

        .detail-btn {

            display: inline-block;

            padding: 12px 22px;

            background: #2563eb;

            color: white;

            text-decoration: none;

            border-radius: 10px;

            margin-top: 20px;

            font-weight: bold;

        }

        .detail-btn:hover {

            background: #1d4ed8;

        }
    </style>
</head>

<body>

    <nav>

        <div class="logo">
            <i class="fa-solid fa-shoe-prints"></i>
            ShoeStore
        </div>

        <div class="menu">
            <a href="dashboard.php">Home</a>
            <a href="produk.php">Produk</a>
            <a href="keranjang.php">Keranjang</a>
            <a href="riwayat.php">Riwayat</a>
        </div>

    </nav>

    <section class="header">

        <div>
            <h1>Riwayat Pesanan</h1>
            <p>Lihat semua transaksi yang pernah kamu lakukan</p>
        </div>

    </section>

    <div class="container">

        <?php if (mysqli_num_rows($data) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <?php
                $detail = mysqli_query($conn, "
                SELECT
                detail_pesanan.*,
                produk.gambar
                FROM detail_pesanan
                JOIN produk
                ON detail_pesanan.produk_id = produk.id
                WHERE detail_pesanan.pesanan_id = '".$row['id']."'
                ");
                if(!$detail){
                    die(mysqli_error($conn));
                }

                ?>



                <div class="order-card">

                    <div class="top">

                        <div>

                            <div class="order-id">
                                Pesanan #<?= $row['kode_pesanan']; ?>
                            </div>

                            <div class="date">
                                <?= date("d F Y H:i", strtotime($row['tanggal'])); ?>
                            </div>

                        </div>

                        <span class="badge <?= strtolower($row['status']); ?>">
                            <?= $row['status']; ?>
                        </span>

                    </div>

                    <?php
                    while ($d = mysqli_fetch_assoc($detail)) {
                    ?>

                        <div class="produk-item">

                            <img src="../uploads/<?= $d['gambar']; ?>">

                            <div class="produk-info">

                                <h3><?= $d['nama_produk']; ?></h3>

                                <p>

                                    Rp <?= number_format($d['harga'], 0, ',', '.'); ?>

                                </p>

                                <p>

                                    Jumlah :
                                    <?= $d['qty']; ?>

                                </p>

                                <p>

                                    Subtotal :

                                    Rp <?= number_format($d['subtotal'], 0, ',', '.'); ?>

                                </p>

                            </div>

                        </div>

                    <?php } ?>

                    <div class="alamat">

                        <strong>Alamat Pengiriman</strong>

                        <br>

                        <?= $row['alamat']; ?>

                        <br>

                        <?= $row['kota']; ?>,

                        <?= $row['provinsi']; ?>

                        <?= $row['kode_pos']; ?>

                    </div>

                    <div class="info">

                        <div>

                            <strong>Pembayaran</strong>

                            <br>

                            <?= $row['pembayaran']; ?>

                        </div>

                        <div>

                            <strong>Total</strong>

                            <br>

                            Rp <?= number_format($row['total'], 0, ',', '.'); ?>

                        </div>

                    </div>

                    <a
                        href="detail_pesanan.php?id=<?= $row['id']; ?>"
                        class="detail-btn">

                        Lihat Detail

                    </a>

                </div>


            <?php } ?>

        <?php } else { ?>

            <div class="empty">

                <i class="fa-solid fa-box-open"></i>

                <h2>Belum Ada Pesanan</h2>

                <p>
                    Kamu belum pernah melakukan transaksi.
                </p>

            </div>

        <?php } ?>

    </div>

    <footer>

        <h3>ShoeStore</h3>

        <p>
            Belanja sepatu original dengan pengalaman premium.
        </p>

    </footer>

</body>

</html>