<?php
include 'koneksi.php';

if(isset($_POST['register'])){

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cek = mysqli_query($conn,"
        SELECT * FROM users
        WHERE email='$email'
    ");

    if(mysqli_num_rows($cek)>0){

        $error = "Email sudah digunakan";

    }else{

        mysqli_query($conn,"
            INSERT INTO users
            (nama,email,password,role)
            VALUES
            (
                '$nama',
                '$email',
                '$password',
                'pembeli'
            )
        ");

        $success = "Registrasi berhasil!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - ShoeStore</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f5f5f5;
height:100vh;
display:flex;
}

.left{
width:55%;
background:url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1200&q=80');
background-size:cover;
background-position:center;
position:relative;
}

.overlay{
position:absolute;
inset:0;
background:rgba(0,0,0,.45);
display:flex;
justify-content:center;
align-items:center;
text-align:center;
padding:40px;
}

.overlay h1{
color:white;
font-size:60px;
font-weight:700;
}

.right{
width:45%;
background:white;
display:flex;
justify-content:center;
align-items:center;
padding:40px;
}

.login-box{
width:100%;
max-width:430px;
}

.logo{
font-size:35px;
font-weight:700;
margin-bottom:10px;
}

.sub{
color:#666;
margin-bottom:35px;
}

.error{
background:#fee2e2;
color:#dc2626;
padding:12px;
border-radius:10px;
margin-bottom:15px;
}

.form-group{
margin-bottom:20px;
}

label{
display:block;
margin-bottom:8px;
font-weight:500;
}

input{
width:100%;
padding:15px;
border:1px solid #ddd;
border-radius:12px;
font-size:15px;
transition:.3s;
}

input:focus{
outline:none;
border-color:black;
}

.btn{
width:100%;
padding:15px;
border:none;
background:black;
color:white;
border-radius:12px;
font-size:15px;
font-weight:600;
cursor:pointer;
transition:.3s;
}

.btn:hover{
background:#222;
}

.links{
display:flex;
justify-content:space-between;
margin-top:15px;
}

.links a{
text-decoration:none;
color:#111;
font-size:14px;
}

.register{
margin-top:30px;
text-align:center;
}

.register a{
font-weight:600;
color:black;
text-decoration:none;
}

@media(max-width:900px){

.left{
display:none;
}

.right{
width:100%;
}

}

</style>
</head>
<body>

<div class="left">
    <div class="overlay">
        <h1>STEP INTO<br>YOUR STYLE</h1>
    </div>
</div>

<div class="right">

<div class="login-box">

<div class="logo">
👟 ShoeStore
</div>

<p class="sub">
Masuk untuk melanjutkan belanja sepatu favoritmu.
</p>

<?php if(isset($error)){ ?>
<div class="error">
<?php echo $error; ?>
</div>
<?php } ?>

<form method="POST">

    <input type="text"
    name="nama"
    placeholder="Nama Lengkap"
    required>

    <br><br>

    <input type="email"
    name="email"
    placeholder="Email"
    required>

    <br><br>

    <input type="password"
    name="password"
    placeholder="Password"
    required>

    <br><br>

    <button type="submit" name="register">
        Daftar
    </button>

</form>


<div class="login-link">
Sudah punya akun?
<a href="login.php">Masuk</a>
</div>

</div>

</div>

</body>
</html>