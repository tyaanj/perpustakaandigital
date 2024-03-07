<?php
session_start();

// Periksa apakah key 'username' diatur dalam array $_SESSION
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
// Periksa apakah key 'judul' diatur dalam array $_POST
$judul = isset($_POST['judul']) ? $_POST['judul'] : '';

include '../koneksi.php';

// Periksa status buku di tabel favorit
$cek_status = mysqli_query($koneksi, "SELECT * FROM favorit WHERE username = '$username' AND judul = '$judul'");
if (mysqli_num_rows($cek_status) > 0) {
    echo "<script>alert('Buku sudah ditambahkan ke favorit!'); window.location='buku.php';</script>";
    exit;
}

// Masukkan data favorit
$query = "INSERT INTO favorit (username, judul) VALUES ('$username', '$judul')";
$success = mysqli_query($koneksi, $query);

if ($success)  {
    echo "
    <script>
    alert('Buku berhasil ditambahkan ke favorit');
    document.location.href = 'fav-pmj.php';
    </script>
    ";
} else {
    echo " 
    <script>
    alert('Buku gagal ditambahkan ke favorit');
    document.location.href = 'fav-pmj.php';
    </script>
    ";
}

?>
