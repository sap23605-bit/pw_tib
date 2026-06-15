<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>ShoeStore</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<nav>
<div class="logo">👟 ShoeStore</div>

<div>
<a href="dashboard.php">Beranda</a>
<a href="produk.php">Produk</a>
<a href="keranjang.php">Keranjang</a>
<a href="checkout.php">Checkout</a>
<a href="../logout.php">Logout</a>
</div>
</nav>

<section class="hero">
<div class="hero-content">
<h1>STEP UP YOUR STYLE</h1>
<p>Koleksi sepatu terbaik untuk setiap langkahmu</p>
<a href="produk.php" class="btn">Belanja Sekarang</a>
</div>
</section>

<div class="container">
<h2 class="title">Produk Unggulan</h2>

<div class="products">

<div class="card">
<img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=80">
<div class="card-body">
<h3>Nike Air Max</h3>
<p class="price">Rp 799.000</p>
<a href="produk.php" class="btn">Lihat Produk</a>
</div>
</div>

<div class="card">
<img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?auto=format&fit=crop&w=800&q=80">
<div class="card-body">
<h3>Converse High</h3>
<p class="price">Rp 649.000</p>
<a href="produk.php" class="btn">Lihat Produk</a>
</div>
</div>

<div class="card">
<img src="https://images.unsplash.com/photo-1608231387042-66d1773070a5?auto=format&fit=crop&w=800&q=80">
<div class="card-body">
<h3>Adidas Running</h3>
<p class="price">Rp 720.000</p>
<a href="produk.php" class="btn">Lihat Produk</a>
</div>
</div>

</div>
</div>

<footer>
© 2026 ShoeStore — Toko Sepatu Online
</footer>

</body>
</html>