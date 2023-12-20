<?php
$conn = mysqli_connect("localhost", "root", "", "bento_coffe");

// Periksa koneksi berhasil atau tidak
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Mengambil data dari form menggunakan metode POST
$nomor_meja = isset($_POST['meja']) ? intval($_POST['meja']) : 0;
$nama_pelanggan = isset($_POST['nama']) ? mysqli_real_escape_string($conn, $_POST['nama']) : '';
$jenis_menu = isset($_POST['jenis_menu']) ? mysqli_real_escape_string($conn, $_POST['jenis_menu']) : '';
$jumlah = isset($_POST['jumlah']) ? intval($_POST['jumlah']) : 0;

// Lakukan pengecekan sebelum menjalankan query SQL
if ($nomor_meja > 0 && $nama_pelanggan !== '' && $jenis_menu !== '' && $jumlah > 0) {
    // Query INSERT
    $query = "INSERT INTO pesanan (nomor_meja, nama_pelanggan, jenis_menu, jumlah) 
    VALUES ($nomor_meja, '$nama_pelanggan', '$jenis_menu', $jumlah)";

    if (mysqli_query($conn, $query)) {
        echo "Pesanan berhasil disimpan.";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Data tidak lengkap atau tidak valid.";
}

// Tutup koneksi database
mysqli_close($conn);
?>
