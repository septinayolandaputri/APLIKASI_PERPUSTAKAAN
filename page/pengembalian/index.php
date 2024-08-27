<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Pengembalian</h3>
            <a href="tambah.php?page=pengembalian&act=tambah" class="btn btn-primary">Tambah Pengembalian</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NO</th>
                        <th>TANGGAL_PENGEMBALIAN</th>
                        <th>JUMLAH_PINJAM</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../database/koneksi.php');
                    include('../../class/pengembalian.php');

                    // Membuat koneksi ke database
                    $pdo = Koneksi::connect();

                    // Mendapatkan instance dari class pengembalian
                    $pengembalian = pengembalian::getInstance($pdo);


                    // Mengambil data pengembalian
                    $dataPengembalian = $pengembalian->getAll();

                    $no = 1;
                    foreach ($dataPengembalian as $row) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal_pengembalian'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['jumlah_pinjam'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="edit.php?page=pengembalian&act=edit&id_pengembalian=<?php echo $row['id_pengembalian']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?page=pengembalian&act=hapus&id_pengembalian=<?php echo $row['id_pengembalian']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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
