<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "tokosepatu"
);

if(!$conn){
    die("Koneksi gagal : ".mysqli_connect_error());
}