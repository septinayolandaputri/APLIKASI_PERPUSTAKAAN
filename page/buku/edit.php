<?php 

if (empty($_GET['id_buku'])) {
    echo "<script> window.location.href = 'index.php?page=buku' </script> ";
    exit();
}

$id_buku = $_GET['id_buku'];

if (isset($_POST['simpan'])) {

    $nama_buku = $_POST['nama_buku'];

    $pdo = koneksi::connect();
    $sql = "UPDATE buku SET nama_buku = ? WHERE id_buku = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_buku,$id_buku));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=buku' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM buku WHERE buku = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_buku));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=buku' </script> ";
        exit();
    }

    $nama_buku = $data['nama_buku'];
    koneksi::disconnect();
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
            
        <form action="" method="post">
            <div class="form-group">
                <label>tahun_penerbit</label>
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