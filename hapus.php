<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Data</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #d3d3d3, #f0f0f0, #c0c0c0);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .message {
            background: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .message h2 {
            color: #333;
        }
    </style>
</head>
<body>

<div class="message">
    <?php
    if (isset($_GET['npm'])) {
        include "koneksi.php";
        $npm = $_GET['npm'];

        $hapus = mysqli_query($conn, "DELETE FROM mahasiswa WHERE npm='$npm'");

        if ($hapus) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data berhasil dihapus',
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
                    text: 'Data gagal dihapus',
                    confirmButtonColor: '#d33'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'NPM tidak ditemukan',
                confirmButtonColor: '#999'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    }
    ?>
</div>

</body>
</html>
