<?php
    session_start();

    // Periksa apakah key 'id_user' diatur dalam array $_SESSION
    $id_user =  $_SESSION['id_user'];
    $id_buku = $_POST['id_buku'];
    $tgl_peminjaman = date('Y-m-d');
    $tgl_pengembalian = date('Y-m-d', strtotime('+7 days')); 

    include '../koneksi.php';

    // Periksa status buku
    $cek_status = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE id_buku = '$id_buku' AND id_user = '$id_user'");
    if (mysqli_num_rows($cek_status) > 0) {
        echo "<script>alert('Buku sudah dipinjam!'); window.location='buku.php';</script>";
        exit;
    }
   
    // Masukkan data peminjam
    $query = "INSERT INTO peminjaman  VALUES ('','$id_user', '$id_buku', '$tgl_peminjaman', '$tgl_pengembalian', 'dipinjam')";
    $success = mysqli_query($koneksi, $query);

    // Masukkan data ke koleksi pribadi
    $koleksi = mysqli_query($koneksi, "INSERT INTO koleksipribadi VALUES ('', '$id_user', '$id_buku')");
   

    if ($success)  {
        echo "
        <script>
        alert('buku berhasil dipinjam');
        document.location.href = 'koleksi.php';
        </script>
        ";
    } else {
        echo " 
        <script>
        alert('buku gagal dipinjam');
        document.location.href = 'koleksi.php';
        </script>
        ";
    }

    ?>