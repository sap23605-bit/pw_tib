<?php
session_start();
include 'koneksi.php';

$success = "";

if (isset($_POST['kirim'])) {

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $subjek = mysqli_real_escape_string($conn, $_POST['subjek']);

    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    mysqli_query($conn, "
INSERT INTO kontak(
nama,
email,
subjek,
pesan
)
VALUES(
'$nama',
'$email',
'$subjek',
'$pesan'
)
");

    $success = "Pesan berhasil dikirim.";
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kontak Kami | ShoeStore</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        /* =========================
   RESET
========================= */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #f6f7fb;
            color: #111827;
            line-height: 1.6;
        }

        /* =========================
   NAVBAR
========================= */

        nav {
            position: sticky;
            top: 0;
            z-index: 1000;

            display: flex;
            justify-content: space-between;
            align-items: center;

            padding: 18px 60px;

            background: #111827;

            box-shadow: 0 5px 20px rgba(0, 0, 0, .15);
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
            color: #fff;
        }

        .logo i {
            color: #3b82f6;
            margin-right: 8px;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .menu a {
            text-decoration: none;
            color: white;
            font-weight: 600;
            transition: .3s;
            position: relative;
        }

        .menu a:hover {
            color: #60a5fa;
        }

        .menu a.active {
            color: #3b82f6;
        }

        .menu a::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 0;
            height: 2px;
            background: #3b82f6;
            transition: .3s;
        }

        .menu a:hover::after,
        .menu a.active::after {
            width: 100%;
        }

        /* =========================
   HERO
========================= */

        .hero {

            height: 430px;

            background:
                linear-gradient(rgba(17, 24, 39, .65), rgba(17, 24, 39, .65)),
                url("https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1600&q=80");

            background-size: cover;
            background-position: center;

            display: flex;
            justify-content: center;
            align-items: center;

            text-align: center;

            color: white;

        }

        .hero-content {
            max-width: 760px;
            padding: 20px;
        }

        .hero h1 {
            font-size: 60px;
            margin-bottom: 18px;
            font-weight: 700;
        }

        .hero p {
            font-size: 20px;
            opacity: .95;
        }

        /* =========================
   CONTENT
========================= */

        .container {

            width: 92%;
            max-width: 1300px;

            margin: auto;

            padding: 70px 0;

        }

        .contact-wrapper {

            display: grid;

            grid-template-columns: 420px 1fr;

            gap: 45px;

            align-items: start;

        }

        /* =========================
   CONTACT INFO
========================= */

        .contact-info {

            background: white;

            padding: 40px;

            border-radius: 22px;

            box-shadow: 0 10px 35px rgba(0, 0, 0, .08);

        }

        .contact-info h2 {

            font-size: 34px;

            margin-bottom: 10px;

        }

        .contact-info>p {

            color: #64748b;

            margin-bottom: 35px;

        }

        .info-box {

            display: flex;

            gap: 18px;

            align-items: flex-start;

            margin-bottom: 30px;

        }

        .info-box i {

            width: 58px;
            height: 58px;

            border-radius: 50%;

            display: flex;
            justify-content: center;
            align-items: center;

            background: #2563eb;

            color: white;

            font-size: 22px;

            flex-shrink: 0;

        }

        .info-box h3 {

            font-size: 18px;

            margin-bottom: 5px;

        }

        .info-box p {

            color: #64748b;

        }

        /* =========================
   SOSMED
========================= */

        .social {

            display: flex;

            gap: 15px;

            margin-top: 20px;

        }

        .social a {

            width: 48px;
            height: 48px;

            border-radius: 50%;

            display: flex;
            justify-content: center;
            align-items: center;

            background: #eef2ff;

            color: #2563eb;

            font-size: 20px;

            transition: .3s;

            text-decoration: none;

        }

        .social a:hover {

            background: #2563eb;

            color: white;

            transform: translateY(-5px);

        }

        /* =========================
   FORM
========================= */

        .contact-form {

            background: white;

            padding: 45px;

            border-radius: 22px;

            box-shadow: 0 10px 35px rgba(0, 0, 0, .08);

        }

        .contact-form h2 {

            font-size: 34px;

            margin-bottom: 30px;

        }

        .input-group {

            margin-bottom: 22px;

        }

        .input-group label {

            display: block;

            margin-bottom: 10px;

            font-weight: 600;

        }

        .input-group input,
        .input-group textarea {

            width: 100%;

            padding: 16px 18px;

            border: 1px solid #dbe4ef;

            border-radius: 12px;

            font-size: 15px;

            outline: none;

            transition: .3s;

            background: #fafafa;

        }

        .input-group input:focus,
        .input-group textarea:focus {

            border-color: #2563eb;

            box-shadow: 0 0 0 4px rgba(37, 99, 235, .15);

            background: white;

        }

        textarea {

            resize: none;

        }

        button {

            width: 100%;

            padding: 18px;

            background: #2563eb;

            color: white;

            border: none;

            border-radius: 12px;

            font-size: 17px;

            font-weight: bold;

            cursor: pointer;

            transition: .3s;

        }

        button i {

            margin-right: 10px;

        }

        button:hover {

            background: #1d4ed8;

            transform: translateY(-2px);

        }

        /* =========================
   MAP
========================= */

        .map-section {

            width: 92%;
            max-width: 1300px;

            margin: 20px auto 80px;

        }

        .map-section h2 {

            font-size: 36px;

            margin-bottom: 25px;

            text-align: center;

        }

        .map {

            overflow: hidden;

            border-radius: 20px;

            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);

        }

        .map iframe {

            width: 100%;

            height: 450px;

            border: 0;

        }

        /* =========================
   FOOTER
========================= */

        footer {

            background: #111827;

            padding: 50px 20px;

            text-align: center;

            color: white;

        }

        footer h2 {

            margin-bottom: 10px;

        }

        footer p {

            color: #cbd5e1;

        }

        /* =========================
   HOVER CARD
========================= */

        .contact-info,
        .contact-form {

            transition: .35s;

        }

        .contact-info:hover,
        .contact-form:hover {

            transform: translateY(-8px);

            box-shadow: 0 20px 45px rgba(0, 0, 0, .12);

        }

        /* =========================
   RESPONSIVE
========================= */

        @media(max-width:992px) {

            nav {

                padding: 18px 25px;

                flex-direction: column;

                gap: 18px;

            }

            .menu {

                flex-wrap: wrap;

                justify-content: center;

            }

            .hero h1 {

                font-size: 45px;

            }

            .contact-wrapper {

                grid-template-columns: 1fr;

            }

        }

        @media(max-width:576px) {

            .hero {

                height: 330px;

            }

            .hero h1 {

                font-size: 34px;

            }

            .hero p {

                font-size: 16px;

            }

            .contact-form,
            .contact-info {

                padding: 25px;

            }

            .map iframe {

                height: 320px;

            }

        }

        .alert-success {

            background: #dcfce7;

            color: #166534;

            padding: 18px;

            border-radius: 12px;

            margin-bottom: 20px;

            font-weight: bold;

            animation: fade .6s;

        }

        @keyframes fade {

            from {

                opacity: 0;

                transform: translateY(-15px);

            }

            to {

                opacity: 1;

                transform: none;

            }

        }

        .faq {

            width: 92%;

            max-width: 1300px;

            margin: auto;

            padding: 60px 0;

        }

        .faq h2 {

            font-size: 38px;

            margin-bottom: 40px;

            text-align: center;

        }

        .faq-box {

            background: white;

            padding: 30px;

            border-radius: 18px;

            margin-bottom: 20px;

            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);

            transition: .3s;

        }

        .faq-box:hover {

            transform: translateY(-5px);

        }

        .faq-box h3 {

            margin-bottom: 12px;

        }
    </style>

