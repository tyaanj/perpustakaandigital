<?php
include 'header.php';
?>

<div class="content mt-3">
    <div class="card bg-secondary ">
        <div class="card-body">
            <a href="index.php" class="btn text-light">Dashboard</a>
            <a href="kategori-buku.php" class="btn text-light">Kategori</a>
            <a href="buku.php" class="btn text-light">Buku</a>
            <a href="laporan-peminjaman.php" class="btn text-light">Laporan Peminjaman</a>
            <a href="../index.php" class="btn text-light">Logout</a>
        </div>
    </div>
</div>

<div class="container-fluid"><br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mt-1">Laporan Peminjaman</h6>
            <div class="d-flex justify-content-end">
                <!-- <a href="print.php?filter=nama_lengkap&keyword=John" class="btn btn-sm btn-success"><i
                        class="bi bi-printer"> Cetak Data</i></a> -->
            </div>
            <script> 
                window.print();
            </script>
        </div>
        <div class="card-body">
            <!-- Form Filter -->
            <div class="page-content fade-in-up">
                        <div class="ibox">
                            <div class="ibox-head">
                            </div>
                            <div class="ibox-body">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="tgl_peminjaman">Pilih Tanggal Peminjaman:</label>
                                            <input type="date" id="tgl_peminjaman" name="tgl_peminjaman"
                                                class="form-control">
                                        </div>
                                        <!--<div class="col-md-4">
                                            <label for="tgl_pengembalian">Pilih Tanggal Kembali:</label>
                                            <input type="date" id="tgl_pengembalian" name="tgl_pengembalian"
                                                class="form-control">
                                        </div>-->
                                        <div class="py-4">
                                            <button type="submit" class="btn btn-success">Filter</button>
                                        </div>
                                </form>
                                <hr>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                    // ambil tanggal dari form
                                    $tanggal_peminjaman = $_POST['tgl_peminjaman'];
                                    // $tanggal_pengembalian = $_POST['tgl_pengembalian'];
                                ?>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
            <!-- End Form Filter -->

            <div class="table-responsive mt-2">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status Peminjaman</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                        <tbody>
                            <?php
                            include '../koneksi.php';
                            $no = 1;
                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                $tgl_peminjaman = $_POST['tgl_peminjaman'];
                                // $tgl_pengembalian = $_POST['tgl_pengembalian'];
                                $query = mysqli_query($koneksi, "SELECT * FROM peminjaman, buku, user WHERE peminjaman.id_user=user.id_user
                                        AND peminjaman.id_buku=buku.id_buku AND tgl_peminjaman >= '$tgl_peminjaman'");
                                while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr class="text-center">
                                <td><?php echo $no++; ?>.</td>
                                <td><?php echo $row['nama_lengkap']; ?></td>
                                <td><?php echo $row['judul']; ?></td>
                                <td><?php echo $row['tgl_peminjaman']; ?></td>
                                <td><?php echo $row['tgl_pengembalian']; ?></td>
                                <td><?php echo $row['status_peminjaman']; ?></td>
                                <td>
                                    <a class="btn btn-sm btn-success"
                                        href="print1.php?id_peminjaman=<?php echo $row['id_peminjaman'];
                                        ?>&tgl_peminjaman=<?php echo $tgl_peminjaman; ?>&tgl_pengembalian=<?php echo $tgl_pengembalian; ?>&status_peminjaman=<?php echo $status_peminjaman; ?>"
                                        target="_blank">Print</a>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                        </table>
                        <script>
                        // Ambil elemen input tanggal peminjaman dan tanggal pengembalian
                        var tanggalPeminjaman = document.getElementById('tanggal_peminjaman');
                        var tanggalPengembalian = document.getElementById('tanggal_pengembalian');

                        // Event listener untuk mengubah tanggal pengembalian saat tanggal peminjaman diubah
                        tanggalPeminjaman.addEventListener('change', function() {
                            var tanggalPeminjamanValue = new Date(tanggalPeminjaman.value);
                            var tanggalPengembalianValue = new Date(tanggalPeminjamanValue);
                            tanggalPengembalianValue.setDate(tanggalPeminjamanValue.getDate() + 3);

                            // Format tanggal pengembalian menjadi YYYY-MM-DD
                            var dd = String(tanggalPengembalianValue.getDate()).padStart(2, '0');
                            var mm = String(tanggalPengembalianValue.getMonth() + 1).padStart(2,
                                '0'); // January is 0!
                            var yyyy = tanggalPengembalianValue.getFullYear();

                            var formattedTanggalPengembalian = yyyy + '-' + mm + '-' + dd;
                            tanggalPengembalian.value = formattedTanggalPengembalian;
                        });
                        </script>
                    </div>
                    <?php if ($_SERVER['REQUEST_METHOD'] != 'POST') { ?>
                    <div class="alert alert-sm alert-primary">
                        <center>
                            <strong>Perhatian!</strong> Silakan Filter Laporan Peminjaman
                        </center>
                    </div>
                    <?php } ?>
        </div>
    </div>
</div>

<!-- Modal Detail Buku -->
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
                <h1 class="modal-title fs-5" id="modalDetailGenerateLabel"><i class="bi bi-journal-bookmark-fill"></i>
                    Detail Laporan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="../../img/<?= $row['image']; ?>" alt="" width="200">
                        </div>
                        <div class="col-md-8">
                            <form action="">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label">Peminjam :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['nama_lengkap']; ?></label>
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
                                        <label for="" class="col-form-label">Tanggal Peminjaman :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['tgl_peminjaman']; ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label">Tanggal Pengembalian :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['tgl_pengembalian']; ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <label for="" class="col-form-label">Status Peminjaman :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['status_peminjaman']; ?></label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
<div class="content mt-3 fixed-bottom">
    <p class="text-center text-white"> Aplikasi Perpustakaan Digital | 2024 </p>
</div>

<?php } ?>


<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
</body>

</html>