<?php
session_start();

require_once __DIR__ . '/../koneksi.php';

/** @var mysqli $conn */

/*
=========================
UPDATE STATUS
=========================
*/

if (isset($_POST['update'])) {

    $id = $_POST['id'];

    $status = $_POST['status'];

    mysqli_query($conn, "
UPDATE pesanan
SET status='$status'
WHERE id='$id'
");

    header("Location: pesanan.php");
    exit;
}

$data = mysqli_query($conn, "
SELECT *
FROM pesanan
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Data Pesanan</title>

    <style>
        body {
            font-family: Segoe UI;
            background: #f8fafc;
            margin: 0;
        }

        nav {
            background: #111827;
            padding: 18px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
        }

        .container {
            width: 95%;
            max-width: 1300px;
            margin: auto;
            padding: 30px 0;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #2563eb;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        select {
            padding: 8px;
            border-radius: 8px;
        }

        button {
            padding: 8px 15px;
            background: #2563eb;
            border: none;
            color: white;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <nav>

        <a href="dashboard.php">Dashboard</a>
        <a href="produk.php">Produk</a>
        <a href="pesanan.php">Pesanan</a>

    </nav>

    <div class="container">

        <div class="card">

            <h2>Pesanan Masuk</h2>

            <br>

            <table>

                <tr>

                    <th>ID</th>
                    <th>Nama</th>
                    <th>No HP</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

                <?php while ($row = mysqli_fetch_assoc($data)) { ?>

                    <tr>

                        <td><?= $row['id']; ?></td>

                        <td><?= $row['nama_pelanggan']; ?></td>

                        <td><?= $row['no_hp']; ?></td>

                        <td>
                            Rp <?= number_format($row['total'], 0, ',', '.'); ?>
                        </td>

                        <td><?= $row['pembayaran']; ?></td>

                        <td><?= $row['tanggal']; ?></td>

                        <td><?= $row['status']; ?></td>

                        <td>

                        <td>

                            <a href="detail_pesanan.php?id=<?= $row['id']; ?>"
                                style="
background:#10b981;
color:white;
padding:8px 12px;
border-radius:6px;
text-decoration:none;
margin-right:5px;
">
                                Detail
                            </a>

                            <form method="POST" style="display:inline-block;">

                                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                <select name="status">
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Diproses">Diproses</option>
                                    <option value="Dikirim">Dikirim</option>
                                    <option value="Selesai">Selesai</option>
                                </select>

                                <button type="submit" name="update">
                                    Update
                                </button>

                            </form>

                        </td>

                        <form method="POST">

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $row['id']; ?>">

                            <select name="status">

                                <option
                                    value="Menunggu"
                                    <?= $row['status'] == 'Menunggu' ? 'selected' : ''; ?>>
                                    Menunggu
                                </option>

                                <option
                                    value="Diproses"
                                    <?= $row['status'] == 'Diproses' ? 'selected' : ''; ?>>
                                    Diproses
                                </option>

                                <option
                                    value="Dikirim"
                                    <?= $row['status'] == 'Dikirim' ? 'selected' : ''; ?>>
                                    Dikirim
                                </option>

                                <option
                                    value="Selesai"
                                    <?= $row['status'] == 'Selesai' ? 'selected' : ''; ?>>
                                    Selesai
                                </option>

                            </select>

                            <button
                                type="submit"
                                name="update">
                                Update
                            </button>

                        </form>

                        </td>

                    </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</body>

</html>