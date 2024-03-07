<?php
include 'header.php';
include 'navbar.php';
?>


<div class="container-fluid">
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mt-1">Data User</h6>
            <div class="d-flex justify-content-end">
                <a class="btn btn-sm btn-success" href="" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                        class="bi bi-plus-lg"></i> Tambah User</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Nama Lengkap</th>
                            <th>Alamat</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        include('../koneksi.php');
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM user");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>

                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['nama_lengkap']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['level']; ?></td>
                            <td>
                                <a href="" data-bs-toggle="modal"
                                    data-bs-target="#modalEditUser<?php echo $row['id_user']; ?>"
                                    class="btn btn-info">Edit</a>
                                <a onclick="return confirm('yakin untuk dihapus?')"
                                    href="proses/hapus-user.php?id_user=<?= $row['id_user'] ?>"
                                    class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>

                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

<!-- modal tambah user -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/tambah-user.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username" class="mb-2">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="mb-2">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukkan Password">
                    </div>
                    <div class="form-group">
                        <label for="email" class="mb-2">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan Email">
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap" class="mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                            placeholder="Masukkan Nama lengkap">
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="mb-2">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat">
                    </div>
                    <div class="form-group">
                        <label for="level" class="mb-2">Level</label>
                        <select class="form-select" name="level" aria-label="Default select example">
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
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


<!-- modal edit user -->
<?php

$data = "SELECT * FROM user";
$result = mysqli_query($koneksi, $data);
while ($row = mysqli_fetch_array($result)) {

?>
<div class="modal fade" id="modalEditUser<?= $row['id_user']; ?>" tabindex="-1" aria-labelledby="modalEditUserLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalEditUserLabel">Edit Data User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="proses/edit-user.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="id_user" id="id_user" class="form-control"
                            value="<?= $row['id_user']; ?>">
                        <label for="username" class="mb-2">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="Masukkan Username" value="<?= $row['username']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password" class="mb-2">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Masukkan Password" value="<?= $row['password']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email" class="mb-2">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Masukkan Email"
                            value="<?= $row['email']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap" class="mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                            placeholder="Masukkan Nama Lengkap" value="<?= $row['nama_lengkap']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="mb-2">Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukkan Alamat"
                            value="<?= $row['alamat']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="level" class="mb-2">Level</label>
                        <input type="text" name="level" id="level" class="form-control" placeholder="Masukkan Level"
                            value="<?= $row['level']; ?>">
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