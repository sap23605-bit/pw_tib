<?php
include 'koneksi.php';

$produk = mysqli_query($conn,"
SELECT * FROM produk
ORDER BY id DESC
LIMIT 8
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ShoeStore - Step Into Style</title>

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
position:sticky;
top:0;
z-index:1000;

background:white;

display:flex;
justify-content:space-between;
align-items:center;

padding:18px 60px;

box-shadow:0 2px 15px rgba(0,0,0,.08);
}

.logo{
font-size:30px;
font-weight:bold;
color:#111827;
}

.menu a{
text-decoration:none;
color:#111827;
margin-left:25px;
font-weight:600;
transition:.3s;
}

.menu a:hover{
color:#2563eb;
}

/* HERO */

.hero{

height:90vh;

background:
linear-gradient(
rgba(0,0,0,.45),
rgba(0,0,0,.45)
),

url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1400&q=80');

background-size:cover;
background-position:center;

display:flex;
justify-content:center;
align-items:center;

text-align:center;
color:white;
}

.hero-content h1{
font-size:70px;
margin-bottom:20px;
}

.hero-content p{
font-size:22px;
margin-bottom:30px;
}

.btn{
background:#2563eb;
color:white;

padding:15px 30px;

border-radius:10px;
text-decoration:none;

font-weight:bold;
}

/* KATEGORI */

.kategori{
padding:60px 0;
}

.kategori h2{
text-align:center;
margin-bottom:30px;
}

.kategori-list{
display:flex;
justify-content:center;
flex-wrap:wrap;
gap:20px;
}

.kategori-item{
background:white;
padding:20px 35px;
border-radius:15px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
font-weight:bold;
}

/* PRODUK */

.container{
width:95%;
max-width:1300px;
margin:auto;
}

.section-title{
text-align:center;
margin-bottom:30px;
font-size:35px;
}

.produk-grid{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(260px,1fr));

gap:25px;
}

.card{

background:white;

border-radius:20px;

overflow:hidden;

box-shadow:
0 8px 20px rgba(0,0,0,.08);

transition:.3s;
}

.card:hover{
transform:translateY(-10px);
}

.card img{
width:100%;
height:250px;
object-fit:cover;
}

.card-body{
padding:20px;
}

.card-body h3{
margin-bottom:10px;
}

.harga{
font-size:22px;
font-weight:bold;
color:#2563eb;
margin-bottom:10px;
}

.stok{
color:#64748b;
margin-bottom:15px;
}

.btn-detail{
display:block;

text-align:center;

background:#111827;

color:white;

padding:12px;

border-radius:10px;

text-decoration:none;
}

/* PROMO */

.promo{
margin-top:70px;
margin-bottom:70px;

background:#111827;
color:white;

padding:60px;

text-align:center;
}

.promo h2{
font-size:45px;
margin-bottom:15px;
}

/* FOOTER */

footer{
background:#111827;
color:white;

padding:50px;
margin-top:70px;
}

.footer-grid{
display:grid;
grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));

gap:30px;
}

footer h3{
margin-bottom:15px;
}

/* RESPONSIVE */

@media(max-width:768px){

nav{
padding:15px;
flex-direction:column;
gap:10px;
}

.hero-content h1{
font-size:40px;
}

.hero-content p{
font-size:18px;
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

<div class="kategori-list">

<div class="kategori-item">Running</div>

<div class="kategori-item">Sneakers</div>

<div class="kategori-item">Basket</div>

<div class="kategori-item">Training</div>

<div class="kategori-item">Lifestyle</div>

</div>

</section>

<!-- PRODUK -->

<div class="container">

<h2 class="section-title">
Produk Unggulan
</h2>

<div class="produk-grid">

<?php while($row=mysqli_fetch_assoc($produk)): ?>

<div class="card">

<?php if(!empty($row['gambar'])): ?>

<img src="uploads/<?= $row['gambar']; ?>">

<?php else: ?>

<img src="https://images.unsplash.com/photo-1549298916-b41d501d3772">

<?php endif; ?>

<div class="card-body">

<h3><?= $row['nama']; ?></h3>

<div class="harga">
Rp <?= number_format($row['harga'],0,',','.'); ?>
</div>

<div class="stok">
Stok: <?= $row['stok']; ?>
</div>

<a
href="detail_produk.php?id=<?= $row['id']; ?>"
class="btn-detail"
>
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