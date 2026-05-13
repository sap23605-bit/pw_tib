
<form method="POST">
    username : <input type="text" name="username"><br><br>
    password : <input type="password" name="password"><br><br>
    nama : <input type="text" name="nama"><br><br>
    email : <input type="email" name="email"><br><br>
    <button type="submit" name="kirim">kirim</button>
</form>

<?php

include "koneksi.php";

if (isset($_POST['kirim'])) {
    $username = $_POST['username'];
    $pw = $_POST['password'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $sql = "INSERT INTO db_tib4 (username, PW, nama, email) VALUES ('$username', '$pw', '$nama', '$email')";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>

<table border="1">
<tr>
        <th>ID User</th>
        <th>Username</th>
        <th>Password</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Aksi</th>

    </tr>

<?php
$sql = "SELECT * FROM db_tib4";
$result = $koneksi->query($sql);
if (!$result) {
    die("Query error: " . $koneksi->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_user"] . "</td>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["PW"] . "</td>";
        echo "<td>" . $row["nama"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td><a href='materi4.php?id=" . $row["id_user"] . "'>Hapus</a> | <a href='materi4.php?id=" . $row["id_user"] . "'>Edit</td>";
        echo "</tr>";
    }
}
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM db_tib4 WHERE id_user = '7'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>
</table>



<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $sql = "SELECT * FROM user WHERE id = '$id'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            echo "<form action='materi4.php' method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row['id_user'] . "'>";

            echo "Username : <input type='text' name='username' value='" . $row['username'] . "'><br><br>";

            echo "Password : <input type='password' name='password' value='" . $row['password'] . "'><br><br>";

            echo "Nama : <input type='text' name='nama' value='" . $row['nama'] . "'><br><br>";

            echo "Email : <input type='email' name='email' value='" . $row['email'] . "'><br><br>";

            echo "<button type='submit' name='update'>Update</button>";

            echo "</form>";
        }
    }
}
?>
<?php
if (isset($_POST['update'])) {

    $id       = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama     = $_POST['nama'];
    $email    = $_POST['email'];

    $sql = "UPDATE user 
            SET username = '$username',
                password = '$password',
                nama = '$nama',
                email = '$email'
            WHERE id = '$id'";

    if ($koneksi->query($sql) === TRUE) {
        echo "Data berhasil diupdate";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>
