<?php
include("../../database/Koneksi.php");
include("../../class/pengarang.php");

// Memeriksa apakah ID  pengarang ada di parameter GET
if (empty($_GET['id_pengarang'])) {
    header("Location: index.php?page=pengarang");
    exit();
}

$id_pengarang = $_GET['id_pengarang'];

// Proses form jika disubmit
if (isset($_POST['simpan'])) {
    $nama_pengarang = htmlspecialchars($_POST['nama_pengarang']);
    $asal_negara = htmlspecialchars($_POST['asal_negara']);
   

    try {
        $pdo = Koneksi::connect();
        $sql = "UPDATE pengarang SET nama_pengarang = :nama_pengarang, asal_negara = :asal_negara WHERE id_pengarang = :id_pengarang";
        $q = $pdo->prepare($sql);
        $q->execute(array(':nama_pengarang' => $nama_pengarang, ':asal_negara' => $asal_negara, ':id_pengarang' => $id_pengarang));
        Koneksi::disconnect();

        header("Location: index.php?page=pengarang");
        exit();
    } catch (PDOException $e) {
        error_log("Error saat memperbarui pengarang: " . $e->getMessage());
        echo "Terjadi kesalahan. Silakan coba lagi.";
    }

} else {
    try {
        $pdo = Koneksi::connect();
        $sql = "SELECT * FROM pengarang WHERE id_pengarang = :id_pengarang";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id_pengarang' => $id_pengarang));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            header("Location: index.php?page=pengarang");
            exit();
        }

        $nama_pengarang= htmlspecialchars($data['nama_pengarang']);
        $asal_negara = htmlspecialchars($data['asal_negara']);
        
    } catch (PDOException $e) {
        error_log("Error saat mengambil data  pengarang: " . $e->getMessage());
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
    <title>Edit  Pengarang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Pengarang</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama Pengarang</label>
                <input name="nama_pengarang" type="text" class="form-control" placeholder="Nama Pengarang" required value="<?php echo htmlspecialchars($nama_pengarang); ?>">
            </div>
            
            <div class="form-group">
                <label>Asal Negara</label>
                <input name="asal_negara" type="text" class="form-control" placeholder="Asal Negara" required value="<?php echo htmlspecialchars($asal_negara); ?>">
            </div>


            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=pengarang" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
