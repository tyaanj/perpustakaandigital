<?php

session_start();

$id_user = $_POST['id_user'];
$id_buku = $_POST['id_buku'];
$ulasan = $_POST['ulasan'];
$rating = $_POST['rating'];

include '../koneksi.php';
$query = "INSERT INTO ulasanbuku VALUES ('', '$id_user', '$id_buku', '$ulasan', '$rating')";
$data = mysqli_query($koneksi, $query);

if ($data) {
    echo "
    <script>
    alert('Berhasil Ditambahkan');
    document.location.href = 'koleksi.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('data gagal ditambahkan');
    document.location.href = koleksi.php';
    </script>
    ";
}