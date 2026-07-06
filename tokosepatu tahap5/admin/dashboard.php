<?php
session_start();

require_once __DIR__ . '/../koneksi.php';

/** @var mysqli $conn */

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit;
}

$produk = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM produk")
);

$pesanan = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM pesanan")
);

$user = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) total FROM users WHERE role='pembeli'")
);

$pendapatan = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT SUM(total) total FROM pesanan")
);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Segoe UI;
        }

        body {
            background: #f1f5f9;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100%;
            background: #111827;
            padding: 20px;
        }

        .sidebar h2 {
            color: white;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 10px;
        }

        .sidebar a:hover {
            background: #2563eb;
        }

        .main {
            margin-left: 270px;
            padding: 30px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
        }

        .card h3 {
            color: #64748b;
        }

        .card h1 {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="sidebar">

        <h2>👟 ShoeStore</h2>

        <a href="dashboard.php">Dashboard</a>
        <a href="produk.php">Produk</a>
        <a href="pesanan.php">Pesanan</a>
        <a href="../logout.php">Logout</a>

    </div>

    <div class="main">

        <h1>Dashboard Admin</h1>

        <br>

        <div class="cards">

            <div class="card">
                <h3>Total Produk</h3>
                <h1><?= $produk['total']; ?></h1>
            </div>

            <div class="card">
                <h3>Total Pesanan</h3>
                <h1><?= $pesanan['total']; ?></h1>
            </div>

            <div class="card">
                <h3>Total Pembeli</h3>
                <h1><?= $user['total']; ?></h1>
            </div>

            <div class="card">
                <h3>Total Pendapatan</h3>
                <h1>
                    Rp <?= number_format($pendapatan['total'] ?? 0, 0, ',', '.'); ?>
                </h1>
            </div>

        </div>

    </div>

</body>

</html>