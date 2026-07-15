<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tentang Kami | ShoeStore</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background: #f5f7fa;
            color: #222;
        }

        /* ================= NAVBAR ================= */

        nav {
            background: white;
            padding: 18px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 15px rgba(0, 0, 0, .08);
            position: sticky;
            top: 0;
            z-index: 999;
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

        /* ================= HERO ================= */

        .hero {

            height: 520px;

            background:
                linear-gradient(rgba(0, 0, 0, .55), rgba(0, 0, 0, .55)),
                url("https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1600&q=80");

            background-size: cover;
            background-position: center;

            display: flex;
            justify-content: center;
            align-items: center;

            text-align: center;
            color: white;

        }

        .hero h1 {

            font-size: 65px;

            margin-bottom: 20px;

        }

        .hero p {

            font-size: 22px;

            max-width: 700px;

            margin: auto;

            line-height: 1.7;

        }

        /* ================= SECTION ================= */

        .container {

            width: 92%;
            max-width: 1300px;

            margin: auto;

            padding: 80px 0;

        }

        .judul {

            font-size: 42px;

            margin-bottom: 20px;

            text-align: center;

        }

        .desc {

            text-align: center;

            color: #666;

            margin-bottom: 60px;

            line-height: 1.8;

        }

        /* ================= ABOUT ================= */

        .about {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 60px;

            align-items: center;

        }

        .about img {

            width: 100%;

            border-radius: 20px;

        }

        .about-text h2 {

            font-size: 38px;

            margin-bottom: 20px;

        }

        .about-text p {

            font-size: 18px;

            line-height: 1.8;

            color: #555;

            margin-bottom: 20px;

        }

        /* ================= VALUE ================= */

        .value {

            display: grid;

            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));

            gap: 30px;

            margin-top: 60px;

        }

        .box {

            background: white;

            padding: 40px;

            border-radius: 20px;

            text-align: center;

            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);

            transition: .3s;

        }

        .box:hover {

            transform: translateY(-8px);

        }

        .box i {

            font-size: 45px;

            color: #2563eb;

            margin-bottom: 20px;

        }

        .box h3 {

            margin-bottom: 15px;

        }

        /* ================= STATS ================= */

        .stats {

            margin-top: 80px;

            display: grid;

            grid-template-columns: repeat(4, 1fr);

            gap: 30px;

        }

        .stat {

            background: #111827;

            color: white;

            padding: 40px;

            border-radius: 20px;

            text-align: center;

        }

        .stat h2 {

            font-size: 45px;

            margin-bottom: 10px;

            color: #3b82f6;

        }

        /* ================= CTA ================= */

        .cta {

            margin-top: 90px;

            background: #111827;

            color: white;

            padding: 70px;

            border-radius: 25px;

            text-align: center;

        }

        .cta h2 {

            font-size: 40px;

            margin-bottom: 20px;

        }

        .cta p {

            font-size: 18px;

            margin-bottom: 30px;

        }

        .cta a {

            background: #2563eb;

            padding: 16px 35px;

            border-radius: 12px;

            color: white;

            text-decoration: none;

            font-weight: bold;

        }

        .cta a:hover {

            background: #1d4ed8;

        }

        /* ================= FOOTER ================= */

        footer {

            margin-top: 70px;

            background: #111827;

            color: white;

            padding: 50px;

            text-align: center;

        }

        @media(max-width:900px) {

            .about {

                grid-template-columns: 1fr;

            }

            .stats {

                grid-template-columns: repeat(2, 1fr);

            }

            .hero h1 {

                font-size: 45px;

            }

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
            <a href="index.php">Home</a>
            <a href="produk.php">Produk</a>
            <a href="tentang.php">Tentang</a>
            <a href="kontak.php">Kontak</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>

    </nav>

    <section class="hero">

        <div>

            <h1>About ShoeStore</h1>

            <p>

                Menghadirkan koleksi sepatu original dengan desain modern,
                kualitas premium, dan pengalaman belanja terbaik.

            </p>

        </div>

    </section>

    <div class="container">

        <h2 class="judul">

            Siapa Kami?

        </h2>

        <p class="desc">

            ShoeStore adalah toko sepatu online yang menyediakan berbagai produk
            berkualitas mulai dari Running, Sneakers, Basketball,
            Training hingga Lifestyle.

        </p>

        <div class="about">

            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80">

            <div class="about-text">

                <h2>Lebih dari Sekadar Sepatu</h2>

                <p>

                    Kami percaya bahwa setiap langkah memiliki cerita.
                    Karena itu kami menghadirkan produk original dengan kualitas terbaik.

                </p>

                <p>

                    Terinspirasi dari pengalaman belanja brand internasional seperti
                    Nike, Puma, dan Adidas, kami membangun ShoeStore agar memberikan
                    pengalaman berbelanja yang nyaman, cepat, dan modern.

                </p>

            </div>

        </div>

        <div class="value">

            <div class="box">

                <i class="fa-solid fa-award"></i>

                <h3>Original Product</h3>

                <p>

                    Semua produk dijamin original dan berkualitas premium.

                </p>

            </div>

            <div class="box">

                <i class="fa-solid fa-truck-fast"></i>

                <h3>Fast Delivery</h3>

                <p>

                    Pengiriman cepat ke seluruh Indonesia.

                </p>

            </div>

            <div class="box">

                <i class="fa-solid fa-headset"></i>

                <h3>24/7 Support</h3>

                <p>

                    Tim kami siap membantu kapan saja.

                </p>

            </div>

        </div>

        <div class="stats">

            <div class="stat">

                <h2>10K+</h2>

                Pelanggan

            </div>

            <div class="stat">

                <h2>500+</h2>

                Produk

            </div>

            <div class="stat">

                <h2>98%</h2>

                Customer Satisfaction

            </div>

            <div class="stat">

                <h2>24/7</h2>

                Customer Support

            </div>

        </div>

        <div class="cta">

            <h2>

                Temukan Sepatu Favoritmu

            </h2>

            <p>

                Jelajahi koleksi terbaru dengan kualitas premium.

            </p>

            <a href="produk.php">

                Belanja Sekarang

            </a>

        </div>

    </div>

    <footer>

        <h2>ShoeStore</h2>

        <p>

            © 2026 ShoeStore. All Rights Reserved.

        </p>

    </footer>

</body>

</html>