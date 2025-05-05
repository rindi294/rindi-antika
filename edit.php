<?php
include "koneksi.php";

if (isset($_GET['npm'])) {
    $npm = $_GET['npm'];
    $query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE npm='$npm'");
    $data = mysqli_fetch_assoc($query);
} else {
    echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'NPM tidak ditemukan!',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.location.href = 'index.php';
            });
        };
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #d3d3d3, #f0f0f0, #c0c0c0);
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 400px;
            margin: 50px auto;
            padding: 25px 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #bbb;
            margin-bottom: 15px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #888;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #666;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #555;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Mahasiswa</h2>
    <form action="" method="post">
        <label>NPM</label>
        <input type="text" name="npm" value="<?= $data['npm'] ?>" readonly>

        <label>Nama</label>
        <input type="text" name="nama" value="<?= $data['nama'] ?>" required>

        <label>Program Studi</label>
        <select name="prodi" required>
            <option value="">--Pilih Prodi--</option>
            <?php
            $prodi_list = ["Pendidikan Informatika", "Teknologi Informasi", "Sistem Informasi", "Teknik Komputer", "Teknik Informatika"];
            foreach ($prodi_list as $p) {
                $selected = ($p == $data['prodi']) ? "selected" : "";
                echo "<option value='$p' $selected>$p</option>";
            }
            ?>
        </select>

        <label>Email</label>
        <input type="email" name="email" value="<?= $data['email'] ?>">

        <label>Alamat</label>
        <textarea name="alamat"><?= $data['alamat'] ?></textarea>

        <input type="submit" name="update" value="Update Data">
    </form>
    <a class="back-link" href="index.php">← Kembali ke Daftar Mahasiswa</a>
</div>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];

    $update = mysqli_query($conn, "UPDATE mahasiswa SET 
        nama='$nama',
        prodi='$prodi',
        email='$email',
        alamat='$alamat' 
        WHERE npm='$npm'");

    if ($update) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data berhasil diperbarui',
                confirmButtonColor: '#888'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data gagal diperbarui',
                confirmButtonColor: '#d33'
            });
        </script>";
    }
}
?>

</body>
</html>
