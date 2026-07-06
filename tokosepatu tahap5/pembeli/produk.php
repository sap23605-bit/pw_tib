<?php
session_start();

require_once __DIR__ . '/../koneksi.php';

/** @var mysqli $conn */

$data = mysqli_query($conn, "
SELECT * FROM produk
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Produk - ShoeStore</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f8fafc;
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
            height: 300px;
            background:
                linear-gradient(rgba(0, 0, 0, .5), rgba(0, 0, 0, .5)),
                url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1400&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 20px;
        }

        /* PRODUK */

        .container {
            width: 95%;
            max-width: 1300px;
            margin: auto;
            padding: 40px 0;
        }

        .judul {
            font-size: 35px;
            margin-bottom: 25px;
            font-weight: bold;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
            transition: .3s;
        }

        .card:hover {
            transform: translateY(-8px);
        }

        .card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .info {
            padding: 20px;
        }

        .nama {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .harga {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }

        .stok {
            color: #64748b;
            margin-bottom: 15px;
        }

        .btn {
            display: block;
            text-align: center;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn:hover {
            background: #1d4ed8;
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
            <a href="keranjang.php">
                <i class="fa-solid fa-cart-shopping"></i>
                Keranjang
            </a>
            <a href="riwayat.php">Riwayat</a>
        </div>

    </nav>

    <section class="header">

        <div>
            <h1>KOLEKSI SEPATU TERBAIK</h1>
            <p>Temukan sepatu original dengan kualitas premium</p>
        </div>

    </section>

    <div class="container">

        <h2 class="judul">
            Produk Terbaru
        </h2>

        <div class="grid">

            <?php while ($row = mysqli_fetch_assoc($data)) { ?>

                <div class="card">

                    <?php if (!empty($row['gambar'])) { ?>

                        <img src="../uploads/<?php echo $row['gambar']; ?>">

                    <?php } else { ?>

                        <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772">

                    <?php } ?>

                    <div class="info">

                        <div class="nama">
                            <?php echo $row['nama']; ?>
                        </div>

                        <div class="harga">
                            Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?>
                        </div>

                        <div class="stok">
                            Stok : <?php echo $row['stok']; ?>
                        </div>

                        <a
                            href="keranjang.php?tambah=<?php echo $row['id']; ?>"
                            class="btn">
                            + Tambah ke Keranjang
                        </a>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

    <footer>

        <h3>ShoeStore</h3>

        <p>
            Belanja sepatu original dengan harga terbaik.
        </p>

    </footer>

</body>

</html>