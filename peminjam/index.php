<?php
include 'header.php';
include 'navbar.php';
?>

<div class="content mt-3">
    <div class="row justify-content-center">
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
                $dp = mysqli_query($koneksi, "SELECT COUNT(*) total FROM peminjaman");
                $b = mysqli_fetch_assoc($dp);
                ?>
                <div class="card-body bg-secondary-subtle text-center">
                    <h3> Koleksi </h3>
                    <h2> <?php echo $b['total']; ?> </h2>
                    <hr>
                    <a href="koleksi.php" class="btn btn-dark btn-sm">Lihat Data</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <?php
                include '../koneksi.php';
                $dp = mysqli_query($koneksi, "SELECT COUNT(*) total FROM ulasanbuku");
                $a = mysqli_fetch_assoc($dp);
                ?>
                <div class="card-body bg-secondary-subtle text-center">
                    <h3> Daftar Ulasan </h3>
                    <h2> <?php echo $a['total']; ?> </h2>
                    <hr>
                    <a href="fav-pmj.php" class="btn btn-dark btn-sm">Lihat Data</a>
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