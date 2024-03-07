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

        <div class="container" style="margin-top: 1rem;">
            <h4 class="text-light">Daftar buku</h4>
            <div class="row ">
            <style>
                .row {
                color: white; /* Ganti warna sesuai keinginan Anda */
                gap: 30px; /* Jarak antar elemen */
                margin-bottom: 10px; /* Margin bawah agar lebih terpisah dari elemen di bawahnya */
                }
            </style>
              <!-- From pencarian -->
              <form action="" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul buku...">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>    
            </form>    

            <?php
            include '../koneksi.php';
            // Proses filter pencarian
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                // Pastikan untuk melarutkan nilai input untuk menghindari serangan SQL Injection
                $search = mysqli_real_escape_string($koneksi, $search);

                // Query untuk mencari buku berdasarkan judul
                $query = "SELECT * FROM buku WHERE judul LIKE '%$search%' ORDER BY id_buku ASC";
            }else{
                // Query untuk menampilkan semua buku jika tidak ada pencarian
                $query = "SELECT * FROM buku ORDER BY id_buku ASC";
            }   
            $data = mysqli_query($koneksi,$query); 
           
            while ($d = mysqli_fetch_array($data)){
                // $id_buku = $d['id_buku']; // Ambil id_buku untuk digunakan dalam query rating

                // // Query untuk mengambil rating hanya untuk buku tertentu
                // $queryRating = "SELECT rating FROM ulasanbuku WHERE id_buku = $id_buku";
                // $resultRating = mysqli_query($koneksi, $queryRating);

                // $totalRating = 0;
                // $jumlahRating = 0;

                // // Loop untuk menghitung jumlah total rating dan jumlah rating
                // while ($rowRating = mysqli_fetch_assoc($resultRting)) {
                //     $totalRating += $rowRating['rating'];
                //     $jumlahRating++;
                // }

                // // Hitung rata-rata rating
                // if ($jumlahRating > 0) {
                //     $ratarata = $totalRating / $jumlahRating;
                // } else {
                //     $ratarata = 0; // Menghindari pembagian oleh nol
                // }
                
            // ?>


                <div class="card" style="width: 14rem;">
                    <img src="../img/<?php echo $d['image']; ?>" class="card-img-top" width="250px">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $d['judul']; ?></h5>
                        <h6>Tahun Terbit: <?php echo $d['tahun_terbit']; ?></h6>
                        <!-- <a href="" data-bs-toggle="modal" data-bs-target="#modalDetailBuku<?php echo $d['id_buku']; ?>"
                            class="btn btn-dark">detail</a> -->
                            <a href="" data-bs-toggle="modal"
                                            data-bs-target="#modalPinjamBuku<?php echo $d['id_buku']; ?>"
                                            class="btn btn-sm btn-info text-dark">Pinjam</a>
                        <a href="detail.php?id_buku=<?php echo $d['id_buku']; ?>"
                            class="btn btn-sm btn-warning text-dark">Detail</a>
                            <a href="fav-buku.php?id_buku=<?php echo $d['id_buku']; ?>"
                            class="btn btn-sm btn-warning text-dark">fav</a>
                           
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <!-- Form peminjaman buku -->
        <?php
                $data = "SELECT * FROM buku WHERE id_buku";
                $result = mysqli_query($koneksi, $data);
                while ($a = mysqli_fetch_array($result)) {
                ?>

<div class="modal fade" id="modalPinjamBuku<?php echo $a['id_buku']; ?>" tabindex="-1" aria-labelledby="modalPinjamBukuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPinjamBukuLabel">Yakin Pinjam <?php echo $a['judul']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="proses-pinjam.php" method="POST">
                        <div class="mb-3">
                            <input type="text" name="id_user" class="form-control" value="<?php echo $_SESSION['username']; ?>"
                                hidden>
                            <input type="text" name="id_buku" class="form-control" value="<?php echo $a['id_buku']; ?>"
                                hidden>
                                    <input type="date" name="tgl_peminjaman" value="<?php echo  date('Y-m-d') ?>" class="form-control" required
                                        id="tgl_peminjaman" aria-describedby="emailHelp" hidden>
                                    <input type="date" name="tgl_pengembalian" value="<?php echo date('Y-m-d', strtotime('+7 days')) ?>" class="form-control" required
                                        id="tgl_pengembalian" aria-describedby="emailHelp" hidden>
                            <input type="text" name="status_peminjaman" value="dipinjam" class="form-control"
                                        id="status_peminjaman" aria-describedby="emailHelp" hidden>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">pinjam</button>
                            
                            
                        </div>
                    </form>
            </div>
        </div>
    </div>
                </div>
                <?php } ?>
</div>

        <div class="content mt-3">
            <p class="text-center text-white"> Aplikasi Perpustakaan Digital | 2024 </p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

</body>

</html>




<!-- modal detail buku -->
<?php
$data = "SELECT * FROM buku, kategoribuku WHERE buku.id_kategori=kategoribuku.id_kategori ORDER BY id_buku ASC";
$result = mysqli_query($koneksi, $data);
while ($row = mysqli_fetch_array($result)) {
?>
<div class="modal fade" id="modalDetailBuku<?= $row['id_buku']; ?>" tabindex="-1" aria-labelledby="modalDetailBukuLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDetailBukuLabel"><i class="bi bi-journal-bookmark-fill"></i>
                    Detail buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../img/<?= $row['image']; ?>" alt="" width="200">
                        </div>
                        <div class="col-md-8">
                            <form action="">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label">Kategori Buku</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['nama_kategori']; ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label">Judul Buku</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['judul']; ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label">Penulis</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['penulis']; ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label">Penerbit</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['penerbit']; ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label">Tahun Terbit</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['tahun_terbit']; ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label">Deskripsi</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['deskripsi']; ?></label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add "Baca Sekarang" button -->
            <div class="col-md-12 text-center">
                <a href="<?= $row['https://proactiveducation.com/wp-content/uploads/2018/11/Modul-1-MTK-Paket-B-Makanan-Favoritku.pdf']; ?>"
                    target="" class="btn btn-primary">Baca Sekarang</a>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>