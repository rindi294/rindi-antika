<?php
$feedback = ""; // Untuk menyimpan skrip JS feedback

if (isset($_POST['submit'])) {
    $npm = trim($_POST['npm']);
    $nama = trim($_POST['nama']);
    $prodi = $_POST['prodi'];
    $email = trim($_POST['email']);
    $alamat = trim($_POST['alamat']);

    if ($npm == "" || $nama == "" || $prodi == "" || $email == "" || $alamat == "") {
        $feedback = "
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                text: 'Semua kolom harus diisi!',
                confirmButtonColor: '#808080'
            });
        ";
    } else {
        include "koneksi.php";
        $hasil = mysqli_query($conn, "INSERT INTO mahasiswa (npm, nama, prodi, email, alamat)
                                      VALUES ('$npm', '$nama', '$prodi', '$email', '$alamat')");

        if ($hasil) {
            $feedback = "
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil disimpan',
                    confirmButtonColor: '#808080'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            ";
        } else {
            $feedback = "
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan saat menyimpan data',
                    confirmButtonColor: '#808080'
                });
            ";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Tambah Data Mahasiswa</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #808080, #c0c0c0, #d3d3d3);
            margin: 0;
            padding: 0;
        }

        form {
            width: 420px;
            margin: 40px auto;
            padding: 25px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #808080;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        h3, p {
            text-align: center;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #808080;
        }

        a:hover {
            color: #555;
        }
    </style>
</head>

<body>

    <h3>Entry Data Mahasiswa</h3>
    <p>Silakan masukkan data mahasiswa berdasarkan formulir berikut:</p>

    <form action="" method="post">
        <table>
            <tr>
                <td><label for="npm">NPM:</label></td>
                <td><input type="text" name="npm" id="npm" maxlength="12" required></td>
            </tr>
            <tr>
                <td><label for="nama">Nama:</label></td>
                <td><input type="text" name="nama" id="nama" required></td>
            </tr>
            <tr>
                <td><label for="prodi">Program Studi:</label></td>
                <td>
                    <select name="prodi" id="prodi" required>
                        <option value="">--Pilih Prodi--</option>
                        <option value="Pendidikan Informatika">Pendidikan Informatika</option>
                        <option value="Teknologi Informasi">Teknologi Informasi</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknik Komputer">Teknik Komputer</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" id="email" required></td>
            </tr>
            <tr>
                <td><label for="alamat">Alamat:</label></td>
                <td><textarea name="alamat" id="alamat" rows="3" required></textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit" value="Simpan Data"></td>
            </tr>
        </table>
    </form>

    <p style="text-align: center; margin-top: 10px;">
        <a href="index.php">← Kembali ke Daftar Mahasiswa</a>
    </p>

    <!-- Tampilkan SweetAlert jika ada -->
    <script>
        <?= $feedback ?>
    </script>

</body>
</html>
