<?php
include 'koneksi.php';

$kategori = "";

if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
}

if ($kategori != "") {

    $produk = mysqli_query($conn, "
        SELECT *
        FROM produk
        WHERE kategori = '$kategori'
        ORDER BY id DESC
    ");
} else {

    $produk = mysqli_query($conn, "
        SELECT *
        FROM produk
        ORDER BY id DESC
        LIMIT 8
    ");
}
?>

$jumlahRunning = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM produk WHERE kategori='Running'"));

$jumlahSneakers = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM produk WHERE kategori='Sneakers'"));

$jumlahBasket = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM produk WHERE kategori='Basket'"));

$jumlahTraining = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM produk WHERE kategori='Training'"));

$jumlahLifestyle = mysqli_num_rows(mysqli_query($conn,"SELECT id FROM produk WHERE kategori='Lifestyle'"));

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ShoeStore - Step Into Style</title>

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
            position: sticky;
            top: 0;
            z-index: 1000;

            background: white;

            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 18px 60px;

            box-shadow: 0 2px 15px rgba(0, 0, 0, .08);
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
            color: #111827;
        }

        .menu a {
            text-decoration: none;
            color: #111827;
            margin-left: 25px;
            font-weight: 600;
            transition: .3s;
        }

        .menu a:hover {
            color: #2563eb;
        }

        /* HERO */

        .hero {

            height: 90vh;

            background:
                linear-gradient(rgba(0, 0, 0, .45),
                    rgba(0, 0, 0, .45)),

                url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1400&q=80');

            background-size: cover;
            background-position: center;

            display: flex;
            justify-content: center;
            align-items: center;

            text-align: center;
            color: white;
        }

        .hero-content h1 {
            font-size: 70px;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 22px;
            margin-bottom: 30px;
        }

        .btn {
            background: #2563eb;
            color: white;

            padding: 15px 30px;

            border-radius: 10px;
            text-decoration: none;

            font-weight: bold;
        }

        /* ==========================
   KATEGORI MODERN
========================== */

        .kategori {

            padding: 70px 0;

        }

        .kategori h2 {

            text-align: center;

            font-size: 40px;

            margin-bottom: 15px;

        }

        .kategori p {

            text-align: center;

            color: #666;

            margin-bottom: 40px;

        }

        .kategori-list {

            display: flex;

            justify-content: center;

            gap: 20px;

            overflow-x: auto;

            padding-bottom: 15px;

            scrollbar-width: none;

        }

        .kategori-list::-webkit-scrollbar {

            display: none;

        }

        .box {

            background: white;

            color: #111827;

            text-decoration: none;

            min-width: 170px;

            padding: 22px;

            border-radius: 18px;

            text-align: center;

            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);

            transition: .35s;

            font-weight: bold;

        }

        .box:hover {

            transform: translateY(-8px);

            box-shadow: 0 20px 35px rgba(0, 0, 0, .15);

        }

        .box.active {

            background: #2563eb;

            color: white;

        }

        .box span {

            display: block;

            margin-top: 8px;

            font-size: 13px;

            opacity: .8;

        }

        /* PRODUK */

        .container {
            width: 95%;
            max-width: 1300px;
            margin: auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 35px;
        }

        .produk-grid {
            display: grid;
            grid-template-columns:
                repeat(auto-fit, minmax(260px, 1fr));

            gap: 25px;
        }

        .card {

            position: relative;

            overflow: hidden;

            background: white;

            border-radius: 20px;

            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);

            transition: .35s;

        }

        .badge-kategori {
            position: absolute;
            top: 15px;
            left: 15px;

            background: #2563eb;
            color: white;

            padding: 8px 15px;

            border-radius: 30px;

            font-size: 13px;
            font-weight: bold;

            z-index: 10;

            box-shadow: 0 5px 15px rgba(37, 99, 235, .3);
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card {
            overflow: hidden;
            border-radius: 20px;
            background: #fff;
            transition: .35s;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }

        .card:hover {
            transform: translateY(-8px);
        }

        .card img {

            width: 100%;
            height: 280px;

            object-fit: contain;

            background: #f8fafc;

            padding: 20px;

            transition: .4s;
        }

        .card:hover img {

            transform: scale(1.08);

        }

        .card-body {

            padding: 22px;

        }

        .card-body h3 {

            font-size: 22px;
            margin-bottom: 12px;

        }

        .harga {

            color: #2563eb;
            font-size: 28px;
            font-weight: bold;

            margin: 15px 0;

        }

        .stok {

            color: #666;
            margin-bottom: 20px;

        }

        .btn-detail {

            display: block;

            text-align: center;

            padding: 15px;

            background: #111827;

            color: white;

            text-decoration: none;

            border-radius: 12px;

            font-weight: bold;

            transition: .3s;

        }

        .btn-detail:hover {

            background: #2563eb;

        }

        /* PROMO */

        .promo {
            margin-top: 70px;
            margin-bottom: 70px;

            background: #111827;
            color: white;

            padding: 60px;

            text-align: center;
        }

        .promo h2 {
            font-size: 45px;
            margin-bottom: 15px;
        }

        /* FOOTER */

        footer {
            background: #111827;
            color: white;

            padding: 50px;
            margin-top: 70px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns:
                repeat(auto-fit, minmax(250px, 1fr));

            gap: 30px;
        }

        footer h3 {
            margin-bottom: 15px;
        }

        /* RESPONSIVE */

        @media(max-width:768px) {

            nav {
                padding: 15px;
                flex-direction: column;
                gap: 10px;
            }

            .hero-content h1 {
                font-size: 40px;
            }

            .hero-content p {
                font-size: 18px;
            }

        }
    </style>
</head>

<body>

    <!-- NAVBAR -->

    <nav>

        <div class="logo">
            👟 ShoeStore
        </div>

        <div class="menu">

            <a href="index.php">Home</a>

            <a href="produk.php">Produk</a>

            <a href="tentang.php">Tentang</a>

            <a href="kontak.php">Kontak</a>

            <a href="login.php">Login</a>

            <a href="register.php">Register</a>

        </div>

    </nav>

    <!-- HERO -->

    <section class="hero">

        <div class="hero-content">

            <h1>STEP INTO STYLE</h1>

            <p>
                Temukan koleksi sepatu terbaru dengan kualitas premium
            </p>

            <a href="produk.php" class="btn">
                BELANJA SEKARANG
            </a>

        </div>

    </section>

    <!-- KATEGORI -->

    <section class="kategori">

        <h2>Kategori Populer</h2>

        <p>Pilih kategori favoritmu</p>

        <div class="kategori-list">

            <a href="index.php#produk"

                class="box <?= $kategori == '' ? 'active' : '' ?>">

                🔥 Semua

                <span><?= mysqli_num_rows(mysqli_query($conn, "SELECT id FROM produk")) ?> Produk</span>

            </a>

            <a href="index.php?kategori=Running#produk"

                class="box <?= $kategori == 'Running' ? 'active' : '' ?>">

                🏃 Running

                <span><?= $jumlahRunning ?> Produk</span>

            </a>

            <a href="index.php?kategori=Sneakers#produk"

                class="box <?= $kategori == 'Sneakers' ? 'active' : '' ?>">

                👟 Sneakers

                <span><?= $jumlahSneakers ?> Produk</span>

            </a>

            <a href="index.php?kategori=Basket#produk"

                class="box <?= $kategori == 'Basket' ? 'active' : '' ?>">

                🏀 Basket

                <span><?= $jumlahBasket ?> Produk</span>

            </a>

            <a href="index.php?kategori=Training#produk"

                class="box <?= $kategori == 'Training' ? 'active' : '' ?>">

                💪 Training

                <span><?= $jumlahTraining ?> Produk</span>

            </a>

            <a href="index.php?kategori=Lifestyle#produk"

                class="box <?= $kategori == 'Lifestyle' ? 'active' : '' ?>">

                ✨ Lifestyle

                <span><?= $jumlahLifestyle ?> Produk</span>

            </a>

        </div>

    </section>

    <!-- PRODUK -->

    <div class="container">

        <h2 class="section-title">

            <?= $kategori == '' ? 'Produk Unggulan' : $kategori ?>

        </h2>

        <p style="text-align:center;margin-bottom:40px;color:#64748b;">

            Menampilkan

            <strong>

                <?= mysqli_num_rows($produk); ?>

            </strong>

            Produk

        </p>

        <?php mysqli_data_seek($produk, 0); ?>

        <div class="produk-grid" id="produk">

            <?php while ($row = mysqli_fetch_assoc($produk)): ?>

                <div class="card">
                    <div class="badge-kategori">
                        <?= $row['kategori']; ?>
                    </div>

                    <?php if (!empty($row['gambar'])): ?>

                        <img src="uploads/<?= $row['gambar']; ?>">

                    <?php else: ?>

                        <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772">

                    <?php endif; ?>

                    <div class="card-body">

                        <h3><?= $row['nama']; ?></h3>

                        <div class="harga">
                            Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                        </div>

                        <div class="stok">
                            Stok: <?= $row['stok']; ?>
                        </div>

                        <a
                            href="detail_produk.php?id=<?= $row['id']; ?>"
                            class="btn-detail">
                            Lihat Detail
                        </a>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>

    </div>

    <!-- PROMO -->

    <section class="promo">

        <h2>DISKON HINGGA 50%</h2>

        <p>
            Promo spesial koleksi terbaru tahun 2026
        </p>

    </section>

    <!-- FOOTER -->

    <footer>

        <div class="footer-grid">

            <div>

                <h3>👟 ShoeStore</h3>

                <p>
                    Toko sepatu online dengan produk original dan berkualitas.
                </p>

            </div>

            <div>

                <h3>Kategori</h3>

                <p>Running</p>
                <p>Sneakers</p>
                <p>Basket</p>
                <p>Lifestyle</p>

            </div>

            <div>

                <h3>Kontak</h3>

                <p>WhatsApp: 08xxxxxxxxxx</p>

                <p>Email: admin@tokosepatu.com</p>

                <p>Instagram: @shoestore</p>

            </div>

        </div>

    </footer>

</body>

</html>