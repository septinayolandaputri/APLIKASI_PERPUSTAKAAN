<?php
include('../../database/koneksi.php');
include('../../class/pengarang.php');

// Membuat koneksi ke database
$pdo = Koneksi::connect();

// Mendapatkan instance dari class Pengarang
$pengarang = Pengarang::getInstance($pdo);

// Mengambil data pengarang
$dataPengarang = $pengarang->getAll();

// Pengecekan untuk memastikan dataPengarang adalah array
if ($dataPengarang === false || !is_array($dataPengarang)) {
    echo "<div class='alert alert-danger'>Gagal mengambil data pengarang.</div>";
    // Menutup koneksi dan hentikan eksekusi lebih lanjut
    Koneksi::disconnect();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengarang</title>
    <?php
    include_once "../../layout/css.php";
    ?>
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-4">
            <h3>Pengarang</h3>
            <a href="tambah.php?page=pengarang&act=tambah" class="btn btn-primary">Tambah Pengarang</a>
        </div>
        <div>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>NO</th>
                        <th>NAMA PENGARANG</th>
                        <th>ASAL NEGARA</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($dataPengarang as $row) {
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($no++, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_pengarang'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($row['asal_negara'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="edit.php?page=pengarang&act=edit&id_pengarang=<?php echo htmlspecialchars($row['id_pengarang'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapus.php?page=pengarang&act=hapus&id_pengarang=<?php echo htmlspecialchars($row['id_pengarang'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <?php
    include_once "../../layout/js.php";
    ?>
</body>
</html>
<?php
// Menutup koneksi database
Koneksi::disconnect();
?>
