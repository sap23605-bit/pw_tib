<?php
function salam ()
{
    echo "assalammu'alaykum";
}
salam ();

function pengurangan(int $a, int $b)
{
    $pengurangan = $a - $b;
    echo $pengurangan;
}
pengurangan (9,3);

function pembagian(int $a, int $b)
{
    $pembagian = $a - $b;
    echo $pembagian;
}
pembagian (9,3);
?>
<form method ="post">
    <input type = "number" name = "angka1">
    <input type = "number" name = "angka2">
    <button type = "submit" name = "kirim">kirim</button>
</form>

<?php
if (insset($_POST['kirim'])){
    $angka1 =$_POST ['angka1'];
    $angka1 =$_POST ['angka2'];
    pengurangan ($angka1,$angka2);
}
?>

