<?php
session_start();

require_once __DIR__ . '/../koneksi.php';

/** @var mysqli $conn */

if (!isset($_SESSION['id'])) {

    header("Location: ../login.php");

    exit;
}

$user_id = $_SESSION['id'];

$data = mysqli_query($conn, "

SELECT

keranjang.*,

produk.nama,

produk.harga,

produk.gambar,

produk.stok

FROM keranjang

JOIN produk

ON keranjang.produk_id=produk.id

WHERE keranjang.user_id='$user_id'

");

$total = 0;

while ($row = mysqli_fetch_assoc($data)) {

    $total += $row['harga'] * $row['qty'];
}

mysqli_data_seek($data, 0);

if(isset($_POST['checkout'])){

    // Ambil data form
    $nama        = $_POST['nama'];
    $email       = $_POST['email'];
    $hp          = $_POST['hp'];
    $alamat      = $_POST['alamat'];
    $provinsi    = $_POST['provinsi'];
    $kota        = $_POST['kota'];
    $kodepos     = $_POST['kodepos'];
    $pembayaran  = $_POST['pembayaran'];

    // Hitung total
    $ongkir      = 0;
    $subtotal    = $total;
    $totalBayar  = $subtotal + $ongkir;

    // Kode pesanan
    $kode = "ORD".date("YmdHis");

    // Simpan ke tabel pesanan
    $simpan = mysqli_query($conn,"
    INSERT INTO pesanan(
        user_id,
        kode_pesanan,
        nama_pelanggan,
        email,
        alamat,
        kota,
        provinsi,
        kode_pos,
        no_hp,
        pembayaran,
        subtotal,
        ongkir,
        total
    )VALUES(
        '$user_id',
        '$kode',
        '$nama',
        '$email',
        '$alamat',
        '$kota',
        '$provinsi',
        '$kodepos',
        '$hp',
        '$pembayaran',
        '$subtotal',
        '$ongkir',
        '$totalBayar'
    )
    ");

    if($simpan){

        $idPesanan = mysqli_insert_id($conn);

        // Ambil isi keranjang
        $cart = mysqli_query($conn,"
        SELECT
            keranjang.*,
            produk.nama,
            produk.harga
        FROM keranjang
        JOIN produk
        ON keranjang.produk_id = produk.id
        WHERE keranjang.user_id='$user_id'
        ");

        while($r=mysqli_fetch_assoc($cart)){

            $sub = $r['harga'] * $r['qty'];

            // Simpan detail pesanan
            mysqli_query($conn,"
            INSERT INTO detail_pesanan(
                pesanan_id,
                produk_id,
                nama_produk,
                harga,
                qty,
                subtotal
            )VALUES(
                '$idPesanan',
                '".$r['produk_id']."',
                '".$r['nama']."',
                '".$r['harga']."',
                '".$r['qty']."',
                '$sub'
            )
            ");

            // Kurangi stok
            mysqli_query($conn,"
            UPDATE produk
            SET stok = stok - ".$r['qty']."
            WHERE id=".$r['produk_id']."
            ");
        }

        // Kosongkan keranjang
        mysqli_query($conn,"
        DELETE FROM keranjang
        WHERE user_id='$user_id'
        ");

        header("Location: riwayat.php");
        exit;

    }else{

        echo mysqli_error($conn);

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout | ShoeStore</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f4f6f9;
            color: #222;
        }

        /* ==========================
NAVBAR
========================== */

        nav {

            height: 80px;

            background: white;

            display: flex;

            justify-content: space-between;

            align-items: center;

            padding: 0 60px;

            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);

            position: sticky;

            top: 0;

            z-index: 999;

        }

        .logo {

            font-size: 30px;

            font-weight: 700;

            color: #111;

        }

        .logo span {

            color: #2563eb;

        }

        .menu {

            display: flex;

            gap: 35px;

        }

        .menu a {

            text-decoration: none;

            color: #555;

            font-weight: 500;

            transition: .3s;

        }

        .menu a:hover {

            color: #2563eb;

        }

        /* ==========================
HERO
========================== */

        .hero {

            height: 250px;

            background:

                linear-gradient(rgba(0, 0, 0, .55), rgba(0, 0, 0, .55)),

                url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1600&q=80');

            background-size: cover;

            background-position: center;

            display: flex;

            justify-content: center;

            align-items: center;

            flex-direction: column;

            color: white;

        }

        .hero h1 {

            font-size: 48px;

            font-weight: bold;

        }

        .hero p {

            margin-top: 10px;

            font-size: 18px;

        }

        /* ==========================
LAYOUT
========================== */

        .container {

            width: 95%;

            max-width: 1400px;

            margin: 50px auto;

            display: grid;

            grid-template-columns: 2fr 1fr;

            gap: 35px;

        }

        /* ==========================
CARD
========================== */

        .card {

            background: white;

            padding: 30px;

            border-radius: 20px;

            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);

        }

        /* ==========================
FORM
========================== */

        .card h2 {

            margin-bottom: 25px;

            font-size: 28px;

        }

        label {

            display: block;

            margin-bottom: 8px;

            font-weight: 600;

        }

        input {

            width: 100%;

            padding: 15px;

            margin-bottom: 20px;

            border: 1px solid #ddd;

            border-radius: 12px;

            font-size: 15px;

        }

        textarea {

            width: 100%;

            height: 120px;

            padding: 15px;

            border: 1px solid #ddd;

            border-radius: 12px;

            resize: none;

            margin-bottom: 20px;

            font-size: 15px;

        }

        select {

            width: 100%;

            padding: 15px;

            border: 1px solid #ddd;

            border-radius: 12px;

            font-size: 15px;

            margin-bottom: 20px;

        }

        /* ==========================
GRID
========================== */

        .grid2 {

            display: grid;

            grid-template-columns: 1fr 1fr;

            gap: 20px;

        }

        /* ==========================
PRODUK
========================== */

        .item {

            display: flex;

            gap: 15px;

            margin-bottom: 20px;

            padding-bottom: 20px;

            border-bottom: 1px solid #eee;

        }

        .item img {

            width: 95px;

            height: 95px;

            border-radius: 15px;

            object-fit: cover;

        }

        .item h3 {

            font-size: 18px;

            margin-bottom: 6px;

        }

        .item p {

            color: #666;

        }

        .price {

            font-size: 18px;

            font-weight: bold;

            color: #2563eb;

            margin-top: 8px;

        }

        /* ==========================
TOTAL
========================== */

        .total {

            margin-top: 25px;

        }

        .total div {

            display: flex;

            justify-content: space-between;

            margin-bottom: 12px;

            font-size: 17px;

        }

        .total h2 {

            display: flex;

            justify-content: space-between;

            margin-top: 20px;

            padding-top: 20px;

            border-top: 2px dashed #ddd;

        }

        /* ==========================
BUTTON
========================== */

        button {

            width: 100%;

            padding: 18px;

            background: #2563eb;

            color: white;

            border: none;

            border-radius: 15px;

            font-size: 18px;

            font-weight: bold;

            cursor: pointer;

            transition: .3s;

            margin-top: 25px;

        }

        button:hover {

            background: #1e40af;

            transform: translateY(-2px);

        }

        .badge {

            display: inline-block;

            background: #e0f2fe;

            color: #0369a1;

            padding: 6px 15px;

            border-radius: 20px;

            font-size: 13px;

            margin-bottom: 15px;

        }

        @media(max-width:900px) {

            .container {

                grid-template-columns: 1fr;

            }

            .hero h1 {

                font-size: 34px;

            }

            nav {

                padding: 20px;

            }

            .menu {

                display: none;

            }

            .grid2 {

                grid-template-columns: 1fr;

            }

        }
    </style>

</head>

<body>

    <nav>

        <div class="logo">

            Shoe<span>Store</span>

        </div>

        <div class="menu">

            <a href="dashboard.php">Home</a>

            <a href="produk.php">Produk</a>

            <a href="keranjang.php">Keranjang</a>

            <a href="riwayat.php">Riwayat</a>

        </div>

    </nav>

    <section class="hero">

        <h1>Checkout</h1>

        <p>Lengkapi informasi pengiriman untuk menyelesaikan pesanan Anda.</p>

    </section>

    <div class="container">
        <!-- =========================
FORM CHECKOUT
========================= -->

        <div class="card">

            <span class="badge">
                <i class="fa-solid fa-location-dot"></i>
                Informasi Pengiriman
            </span>

            <h2>Alamat Pengiriman</h2>

            <form method="POST">

                <label>Nama Lengkap</label>

                <input
                    type="text"
                    name="nama"
                    required
                    value="<?= $_SESSION['nama']; ?>">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    required
                    value="<?= $_SESSION['email']; ?>">

                <label>Nomor HP</label>

                <input
                    type="text"
                    name="hp"
                    required
                    placeholder="08xxxxxxxxxx">

                <label>Alamat Lengkap</label>

                <textarea
                    name="alamat"
                    required
                    placeholder="Masukkan alamat lengkap..."></textarea>

                <div class="grid2">

                    <div>

                        <label>Provinsi</label>

                        <select
                            name="provinsi"
                            id="provinsi"
                            required>

                            <option value="">Pilih Provinsi</option>

                        </select>

                    </div>

                    <div>

                        <label>Kota / Kabupaten</label>

                        <select
                            name="kota"
                            id="kota"
                            required>

                            <option value="">Pilih Kota</option>

                        </select>

                    </div>

                </div>

                <label>Kode Pos</label>

                <input
                    type="text"
                    name="kodepos"
                    required>

                <label>Metode Pembayaran</label>

                <select name="pembayaran" required>

                    <option value="">Pilih Pembayaran</option>

                    <option>Transfer BCA</option>

                    <option>Transfer BNI</option>

                    <option>Transfer Mandiri</option>

                    <option>QRIS</option>

                    <option>COD</option>

                    <option>GoPay</option>

                    <option>ShopeePay</option>

                </select>

        </div>

        <!-- =========================
RINGKASAN BELANJA
========================= -->

        <div class="card">

            <span class="badge">

                <i class="fa-solid fa-cart-shopping"></i>

                Ringkasan Belanja

            </span>

            <h2>Pesanan Anda</h2>

            <?php

            while ($row = mysqli_fetch_assoc($data)) {

                $sub = $row['harga'] * $row['qty'];

            ?>

                <div class="item">

                    <?php

                    if ($row['gambar'] != "") {

                    ?>

                        <img src="../uploads/<?= $row['gambar']; ?>">

                    <?php

                    } else {

                    ?>

                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=600&q=80">

                    <?php

                    }

                    ?>

                    <div>

                        <h3>

                            <?= $row['nama']; ?>

                        </h3>

                        <p>

                            Qty :
                            <?= $row['qty']; ?>

                        </p>

                        <div class="price">

                            Rp <?= number_format($row['harga'], 0, ',', '.'); ?>

                        </div>

                    </div>

                </div>

            <?php

            }

            ?>

            <div class="total">

                <div>

                    <span>Subtotal</span>

                    <span>

                        Rp <?= number_format($total, 0, ',', '.'); ?>

                    </span>

                </div>

                <div>

                    <span>Ongkir</span>

                    <span>

                        Gratis

                    </span>

                </div>

                <h2>

                    <span>Total</span>

                    <span>

                        Rp <?= number_format($total, 0, ',', '.'); ?>

                    </span>

                </h2>

                <button
                    type="submit"
                    name="checkout">

                    <i class="fa-solid fa-credit-card"></i>

                    Bayar Sekarang

                </button>

            </div>

            </form>

        </div>

    </div>

    <footer style="background:#111827;color:white;padding:40px;text-align:center;margin-top:50px;">

        <h2>ShoeStore</h2>

        <p>

            Belanja Sepatu Original dengan pengalaman premium.

        </p>

    </footer>

    <script>
        const provinsi = document.getElementById("provinsi");
        const kota = document.getElementById("kota");

        fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")

            .then(res => res.json())

            .then(data => {

                data.forEach(item => {

                    provinsi.innerHTML += `

<option value="${item.name}" data-id="${item.id}">

${item.name}

</option>

`;

                });

            });

        provinsi.addEventListener("change", function() {

            let id = this.options[this.selectedIndex].dataset.id;

            kota.innerHTML = "<option>Pilih Kota</option>";

            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${id}.json`)

                .then(res => res.json())

                .then(data => {

                    data.forEach(item => {

                        kota.innerHTML += `

<option value="${item.name}">

${item.name}

</option>

`;

                    });

                });

        });
    </script>

</body>

</html>