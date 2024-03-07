<?php
include 'header.php';
include 'navbar.php';
?>


<div class="container-fluid">
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mt-1">Data Kategori Buku</h6>
            <div class="d-flex justify-content-end">
                <a class="btn btn-sm btn-success" href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="bi bi-plus-lg"></i> Tambah Buku</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include('../koneksi.php');
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['nama_kategori']; ?></td>
                            <td>
                                <a href="" data-bs-toggle="modal"
                                    data-bs-target="#modalEditKategori<?php echo $row['id_kategori']; ?>"
                                    class="btn btn-info">Edit</a>
                                <a href="proses/hapus-kategori.php?id_kategori=<?php echo $row['id_kategori']; ?>"
                                    onclick="return confirm('yakin untuk dihapus?');" class="btn btn-danger">Hapus</a>

                            </td>
                        </tr>

                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<!-- modal tambah buku -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/tambah-kategori.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori" class="mb-2">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                            placeholder="Masukkan Kategori Buku">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- modal edit buku -->
<?php

$data = "SELECT * FROM kategoribuku WHERE id_kategori ";
$result = mysqli_query($koneksi, $data);
while ($row = mysqli_fetch_array($result)) {
?>
<div class="modal fade" id="modalEditKategori<?= $row['id_kategori']; ?>" tabindex="-1"
    aria-labelledby="modalEditKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditkategoriLabel">Edit Data Kategori</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/edit-kategori.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_kategori" id="id_kategori" class="form-control"
                            value="<?= $row['id_kategori']; ?>">
                        <label for="nama_kategori" class="mb-2">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                            placeholder="Masukkan Kategori Buku" value="<?= $row['nama_kategori']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Edit Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
}
?>


<?php
include 'footer.php';
?>