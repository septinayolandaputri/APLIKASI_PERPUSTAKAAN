<?php
include("../../database/Koneksi.php");
include("../../class/peminjaman.php");

// Memeriksa apakah ID  peminjaman ada di parameter GET
if (empty($_GET['id_peminjaman'])) {
    header("Location: index.php?page=peminjaman");
    exit();
}

$id_peminjaman = $_GET['id_peminjaman'];

// Proses form jika disubmit
if (isset($_POST['simpan'])) {
    $tanggal_peminjaman = htmlspecialchars($_POST['tanggal_peminjaman']);
    $tanggal_pengembalian = htmlspecialchars($_POST['tanggal_pengembalian']);
   

    try {
        $pdo = Koneksi::connect();
        $sql = "UPDATE peminjaman SET tanggal_pengembalian = :tanggal_peminjaman, tanggal_pengembalian = :tanggal_pengembalian WHERE id_peminjaman = :id_peminjaman";
        $q = $pdo->prepare($sql);
        $q->execute(array(':tanggal_peminjaman' => $tanggal_peminjaman, ':tanggal_pengembalian' => $tanggal_pengembalian, ':id_peminjaman' => $id_peminjaman));
        Koneksi::disconnect();

        header("Location: index.php?page=peminjaman");
        exit();
    } catch (PDOException $e) {
        error_log("Error saat memperbarui peminjaman: " . $e->getMessage());
        echo "Terjadi kesalahan. Silakan coba lagi.";
    }

} else {
    try {
        $pdo = Koneksi::connect();
        $sql = "SELECT * FROM peminjaman WHERE id_peminjaman = :id_peminjaman";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id_peminjaman' => $id_peminjaman));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            header("Location: index.php?page=peminjaman");
            exit();
        }

        $tanggal_peminjaman = htmlspecialchars($data['tanggal_peminjaman']);
        $tanggal_pengembalian = htmlspecialchars($data['tanggal_pengembalian']);
        
    } catch (PDOException $e) {
        error_log("Error saat mengambil data  peminjaman: " . $e->getMessage());
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
    <title>Edit  Peminjaman</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Peminjaman</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Tanggal Peminjaman</label>
                <input name="tanggal_peminjaman" type="text" class="form-control" placeholder="Tanggal Peminjaman" required value="<?php echo htmlspecialchars($tanggal_peminjaman); ?>">
            </div>
            
            <div class="form-group">
                <label>Tanggal Pengembalian</label>
                <input name="tanggal_pengembalian" type="text" class="form-control" placeholder="tanggal_pengembalian" required value="<?php echo htmlspecialchars($tanggal_pengembalian); ?>">
            </div>


            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=peminjaman" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
