if(isset($_POST['checkout'])){

    $nama = mysqli_real_escape_string($conn,$_POST['nama']);
    $alamat = mysqli_real_escape_string($conn,$_POST['alamat']);
    $no_hp = mysqli_real_escape_string($conn,$_POST['no_hp']);
    $pembayaran = mysqli_real_escape_string($conn,$_POST['pembayaran']);

    // simpan pesanan utama

    mysqli_query($conn,"
    INSERT INTO pesanan(
    nama_pelanggan,
    alamat,
    no_hp,
    pembayaran,
    total
    )
    VALUES(
    '$nama',
    '$alamat',
    '$no_hp',
    '$pembayaran',
    '$total'
    )
    ");

    // ambil id pesanan terakhir

    $pesanan_id = mysqli_insert_id($conn);

    // ambil semua isi keranjang

    $keranjang = mysqli_query($conn,"
    SELECT *
    FROM keranjang
    ");

    while($k=mysqli_fetch_assoc($keranjang)){

        $produk_id = $k['produk_id'];
        $qty = $k['qty'];

        // ambil harga produk

        $produk = mysqli_fetch_assoc(
            mysqli_query($conn,"
            SELECT harga
            FROM produk
            WHERE id='$produk_id'
            ")
        );

        $harga = $produk['harga'];

        // simpan detail pesanan

        mysqli_query($conn,"
        INSERT INTO detail_pesanan(
        pesanan_id,
        produk_id,
        qty,
        harga
        )
        VALUES(
        '$pesanan_id',
        '$produk_id',
        '$qty',
        '$harga'
        )
        ");
    }

    // kosongkan keranjang

    mysqli_query($conn,"
    DELETE FROM keranjang
    ");

    echo "
    <script>
    alert('Pesanan berhasil dibuat');
    window.location='riwayat.php';
    </script>
    ";
}