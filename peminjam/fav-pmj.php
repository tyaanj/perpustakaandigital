<?php
session_start();
// Periksa apakah 'username' sudah diatur
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
// Gunakan variabel $username pada formulir
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjam</title>
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
        <div class="content mt-3">
            <div class="card bg-secondary">
                <div class="card-body">
                    <a href="index.php" class="btn text-light">Dashboard</a>
                    <a href="buku.php" class="btn text-light">Buku</a>
                    <a href="koleksi.php" class="btn text-light">Peminjaman</a>
                    <a href="fav-pmj.php" class="btn text-light">favorit</a>
                    <a href="../logout.php" class="btn text-light">Logout</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <br>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-secondary mt-3">Favorite</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <thead class="table table-secondary">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Buku</th>
                                        
                                    </tr>
                                </thead>
                            <tbody>

                                <?php
                                include('../koneksi.php');
                                $no = 1;
                                $id_user = $_SESSION['id_user']; // Ambil id_user dari  session

                                $query = mysqli_query($koneksi, "SELECT * FROM favorit WHERE username='$username'");


                

                                while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['username']; ?></td>
                                        <td><?php echo $data['judul']; ?></td>
                                        
                                            <form action="proses-fav.php" method="POST">
                                                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                                                
                                                
                                            
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3 fixed-bottom">
        <p class="text-center"> Aplikasi Perpustakaan Digital | 2024 </p>
    </div>


</body>

</html>
