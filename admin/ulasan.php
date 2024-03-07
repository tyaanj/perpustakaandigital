<?php
include 'header.php';
include 'navbar.php';
?>

<div class="container-fluid">
    <br>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mt-1">Ulasan Peminjam</h6>
            <div class="d-flex justify-content-end">
                <a href="print.php?filter=nama_lengkap&keyword=John" class="btn btn-sm btn-success"><i
                        class="bi bi-printer"> Cetak Data</i></a>
            </div>
        </div>
        <div class="card-body">
            <!-- Form Filter -->
            <form method="GET">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filter">Filter Berdasarkan:</label>
                            <select class="form-control" id="filter" name="filter">
                                <option value="username">Nama Peminjam</option>
                                <option value="judul">Judul Buku</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keyword">Kata Kunci:</label>
                            <input type="text" class="form-control" id="keyword" name="keyword">
                        </div>
                    </div>
                </div><br>
                <button type="submit" class="btn btn-primary left">Filter</button>
            </form>
            <!-- End Form Filter -->

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Buku</th>
                            <th>Ulasan</th>
                            <th>Rating</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('../koneksi.php');

                        // Filter data
                        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
                        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

                        $whereClause = '';
                        if ($filter && $keyword) {
                            $whereClause = "WHERE $filter LIKE '%$keyword%'";
                        }

                        $query = mysqli_query($koneksi, "SELECT ulasanbuku.*, user.username, buku.judul 
                                                        FROM ulasanbuku 
                                                        JOIN user ON ulasanbuku.id_user = user.id_user
                                                        JOIN buku ON ulasanbuku.id_buku = buku.id_buku
                                                        $whereClause");
                        $no = 1;
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['judul']; ?></td>
                            <td><?php echo $row['ulasan']; ?></td>
                            <td><?php echo $row['rating']; ?></td>
                            <td>
                                <a href="" data-bs-toggle="modal"
                                    data-bs-target="#modalDetailUlasan<?php echo $row['id_ulasan']; ?>"
                                    class="btn btn-secondary">Detail</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Buku -->
<?php
$data = "SELECT * FROM ulasanbuku, user, buku WHERE ulasanbuku.id_user=user.id_user AND ulasanbuku.id_buku=buku.id_buku ORDER BY ulasan ASC";
$result = mysqli_query($koneksi, $data);
while ($row = mysqli_fetch_array($result)) {
?>
<div class="modal fade" id="modalDetailUlasan<?= $row['id_ulasan']; ?>" tabindex="-1"
    aria-labelledby="modalDetailUlasanLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDetailUlasanLabel"><i class="bi bi-journal-bookmark-fill"></i>
                    Detail Ulasan</h1>
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
                                        <label for="" class="col-form-label">Ulasan :</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="" class="col-form-label"><?= $row['ulasan']; ?></label>
                                    </div>
                                </div>
                                <td>
                                    <?php
                                        $rating = $row['rating'];
                                        // Loop untuk menampilkan ikon bintang sesuai dengan rating
                                        for ($i = 0; $i < $rating; $i++) {
                                            echo '<i class="bi bi-star-fill text-warning"></i>';
                                        }
                                        // Loop untuk menampilkan ikon bintang kosong jika rating kurang dari 5
                                        for ($i = $rating; $i < 5; $i++) {
                                            echo '<i class="bi bi-star text-warning"></i>';
                                        }
                                        ?>
                                </td>
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