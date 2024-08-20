<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Anggota</h3>
            <a href="tambah.php?page=anggota&act=tambah" class="btn btn-primary">Tambah Anggota</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NO</th>
                        <th>JENIS_KELAMIN</th>
                        <th>NAMA_ANGGOTA</th>
                        <th>NO_TELEPON</th>
                        <th>ALAMAT</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../database/koneksi.php');
                    //include('../../class/anggota.php');
                   $pdo = Koneksi::connect();
                    $sql ='SELECT * FROM anggota';
                   foreach ($pdo->query($sql) as $row) {
                    ?>  
                        <tr>
                            <td><?php echo $row['id_anggota']; ?></td>
                            <td>
                                <a href="edit.php?page=anggota&act=edit&id_anggota=<?php echo $row['id_anggota'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?page=anggota&act=hapus&id_anggota=<?php echo $row['id_anggota'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda ingin menghapus data ini ?')">Hapus</a>
                            </td>   
                        </tr>
                    <?php
                    Koneksi::disconnect();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>