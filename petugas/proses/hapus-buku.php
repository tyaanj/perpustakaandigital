<?php 

// menangkap data id yang di kirim dari url
$id_buku = $_GET['id_buku'];

 
// menghapus data dari database
include '../../koneksi.php';
$query = "DELETE from buku WHERE id_buku='$id_buku'";
$success = mysqli_query($koneksi, $query);

if ($success) {
    echo "
    <script>
    alert('Data berhasil dihapus');
    document.location.href = '../buku.php';
    </script>
    ";
} else {
    echo "
    <script>
    alert('Data gagal dihapus');
    document.location.href = '../buku.php';
    </script>
    ";
}