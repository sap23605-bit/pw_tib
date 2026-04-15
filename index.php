<?php
echo"hello world?";
$nama = "jamik";
$umur = 20;
$tinggi = 175;
$kelas = "TIB Semester 4";
echo "Nama saya $nama, umur saya $umur, kelas saya $kelas";
echo "<br><br>===================================<br><br>";
$nilai = 11;
$nilai2 = 12;
$nilai3 =5;
$hasil = $nilai * $nilai2 * $nilai3;
echo "hasil dari $nilai x $nilai2 - $nilai3 adalah $hasil";
if($hasil >= 100){
    echo "nilai anda lebih dari 100";
}else if($hasil < 100){
    echo "<br> nilai anda kurang dari 100";
}else {
    echo "<br> nilai anda kosong";
}
?>