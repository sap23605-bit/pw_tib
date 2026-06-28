<?php
include 'koneksi.php';

if(!isset($_GET['id'])){
    header("Location: produk.php");
    exit;
}

$id = (int)$_GET['id'];

$query = mysqli_query($conn,"
SELECT * FROM produk
WHERE id='$id'
");

if(mysqli_num_rows($query)==0){
    header("Location: produk.php");
    exit;
}

$produk = mysqli_fetch_assoc($query);

$related = mysqli_query($conn,"
SELECT * FROM produk
WHERE id != '$id'
ORDER BY RAND()
LIMIT 4
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?= $produk['nama']; ?> | ShoeStore</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
background:#f8fafc;
}

/* NAVBAR */

nav{
background:white;
padding:18px 60px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 2px 15px rgba(0,0,0,.08);
}

.logo{
font-size:30px;
font-weight:bold;
}

.logo i{
color:#2563eb;
}

.menu a{
text-decoration:none;
color:#111827;
margin-left:20px;
font-weight:600;
}

/* CONTAINER */

.container{
width:95%;
max-width:1300px;
margin:auto;
padding:40px 0;
}

/* DETAIL */

.detail{
display:grid;
grid-template-columns:1fr 1fr;
gap:50px;
align-items:center;
background:white;
padding:40px;
border-radius:25px;
box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.detail img{
width:100%;
border-radius:20px;
}

.nama{
font-size:42px;
font-weight:bold;
margin-bottom:15px;
}

.harga{
font-size:34px;
color:#2563eb;
font-weight:bold;
margin-bottom:20px;
}

.kategori{
display:inline-block;
background:#e0e7ff;
padding:8px 15px;
border-radius:20px;
margin-bottom:15px;
}

.stok{
margin-bottom:20px;
font-size:18px;
}

.deskripsi{
line-height:1.8;
color:#555;
margin-bottom:25px;
}

.btn{
display:inline-block;
padding:15px 25px;
background:#2563eb;
color:white;
text-decoration:none;
border-radius:12px;
font-weight:bold;
}

.btn:hover{
background:#1d4ed8;
}

/* RELATED */

.related-title{
font-size:32px;
margin:50px 0 25px;
}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:20px;
}

.card{
background:white;
border-radius:20px;
overflow:hidden;
box-shadow:0 5px 20px rgba(0,0,0,.08);
transition:.3s;
}

.card:hover{
transform:translateY(-5px);
}

.card img{
width:100%;
height:220px;
object-fit:cover;
}

.card-body{
padding:15px;
}

.card h3{
margin-bottom:10px;
}

.card-price{
font-weight:bold;
color:#2563eb;
margin-bottom:10px;
}

.card a{
display:block;
background:#111827;
color:white;
text-align:center;
padding:10px;
text-decoration:none;
}

/* RESPONSIVE */

@media(max-width:900px){

.detail{
grid-template-columns:1fr;
}

.nama{
font-size:32px;
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
<a href="login.php">Login</a>
</div>

</nav>

<div class="container">

<div class="detail">

<div>

<?php if(!empty($produk['gambar'])){ ?>

<img src="uploads/<?= $produk['gambar']; ?>">

<?php } else { ?>

<img src="https://images.unsplash.com/photo-1549298916-b41d501d3772">

<?php } ?>

</div>

<div>

<div class="kategori">
<?= $produk['kategori']; ?>
</div>

<h1 class="nama">
<?= $produk['nama']; ?>
</h1>

<div class="harga">
Rp <?= number_format($produk['harga'],0,',','.'); ?>
</div>

<div class="stok">
📦 Stok Tersedia: <?= $produk['stok']; ?>
</div>

<div class="deskripsi">
<?= nl2br($produk['deskripsi']); ?>
</div>

<a
href="pembeli/keranjang.php?tambah=<?= $produk['id']; ?>"
class="btn">
🛒 Tambah ke Keranjang
</a>

</div>

</div>

<h2 class="related-title">
Produk Lainnya
</h2>

<div class="grid">

<?php while($row=mysqli_fetch_assoc($related)){ ?>

<div class="card">

<?php if(!empty($row['gambar'])){ ?>

<img src="uploads/<?= $row['gambar']; ?>">

<?php } else { ?>

<img src="https://images.unsplash.com/photo-1549298916-b41d501d3772">

<?php } ?>

<div class="card-body">

<h3><?= $row['nama']; ?></h3>

<div class="card-price">
Rp <?= number_format($row['harga'],0,',','.'); ?>
</div>

<a href="detail_produk.php?id=<?= $row['id']; ?>">
Lihat Detail
</a>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>