<?php
include 'koneksi.php';

$cari = '';

if (isset($_GET['cari'])) {
    $cari = mysqli_real_escape_string($conn, $_GET['cari']);

    $produk = mysqli_query($conn, "
    SELECT * FROM produk
    WHERE nama LIKE '%$cari%'
    ORDER BY id DESC
    ");
} else {

    $produk = mysqli_query($conn, "
    SELECT * FROM produk
    ORDER BY id DESC
    ");
}
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
            background: white;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 15px rgba(0, 0, 0, .08);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
            color: #111827;
        }

        .logo i {
            color: #2563eb;
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

        /* HEADER */

        .header {
            height: 350px;

            background:
                linear-gradient(rgba(0, 0, 0, .55),
                    rgba(0, 0, 0, .55)),

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
            font-size: 55px;
            margin-bottom: 15px;
        }

        .header p {
            font-size: 20px;
        }

        /* CONTAINER */

        .container {
            width: 95%;
            max-width: 1300px;
            margin: auto;
            padding: 50px 0;
        }

        /* SEARCH */

        .search-box {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 35px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
        }

        .search-box form {
            display: flex;
            gap: 10px;
        }

        .search-box input {
            flex: 1;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .search-box button {
            padding: 14px 25px;
            background: #2563eb;
            border: none;
            color: white;
            border-radius: 10px;
            cursor: pointer;
        }

        /* PRODUK GRID */

        .produk-grid {

            display: grid;

            grid-template-columns:
                repeat(auto-fit, minmax(280px, 1fr));

            gap: 25px;

        }

        .card {

            background: white;

            border-radius: 20px;

            overflow: hidden;

            box-shadow:
                0 5px 20px rgba(0, 0, 0, .08);

            transition: .3s;

        }

        .card:hover {
            transform: translateY(-8px);
        }

        .card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
        }

        .card-body {
            padding: 20px;
        }

        .card-body h3 {
            font-size: 22px;
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
            margin-bottom: 20px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn {
            flex: 1;
            text-align: center;
            padding: 12px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
        }

        .detail {
            background: #111827;
            color: white;
        }

        .keranjang {
            background: #2563eb;
            color: white;
        }

        /* KOSONG */

        .kosong {
            text-align: center;
            padding: 50px;
            background: white;
            border-radius: 15px;
        }

        /* FOOTER */

        footer {
            background: #111827;
            color: white;
            margin-top: 60px;
            padding: 50px;
            text-align: center;
        }

        @media(max-width:768px) {

            nav {
                padding: 15px;
                flex-direction: column;
                gap: 10px;
            }

            .menu {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .header h1 {
                font-size: 35px;
            }

            .search-box form {
                flex-direction: column;
            }

        }
    </style>
</head>

<body>

    <!-- NAVBAR -->

    <nav>

        <div class="logo">
            <i class="fa-solid fa-shoe-prints"></i>
            ShoeStore
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

    <!-- HEADER -->

    <section class="header">

        <div>

            <h1>KOLEKSI SEPATU TERBARU</h1>

            <p>
                Temukan sepatu original dengan kualitas premium
            </p>

        </div>

    </section>

    <!-- PRODUK -->

    <div class="container">

        <div class="search-box">

            <form method="GET">

                <input
                    type="text"
                    name="cari"
                    placeholder="Cari produk..."
                    value="<?= $cari ?>">

                <button type="submit">
                    Cari
                </button>

            </form>

        </div>

        <div class="produk-grid">

            <?php if (mysqli_num_rows($produk) > 0): ?>

                <?php while ($row = mysqli_fetch_assoc($produk)): ?>

                    <div class="card">

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
                                Stok tersedia :
                                <?= $row['stok']; ?>
                            </div>

                            <div class="btn-group">

                                <a
                                    href="detail_produk.php?id=<?= $row['id']; ?>"
                                    class="btn detail">
                                    Detail
                                </a>

                                <a
                                    href="login.php"
                                    class="btn keranjang">
                                    + Keranjang
                                </a>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="kosong">

                    <h2>Produk Tidak Ditemukan</h2>

                    <p>Silakan gunakan kata kunci lain.</p>

                </div>

            <?php endif; ?>

        </div>

    </div>

    <footer>

        <h3>ShoeStore</h3>

        <p>
            Temukan koleksi sepatu terbaik dengan kualitas premium.
        </p>

    </footer>

</body>

</html>