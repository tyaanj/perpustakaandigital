<?php
session_start();
// Periksa apakah 'username' sudah diatur
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
// Gunakan variabel $username pada formulir

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pinjam Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card" style="margin-top: 3rem;">
            <div class="row m-4">
                <?php
                if (isset($_GET['id_buku'])) {
                    $id_buku = $_GET['id_buku'];
                } else {    
                    die("Data Tidak Tersedia");
                }
                    include '../koneksi.php';
                    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id_buku'");
                    $result = mysqli_fetch_array($query);
                ?>
                <div class="col-sm-7">
                    <h3>From Peminjaman Buku</h3>
                    <form action="proses-fav.php" method="POST">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Nama User </label>
                            <input type="text" name="id_user" class="form-control" value="<?php echo $username; ?>"
                                readonly>
                                
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label"> Judul Buku </label>
                            <input type="text" name="judul" class="form-control" value="<?php echo $result['judul']; ?>"
                                readonly>
                            <input type="hidden" name="id_buku" class="form-control"
                                value="<?php echo $result['id_buku']; ?>">
                        </div>
                        
                        <div>
                            <button type="submit" class="btn btn-success">Favorite</button>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3 fixed-bottom">
        <p class="text-center"> Aplikasi Perpustakaan Digital | 2024 </p>
    </div>


</body>

</html>
