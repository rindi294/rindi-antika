<?php
include "koneksi.php";
$query = mysqli_query($conn, "SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e0e0e0, #bfbfbf, #a1a1a1, #808080, #616161);
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #bfbfbf;
        }
        a.button {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px 5px;
            background-color: #808080;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #616161;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Mahasiswa</h2>
        <a href="tambah.php" class="button">Tambah Mahasiswa</a>
        <table>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php while($data = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $data['npm'] ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['prodi'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td>
                    <a href="edit.php?npm=<?= $data['npm'] ?>" class="button">Edit</a>
                    <a href="hapus.php?npm=<?= $data['npm'] ?>" class="button" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
