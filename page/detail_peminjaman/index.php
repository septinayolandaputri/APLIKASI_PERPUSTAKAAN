<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman</title>
    <?php
    include_once "../../layout/css.php";
    ?>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Buku</h3>
            <a href="tambah.php?page=detail_peminjaman&act=tambah" class="btn btn-primary">Tambah Detail Peminjaman</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NO</th>
                        <th>NAMA_BUKU</th>
                        <th>ID_PEMINJAMAN</th>
                        <th>ID_BUKU</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../database/koneksi.php');
                    include('../../class/detail_peminjaman.php');

                    // Membuat koneksi ke database
                    $pdo = Koneksi::connect();

                    // Mendapatkan instance dari class detail peminjaman
                    $detail_peminjaman = Detail_peminjaman::getInstance($pdo);


                    // Mengambil data detail peminjaman
                    $dataDetail_peminjaman = $detail_peminjaman->getAll();

                    $no = 1;
                    foreach ($dataDetail_peminjaman as $row) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($row['nama_buku'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['id_peminjaman'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['id_buku'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="edit.php?page=detail_peminjaman&act=edit&id_detail_peminjaman=<?php echo $row['id_detail_peminjaman']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?page=detail_peminjaman&act=hapus&id_detail_peminjaman=<?php echo $row['id_detail_peminjaman']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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
