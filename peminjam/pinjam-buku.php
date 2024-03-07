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
                    <form action="proses-pinjam.php" method="POST">
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
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="tgl_peminjaman" class="form-label">Tanggal Peminjaman</label>
                                    <input type="date" name="tgl_peminjaman" value="<?php echo  date('Y-m-d') ?>" class="form-control" required
                                        id="tgl_peminjaman" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="tgl_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                    <input type="date" name="tgl_pengembalian" value="<?php echo date('Y-m-d', strtotime('+7 days')) ?>" class="form-control" required
                                        id="tgl_pengembalian" aria-describedby="emailHelp">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="status_peminjaman" class="form-label"> Status Peminjaman </label>
                            <input type="text" name="status_peminjaman" value="dipinjam" class="form-control" required
                                        id="status_peminjaman" aria-describedby="emailHelp" readonly>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Pinjam</button>
                            <a href="buku.php" class="btn btn-danger m-2">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="content mt-3 fixed-bottom">
        <p class="text-center"> Aplikasi Perpustakaan Digital | 2024 </p>
    </div>


    <script>
    // Ambil elemen input tanggal peminjaman dan tanggal pengembalian
    var tglPeminjaman = document.getElementById('tgl_peminjaman');
    var tglPengembalian = document.getElementById('tgl_pengembalian');

    // Event listener untuk mengubah tanggal pengembalian saat tanggal peminjaman diubah
    tglPeminjaman.addEventListener('change', function() {
        var tglPeminjamanValue = new Date(tglPeminjaman.value);
        var tglPengembalianValue = new Date(tglPeminjamanValue);
        tglPengembalianValue.setDate(tglPeminjamanValue.getDate() + 3);

        // Format tanggal pengembalian menjadi YYYY-MM-DD
        var dd = String(tglPengembalianValue.getDate()).padStart(2, '0');
        var mm = String(tglPengembalianValue.getMonth() + 1).padStart(2, '0'); // January is 0!
        var yyyy = tglPengembalianValue.getFullYear();

        var formattedTglPengembalian = yyyy + '-' + mm + '-' + dd;
        tglPengembalian.value = formattedTglPengembalian;
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>