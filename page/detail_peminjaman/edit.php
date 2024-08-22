<?php
include("../../database/Koneksi.php");
include("../../class/detail_peminjaman.php");

// Memeriksa apakah ID detail peminjaman ada di parameter GET
if (empty($_GET['id_detail_peminjaman'])) {
    header("Location: index.php?page=detail_peminjaman");
    exit();
}

$id_detail_peminjaman = $_GET['id_detail_peminjaman'];

// Proses form jika disubmit
if (isset($_POST['simpan'])) {
    $nama_buku = htmlspecialchars($_POST['nama_buku']);
    $id_peminjaman = htmlspecialchars($_POST['id_peminjaman']);
    $id_buku = htmlspecialchars($_POST['id_buku']);

    try {
        $pdo = Koneksi::connect();
        $sql = "UPDATE detail_peminjaman SET nama_buku = :nama_buku, id_peminjaman = :id_peminjaman, id_buku = :id_buku WHERE id_detail_peminjaman = :id_detail_peminjaman";
        $q = $pdo->prepare($sql);
        $q->execute(array(':nama_buku' => $nama_buku, ':id_peminjaman' => $id_peminjaman, ':id_buku' => $id_buku, ':id_detail_peminjaman' => $id_detail_peminjaman));
        Koneksi::disconnect();

        header("Location: index.php?page=detail_peminjaman");
        exit();
    } catch (PDOException $e) {
        error_log("Error saat memperbarui detail peminjaman: " . $e->getMessage());
        echo "Terjadi kesalahan. Silakan coba lagi.";
    }

} else {
    try {
        $pdo = Koneksi::connect();
        $sql = "SELECT * FROM detail_peminjaman WHERE id_detail_peminjaman = :id_detail_peminjaman";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id_detail_peminjaman' => $id_detail_peminjaman));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            header("Location: index.php?page=detail_peminjaman");
            exit();
        }

        $nama_buku = htmlspecialchars($data['nama_buku']);
        $id_peminjaman = htmlspecialchars($data['id_peminjaman']);
        $id_buku = htmlspecialchars($data['id_buku']);

    } catch (PDOException $e) {
        error_log("Error saat mengambil data detail peminjaman: " . $e->getMessage());
        echo "Terjadi kesalahan. Silakan coba lagi.";
    } finally {
        Koneksi::disconnect(); // Memastikan koneksi ditutup
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Detail Peminjaman</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Detail Peminjaman</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama Buku</label>
                <input name="nama_buku" type="text" class="form-control" placeholder="Nama Buku" required value="<?php echo htmlspecialchars($nama_buku); ?>">
            </div>
            
            <div class="form-group">
                <label>Id Peminjaman</label>
                <input name="id_peminjaman" type="text" class="form-control" placeholder="id_peminjaman" required value="<?php echo htmlspecialchars($id_peminjaman); ?>">
            </div>

            <div class="form-group">
                <label>Id Buku</label>
                <input name="id_buku" type="text" class="form-control" placeholder="id_buku" required value="<?php echo htmlspecialchars($id_buku); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=detail_peminjaman" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
