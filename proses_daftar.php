<?php 
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$nama_lengkap = $_POST['nama_lengkap'];
$alamat = $_POST['alamat'];
  

// percabangan anti duplikat
$sql = "SELECT * FROM user WHERE username = '$username'";
$query = mysqli_num_rows(mysqli_query($koneksi, $sql));
if($query > 0){
    echo"<script>
    alert('maaf username telah digunakan');
    document.location.href = '?url=petugas';
    </script>";
} else{
    mysqli_query($koneksi,"INSERT INTO user VALUES('','$username','$password','$email','$nama_lengkap','$alamat','peminjam')");
header("location:index.php?pesan=info_daftar");
}
?>