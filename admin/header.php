<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:../login.php?pesan=info_login");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>

<style>
body {
    background-image: url('../assets/img/bg2.jpg');
    /* Ganti 'path/to/your/image.jpg' dengan path gambar Anda */
    /* background-size: contain;
    /* Untuk memastikan gambar latar belakang menutupi seluruh halaman */
    background-position: center;
    /* Untuk mengatur posisi gambar latar belakang ke tengah halaman */
    /* Jika Anda ingin menggunakan warna latar belakang alih-alih gambar, gunakan properti background-color */
    /* Misalnya: background-color: #f0f0f0; */
}
</style>


<body>
    <div class="container">