<?php
include 'header.php';
include 'navbar.php';
?>

<div class="content mt-3">
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <?php
                include '../koneksi.php';
                $dp = mysqli_query($koneksi, "SELECT COUNT(*) total FROM buku");
                $rp = mysqli_fetch_assoc($dp);
                ?>

                <div class="card-body bg-secondary-subtle text-center">
                    <h3> Data Buku </h3>
                    <h2> <?php echo $rp['total']; ?> </h2>
                    <hr>
                    <a href="buku.php" class="btn btn-dark btn-sm">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <?php
                include '../koneksi.php';
                $dp = mysqli_query($koneksi, "SELECT COUNT(*) total FROM kategoribuku");
                $a = mysqli_fetch_assoc($dp);
                ?>
                <div class="card-body bg-secondary-subtle text-center">
                    <h3> Kategori Buku </h3>
                    <h2> <?php echo $a['total']; ?> </h2>
                    <hr>
                    <a href="kategori-buku.php" class="btn btn-dark btn-sm">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <?php
                include '../koneksi.php';
                $dp = mysqli_query($koneksi, "SELECT COUNT(*) total FROM user");
                $b = mysqli_fetch_assoc($dp);
                ?>
                <div class="card-body bg-secondary-subtle text-center">
                    <h3> Users </h3>
                    <h2> <?php echo $b['total']; ?> </h2>
                    <hr>
                    <a href="user.php" class="btn btn-dark btn-sm">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <?php
                include '../koneksi.php';
                $dp = mysqli_query($koneksi, "SELECT COUNT(*) total FROM peminjaman");
                $c = mysqli_fetch_assoc($dp);
                ?>
                <div class="card-body bg-secondary-subtle text-center">
                    <h3> Peminjaman </h3>
                    <h2> <?php echo $c['total']; ?> </h2>
                    <hr>
                    <a href="laporan-peminjaman.php" class="btn btn-dark btn-sm">Lihat Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content mt-3">
    <div class="card">
        <div class="card-body">
            <p>Halo <b><?php echo $_SESSION['username']; ?></b> Anda telah login sebagai
                <b><?php echo $_SESSION['level']; ?></b>.
            </p>
        </div>
    </div>
</div>

<?php

include 'footer.php';

?>