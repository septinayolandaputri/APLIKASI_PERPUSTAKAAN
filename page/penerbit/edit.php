<?php
include("../../database/Koneksi.php");
include("../../class/penerbit.php");

// Memeriksa apakah ID  penerbit ada di parameter GET
if (empty($_GET['id_penerbit'])) {
    header("Location: index.php?page=penerbit");
    exit();
}

$id_penerbit = $_GET['id_penerbit'];

// Proses form jika disubmit
if (isset($_POST['simpan'])) {
    $nama_penerbit = htmlspecialchars($_POST['nama_penerbit']);
    $asal_negara = htmlspecialchars($_POST['asal_negara']);
   

    try {
        $pdo = Koneksi::connect();
        $sql = "UPDATE penerbit SET nama_penerbit = :nama_penerbit, asal_negara = :asal_negara WHERE id_penerbit = :id_penerbit";
        $q = $pdo->prepare($sql);
        $q->execute(array(':nama_penerbit' => $nama_penerbit, ':asal_negara' => $asal_negara, ':id_penerbit' => $id_penerbit));
        Koneksi::disconnect();

        header("Location: index.php?page=penerbit");
        exit();
    } catch (PDOException $e) {
        error_log("Error saat memperbarui penerbit: " . $e->getMessage());
        echo "Terjadi kesalahan. Silakan coba lagi.";
    }

} else {
    try {
        $pdo = Koneksi::connect();
        $sql = "SELECT * FROM penerbit WHERE id_penerbit = :id_penerbit";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id_penerbit' => $id_penerbit));
        $data = $q->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            header("Location: index.php?page=penerbit");
            exit();
        }

        $nama_penerbit = htmlspecialchars($data['nama_penerbit']);
        $asal_negara = htmlspecialchars($data['asal_negara']);
        
    } catch (PDOException $e) {
        error_log("Error saat mengambil data  penerbit: " . $e->getMessage());
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
    <title>Edit  Penerbit</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Penerbit</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama Penerbit</label>
                <input name="nama_penerbit" type="text" class="form-control" placeholder="Nama Penerbit" required value="<?php echo htmlspecialchars($nama_penerbit); ?>">
            </div>
            
            <div class="form-group">
                <label>Asal Negara</label>
                <input name="asal_negara" type="text" class="form-control" placeholder="Asal Negara" required value="<?php echo htmlspecialchars($asal_negara); ?>">
            </div>


            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=penerbit" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
