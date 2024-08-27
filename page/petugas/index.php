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
                        <th>NAMA PETUGAS</th>
                        <th>JENIS KELAMIN</th>
                        <th>NO TELEPON</th>
                        <th>ALAMAT PETUGAS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../database/koneksi.php');
                    include('../../class/petugas.php');

                    // Membuat koneksi ke database
                    $pdo = Koneksi::connect();

                    // Mendapatkan instance dari class Petugas
                    $petugas = Petugas::getInstance($pdo);


                    // Mengambil data petugas
                    $dataPetugas = $petugas->getAll();

                    $no = 1;
                    foreach ($dataPetugas as $row) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_petugas'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['jenis_kelamin'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['no_telepon'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat_petugas'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="edit.php?page=petugas&act=edit&id_petugas=<?php echo $row['id_petugas']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?page=petugas&act=hapus&id_petugas=<?php echo $row['id_petugas']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }

                    // Menutup koneksi database
                    Koneksi::disconnect();
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
