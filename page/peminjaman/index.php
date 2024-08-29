<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
    <?php
    include_once "../../layout/css.php";
    ?>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Peminjaman</h3>
            <a href="tambah.php?page=peminjaman&act=tambah" class="btn btn-primary">Tambah Peminjaman</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NO</th>
                        <th>TANGGAL_PEMINJAMAN</th>
                        <th>TANGGAL_PENGEMBALIAN</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../database/koneksi.php');
                    include('../../class/peminjaman.php');

                    // Membuat koneksi ke database
                    $pdo = Koneksi::connect();

                    // Mendapatkan instance dari class  peminjaman
                    $peminjaman = peminjaman::getInstance($pdo);


                    // Mengambil data peminjaman
                    $dataPeminjaman = $peminjaman->getAll();

                    $no = 1;
                    foreach ($dataPeminjaman as $row) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal_peminjaman'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['tanggal_pengembalian'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="edit.php?page=peminjaman&act=edit&id_peminjaman=<?php echo $row['id_peminjaman']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?page=peminjaman&act=hapus&id_peminjaman=<?php echo $row['id_peminjaman']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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
    <?php
    include_once "../../layout/js.php";
    ?>
</body>
</html>
