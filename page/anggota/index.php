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
                        <th>JENIS KELAMIN</th>
                        <th>NAMA ANGGOTA</th>
                        <th>NO TELEPON</th>
                        <th>ALAMAT</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../database/koneksi.php');
                    include('../../class/anggota.php');

                    // Membuat koneksi ke database
                    $pdo = Koneksi::connect();

                    // Mendapatkan instance dari class Anggota
                    $anggota = Anggota::getInstance($pdo);


                    // Mengambil data anggota
                    $dataAnggota = $anggota->getAll();

                    $no = 1;
                    foreach ($dataAnggota as $row) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['jenis_kelamin'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_anggota'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['no_telepon'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['alamat'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="edit.php?page=anggota&act=edit&id_anggota=<?php echo $row['id_anggota']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?page=anggota&act=hapus&id_anggota=<?php echo $row['id_anggota']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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
