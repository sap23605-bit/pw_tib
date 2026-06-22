<?php
include '../koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"
SELECT
detail_pesanan.*,
produk.nama,
produk.gambar
FROM detail_pesanan
JOIN produk
ON detail_pesanan.produk_id = produk.id
WHERE detail_pesanan.pesanan_id='$id'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Detail Pesanan</title>

<style>

body{
font-family:Segoe UI;
background:#f8fafc;
}

.container{
width:90%;
margin:auto;
padding:30px;
}

.card{
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
margin-bottom:20px;
}

img{
width:120px;
border-radius:10px;
}

</style>

</head>
<body>

<div class="container">

<h2>Detail Pesanan</h2>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<div class="card">

<img src="../uploads/<?= $row['gambar']; ?>">

<h3><?= $row['nama']; ?></h3>

<p>Qty : <?= $row['qty']; ?></p>

<p>
Harga :
Rp <?= number_format($row['harga'],0,',','.'); ?>
</p>

<p>
Subtotal :
Rp <?= number_format($row['harga']*$row['qty'],0,',','.'); ?>
</p>

</div>

<?php } ?>

</div>

</body>
</html>