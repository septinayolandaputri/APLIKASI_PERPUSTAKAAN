<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Petugas</h3>
            <a href="tambah.php?page=petugas&act=tambah" class="btn btn-primary">Tambah Petugas</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NO</th>
                        <th>NAMA_PETUGAS</th>
                        <th>JENIS_KELAMIN</th>
                        <th>NO_TELEPON</th>
                        <th>ALAMAT</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../database/koneksi.php');
                    include('../../class/petugas.php');
                   $pdo = Koneksi::connect();
                    $sql ='SELECT * FROM petugas';
                   foreach ($pdo->query($sql) as $row) {
                    ?>  
                        <tr>
                            <td><?php echo $row['id_petugas']; ?></td>
                            <td>
                                <a href="edit.php?page=petugas&act=edit&id_petugas=<?php echo $row['id_petugas'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?page=petugas&act=hapus&id_petugas=<?php echo $row['id_petugas'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('apakah anda ingin menghapus data ini ?')">Hapus</a>
                            </td>   
                        </tr>
                    <?php
                    koneksi::disconnect();
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