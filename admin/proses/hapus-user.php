<?php
session_start();

// menangkap data id yang di kirim dari url
$id_user = $_GET['id_user'];

// menghapus data dari database
include '../../koneksi.php';

$query = "DELETE from user WHERE id_user='$id_user'";
$success = mysqli_query($koneksi, $query);

if ($success) {
    echo "
    <script>
    alert('Data berhasil dihapus');
    document.location.href = '../user.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Data gagal dihapus');
    document.location.href = '../user.php';
    </script>
    ";
}
?>