</head>

<body>

    <!-- ================= NAVBAR ================= -->

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

    <!-- ================= HERO ================= -->

    <section class="hero">

        <div class="hero-content">

            <h1>Hubungi Kami</h1>

            <p>

                Kami siap membantu setiap pertanyaan mengenai produk,
                pemesanan maupun pengiriman.

            </p>

        </div>

    </section>

    <!-- ================= CONTENT ================= -->

    <section class="container">

        <div class="contact-wrapper">

            <!-- ================= INFORMASI ================= -->

            <div class="contact-info">

                <h2>Informasi Kontak</h2>

                <p>

                    Silakan hubungi kami melalui informasi berikut.

                </p>

                <div class="info-box">

                    <i class="fa-solid fa-location-dot"></i>

                    <div>

                        <h3>Alamat</h3>

                        <p>

                            Jl. Pejanggik No. 88<br>
                            Mataram, Nusa Tenggara Barat

                        </p>

                    </div>

                </div>

                <div class="info-box">

                    <i class="fa-solid fa-phone"></i>

                    <div>

                        <h3>Telepon</h3>

                        <p>

                            +62 812-3456-7890

                        </p>

                    </div>

                </div>

                <div class="info-box">

                    <i class="fa-solid fa-envelope"></i>

                    <div>

                        <h3>Email</h3>

                        <p>

                            support@shoestore.com

                        </p>

                    </div>

                </div>

                <div class="info-box">

                    <i class="fa-brands fa-whatsapp"></i>

                    <div>

                        <h3>WhatsApp</h3>

                        <p>

                            +62 812-3456-7890

                        </p>

                    </div>

                </div>

                <div class="info-box">

                    <i class="fa-solid fa-clock"></i>

                    <div>

                        <h3>

                            Jam Operasional

                        </h3>

                        <p>

                            Senin - Jumat

                            08.00 - 21.00

                            <br>

                            Sabtu - Minggu

                            09.00 - 22.00

                        </p>

                    </div>

                </div>

                <div class="social">

                    <a href="#"><i class="fab fa-facebook"></i></a>

                    <a href="#"><i class="fab fa-instagram"></i></a>

                    <a href="#"><i class="fab fa-tiktok"></i></a>

                    <a href="#"><i class="fab fa-x-twitter"></i></a>

                </div>

            </div>

            <!-- ================= FORM ================= -->

            <div class="contact-form">

                <h2>Kirim Pesan</h2>

                <form method="POST">
                    <?php

                    if ($success != "") {

                    ?>

                        <div class="alert-success">

                            <i class="fa-solid fa-circle-check"></i>

                            <?= $success ?>

                        </div>

                    <?php

                    }

                    ?>

                    <div class="input-group">

                        <label>Nama Lengkap</label>

                        <input
                            type="text"
                            name="nama"
                            placeholder="Masukkan nama lengkap"
                            required>

                    </div>

                    <div class="input-group">

                        <label>Email</label>

                        <input
                            type="email"
                            name="email"
                            placeholder="Masukkan email"
                            required>

                    </div>

                    <div class="input-group">

                        <label>Subjek</label>

                        <input
                            type="text"
                            name="subjek"
                            placeholder="Subjek pesan"
                            required>

                    </div>

                    <div class="input-group">

                        <label>Pesan</label>

                        <textarea
                            name="pesan"
                            rows="6"
                            placeholder="Tulis pesan..."
                            required></textarea>

                    </div>

                    <button
                        type="submit"
                        name="kirim">

                        <i class="fa-solid fa-paper-plane"></i>

                        Kirim Pesan

                    </button>

                </form>

            </div>

        </div>

    </section>

    <!-- ================= MAP ================= -->

    <section class="map-section">

        <h2>

            Lokasi ShoeStore

        </h2>

        <div class="map">

            <iframe

                src="https://www.google.com/maps?q=Mataram+NTB&output=embed"

                loading="lazy">

            </iframe>

        </div>

    </section>

    <section class="faq">

        <h2>

            Pertanyaan yang Sering Ditanyakan

        </h2>

        <div class="faq-box">

            <h3>

                Apakah semua produk original?

            </h3>

            <p>

                Ya, seluruh produk yang kami jual merupakan produk original dengan kualitas terbaik.

            </p>

        </div>

        <div class="faq-box">

            <h3>

                Berapa lama pengiriman?

            </h3>

            <p>

                2–5 hari kerja tergantung lokasi tujuan.

            </p>

        </div>

        <div class="faq-box">

            <h3>

                Apakah bisa tukar ukuran?

            </h3>

            <p>

                Bisa selama produk belum digunakan.

            </p>

        </div>

    </section>
    <!-- ================= FOOTER ================= -->

    <footer>

        <h2>

            <i class="fa-solid fa-shoe-prints"></i>

            ShoeStore

        </h2>

        <p>

            Inspired by Nike • Puma • Adidas

        </p>

        <br>

        <div class="social">

            <a href="#"><i class="fab fa-facebook"></i></a>

            <a href="#"><i class="fab fa-instagram"></i></a>

            <a href="#"><i class="fab fa-tiktok"></i></a>

            <a href="#"><i class="fab fa-youtube"></i></a>

        </div>

        <br>

        <p>

            © 2026 ShoeStore

            All Rights Reserved.

        </p>

    </footer>

</body>

</html>