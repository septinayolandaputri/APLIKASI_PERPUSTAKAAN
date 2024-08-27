<?php
include("../../database/Koneksi.php");
include("../../class/pengembalian.php");

// Memeriksa apakah ID  pengembalian ada di parameter GET
if (empty($_GET['id_pengembalian'])) {
    header("Location: index.php?page=pengembalian");
    exit();
}

$id_pengembalian = $_GET['id_pengembalin'];

// Proses form jika disubmit
if (isset($_POST['simpan'])) {
    $tanggal_pengembalian = htmlspecialchars($_POST['tanggal_pengembalian']);
    $jumlah_pinjam = htmlspecialchars($_POST['jumlah_pinjam']);
   

    try {
        $pdo = Koneksi::connect();
        $sql = "UPDATE pengembalian SET tanggal_pengembalian = :tanggal_pengembalian, jumlah_pinjam = :jumlah_pinjam WHERE id_pengembalian= :id_pengembalian";
        $q = $pdo->prepare($sql);
        $q->execute(array(':tanggal_pengembalian' => $tanggal_pengembalian, ':jumlah_pinjam' => $jumlah_pinjam, ':id_pengembalian' => $id_pengembalian));
        Koneksi::disconnect();

        header("Location: index.php?page=pengembalian");
        exit();
    } catch (PDOException $e) {
        error_log("Error saat memperbarui pengembalian: " . $e->getMessage());
        echo "Terjadi kesalahan. Silakan coba lagi.";
    }

} else {
    try {
        $pdo = Koneksi::connect();
        $sql = "SELECT * FROM pengembalian WHERE id_pengembalian = :id_pengembalian";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id_pengembalian' => $id_pengembalian));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            header("Location: index.php?page=pengembalian");
            exit();
        }

        $tanggal_pengembalian= htmlspecialchars($data['tanggal_pengembalian']);
        $jumlah_pinjam = htmlspecialchars($data['jumlah_pinjam']);
        
    } catch (PDOException $e) {
        error_log("Error saat mengambil data  pengembalian: " . $e->getMessage());
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
    <title>Edit  Pengembalian</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Pengembalian</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Tanggal Pengembalian</label>
                <input name="tanggal_pengembalian" type="text" class="form-control" placeholder="Tanggal Pengembalian" required value="<?php echo htmlspecialchars($tanggal_pengembalian); ?>">
            </div>
            
            <div class="form-group">
                <label>Jumlah Pinjam</label>
                <input name="jumlah_pinjam" type="text" class="form-control" placeholder="Jumlah Pinjam" required value="<?php echo htmlspecialchars($jumlah_pinjam); ?>">
            </div>


            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=pengembalian" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
