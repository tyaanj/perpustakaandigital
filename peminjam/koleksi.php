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
                    <h3 class="m-0 font-weight-bold text-secondary mt-3">Koleksi Peminjaman</h3>
                    <!-- <div class="d-flex justify-content-end">
                            <a href="print.php" class="btn btn-sm btn-success"><i class="bi bi-printer">Cetak Data</i></a>
                            <a  href="print.php" ></a>
                            </div> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <thead class="table table-secondary">
                                    <tr>
                                        <th>No</th>
                                        <th>Peminjam</th>
                                        <th>Buku</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Tanggal Pengembalian</th>
                                        <th>Status Peminjaman</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            <tbody>

                                <?php
                                include('../koneksi.php');
                                $no = 1;
                                $id_user = $_SESSION['id_user']; // Ambil id_user dari  session

                                $query = mysqli_query($koneksi, "SELECT * FROM peminjaman, buku, user 
                WHERE peminjaman.id_user=user.id_user 
            AND peminjaman.id_user=$id_user 
                AND peminjaman.id_buku=buku.id_buku 
                ORDER BY tgl_peminjaman ASC");

                                while ($row = mysqli_fetch_array($query)) {
                                    if ($row['status_peminjaman'] == 'dipinjam') {
                                        $color = "text-bg-success";
                                    } elseif ($row['status_peminjaman'] == 'dikembalikan') {
                                        $color = "text-bg-warning";
                                    } elseif ($row['status_peminjaman'] == 'telat') {
                                        $color = "text-bg-danger";
                                    }
                                ?>

                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $row['nama_lengkap']; ?></td>
                                    <td><?php echo $row['judul']; ?></td>
                                    <td><?php echo $row['tgl_peminjaman']; ?></td>
                                    <td><?php echo $row['tgl_pengembalian']; ?></td>
                                    <td><span
                                            class="badge rounded-pill <?= $color; ?>"><?php echo $row['status_peminjaman']; ?></span>
                                    </td>
                                    <td>
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#modalDetailGenerate<?php echo $row['id_peminjaman']; ?>"
                                            class="btn btn-sm btn-secondary">detail</a>
                                        <?php
                                            if ($row['status_peminjaman'] != 'dikembalikan') {
                                            ?>
                                     
                                        <?php
                                            }
                                            ?>
                                        <?php
                                        if ($row['status_peminjaman'] != 'dikembalikan') {
                                        ?>
                                           
                                        <?php
                                        }
                                        ?>
                                           
                                    </td>
                                </tr>

                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal detail buku -->
        <?php
        $data = "SELECT * FROM peminjaman, user, buku WHERE peminjaman.id_user=user.id_user AND peminjaman.id_buku=buku.id_buku ORDER BY tgl_peminjaman ASC";
        $result = mysqli_query($koneksi, $data);
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="modal fade" id="modalDetailGenerate<?= $row['id_peminjaman']; ?>" tabindex="-1"
            aria-labelledby="modalDetailGenerateLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalDetailGenerateLabel"><i
                                class="bi bi-journal-bookmark-fill"></i> Detail</h1>
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
                                                <label for="" class="col-form-label">Peminjam :</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <label for=""
                                                    class="col-form-label"><?= $row['nama_lengkap']; ?></label>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="" class="col-form-label">Judul Buku :</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <label for="" class="col-form-label"><?= $row['judul']; ?></label>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="" class="col-form-label">Tanggal Peminjam :</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <label for=""
                                                    class="col-form-label"><?= $row['tgl_peminjaman']; ?></label>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="" class="col-form-label">Tanggal Kembali :</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <label for=""
                                                    class="col-form-label"><?= $row['tgl_pengembalian']; ?></label>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <label for="" class="col-form-label">Status Peminjam :</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <label for=""
                                                    class="col-form-label"><?= $row['status_peminjaman']; ?></label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="ulasan.php?id_buku=<?php echo $row['id_buku']; ?>" class="btn btn-warning">Ulasan</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php
        $data = "SELECT * FROM peminjaman, user, buku 
        WHERE peminjaman.id_user=user.id_user 
        
        AND peminjaman.id_buku=buku.id_buku 
      
        
        ORDER BY tgl_peminjaman ASC";
        $result = mysqli_query($koneksi, $data);
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <div class="modal fade" id="updateStatus<?= $row['id_peminjaman']; ?>" tabindex="-1"
            aria-labelledby="updateStatusLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateStatusLabel">Ubah status peminjaman</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="edit-status.php" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="id_peminjaman"
                                    value="<?= $row['id_peminjaman']; ?>">
                                <label for="exampleInputEmail1" class="form-label">Kembalikan buku</label>
                                <select name="status_peminjaman" id="status_peminjaman" class="form-control" required>
                                    <option value="dikembalikan">dikembalikan</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">kembalikan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>

        <!-- footer -->
        <div class="content mt-3 fixed-bottom">
            <p class="text-center text-white"> Aplikasi Perpustakaan Digital | 2024 </p>
        </div>


        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>