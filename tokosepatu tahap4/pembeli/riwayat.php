<?php
session_start();

require_once __DIR__ . '/../koneksi.php';

/** @var mysqli $conn */

$data = mysqli_query($conn, "
SELECT *
FROM pesanan
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

                <div class="order-card">

                    <div class="top">

                        <div>
                            <div class="order-id">
                                Pesanan #<?= $row['id']; ?>
                            </div>

                            <div class="date">
                                <?= $row['tanggal']; ?>
                            </div>
                        </div>

                        <div>

                            <span class="badge <?= strtolower($row['status']); ?>">
                                <?= $row['status']; ?>
                            </span>

                        </div>

                    </div>

                    <div class="total">
                        Rp <?= number_format($row['total'], 0, ',', '.'); ?>
                    </div>

                    <div class="info">

                        <div>
                            <strong>Metode Pembayaran</strong>
                            <br>
                            <?= $row['pembayaran']; ?>
                        </div>

                        <div>
                            <strong>Status Pesanan</strong>
                            <br>
                            <?= $row['status']; ?>
                        </div>

                    </div>

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