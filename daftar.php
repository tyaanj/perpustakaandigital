<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login Perustakaan
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>
    body {
    background-image: url('assets/img/bg2.jpg');
    /* Ganti 'path/to/your/image.jpg' dengan path gambar Anda */
    /*background-size: contain;
    /* Untuk memastikan gambar latar belakang menutupi seluruh halaman */
    background-position: center;
    /* Untuk mengatur posisi gambar latar belakang ke tengah halaman */
    /* Jika Anda ingin menggunakan warna latar belakang alih-alih gambar, gunakan properti background-color */
    /* Misalnya: background-color: #f0f0f0; */
    }
    </style>

<body>
    <div class="container">
        <div class="content">
            <div class="card mt-3  md-5">
                <div class="row">
                    <div class="col-sm-6 text-center">
                        <img src="assets/img/register.png" width="550px">
                    </div>
                    <div class="col-sm-6">
                        <div class="card-body">
                            <h3>Silahkan Isi Form Berikut untuk Pendaftaran</h3>
                            <form method="post" action="proses_daftar.php">
                                <div class="form-group mt-5">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label>Name Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control">
                                </div>
                                <div class="form-group mt-2">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control">
                                </div>
                                <div class="from-group mt-3">
                                    <button type="submit" class="btn btn-primary">Daftar Akun</button>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Sudah punya akun silahkan klik tombol berikut :</label>
                                    <a href="index.php" class="btn btn-warning">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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