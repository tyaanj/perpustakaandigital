<?php

// Mulai output dokumen Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-Peminjaman-Buku.xls");

include '../koneksi.php';


$query = mysqli_query($koneksi, "SELECT peminjaman.id_peminjaman, user.username, buku.judul, peminjaman.tgl_peminjaman, peminjaman.tgl_pengembalian, peminjaman.status_peminjaman
FROM peminjaman
JOIN user ON peminjaman.id_user = user.id_user
JOIN buku ON peminjaman.id_buku = buku.id_buku
WHERE id_peminjaman");
?>
<?php

// Mulai output dokumen Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-Peminjaman-Buku.xls");

?>
<!-- Mulai output dokumen Excel -->


<h5>Laporan Peminjaman Buku</h5>
<hr>
<table border="2" class="table table-striped table-bordered">
    <tr class="fw-bold">
        <td>No</td>
        <td>Nama Peminjam</td>
        <td>Judul</td>
        <td>Tanggal Peminjaman</td>
        <td>Tanggal Pengembalian</td>
        <td>Status Peminjaman</td>
    </tr>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_array($query)) {
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['judul']; ?></td>
        <td><?php echo $row['tgl_peminjaman']; ?></td>
        <td><?php echo $row['tgl_pengembalian']; ?></td>
        <td><?php echo $row['status_peminjaman']; ?></td>
    </tr>
    <?php } ?>
</table>