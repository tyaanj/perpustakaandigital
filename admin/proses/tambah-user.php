<?php
session_start();

include '../../koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
$level = $_POST['level'];

// Lakukan pemeriksaan apakah nama sudah ada
$query_check_username = "SELECT * FROM user WHERE username = '$username'";
$result_check_username = mysqli_query($koneksi, $query_check_username);

if (mysqli_num_rows($result_check_username) > 0) {
    // Jika nama sudah ada, tampilkan pesan kesalahan
    echo "
        <script>
            alert('Nama sudah digunakan. Silakan gunakan nama yang lain.');
            document.location.href = '../user.php';
        </script>
    ";
    exit();
} else {
    // Jika nama belum ada, lanjutkan dengan proses penyimpanan data
    $query_insert_user = "INSERT INTO user (username, password, email, nama_lengkap, alamat, level) VALUES ('$username', '$password', '$email', '$nama_lengkap', '$alamat', '$level')";
    $success = mysqli_query($koneksi, $query_insert_user);

    if ($success) {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $level;
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                document.location.href = '../user.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan');
                document.location.href = ../user.php';
            </script>
        ";
    }
}
?>