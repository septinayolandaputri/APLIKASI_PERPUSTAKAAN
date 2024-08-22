<?php
include("../../database/Koneksi.php");
include("../../class/buku.php");

// Memeriksa apakah ID buku ada di parameter GET
if (empty($_GET['id_buku'])) {
    header("Location: index.php?page=buku");
    exit();
}

$id_buku = $_GET['id_buku'];

// Proses form jika disubmit
if (isset($_POST['simpan'])) {

    $nama_buku = $_POST['nama_buku'];
    $tahun_penerbit = $_POST['tahun_penerbit'];
    

    try {
        $pdo = Koneksi::connect();
        $sql = "UPDATE buku SET nama_buku = :nama_buku, tahun_penerbit = :tahun_penerbit WHERE id_buku = :id_buku";
        $q = $pdo->prepare($sql);
        $q->execute(array(':nama_buku' => $nama_buku, ':tahun_penerbit' => $tahun_penerbit, ':id_buku' => $id_buku));
        Koneksi::disconnect();

        header("Location: index.php?page=buku");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    try {
        $pdo = Koneksi::connect();
        $sql = "SELECT * FROM buku WHERE id_buku = :id_buku";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id_buku' => $id_buku));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Koneksi::disconnect();

        if (!$data) {
            header("Location: index.php?page=buku");
            exit();
        }

        $nama_buku = $data['nama_buku'];
        $tahun_penerbit = $data['tahun_penerbit'];
       

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Buku</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama Buku</label>
                <input name="nama_buku" type="text" class="form-control" placeholder="Nama Buku" required value="<?php echo htmlspecialchars($nama_buku); ?>">
            </div>
            
            <div class="form-group">
                <label>Tahun Penerbit</label>
                <input name="tahun_penerbit" type="text" class="form-control" placeholder="Tahun Penerbit" required value="<?php echo htmlspecialchars($tahun_penerbit); ?>">
            </div>


            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=buku" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
