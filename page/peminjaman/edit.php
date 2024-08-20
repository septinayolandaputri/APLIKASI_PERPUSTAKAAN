<?php 

if (empty($_GET['id_peminjaman'])) {
    echo "<script> window.location.href = 'index.php?page=peminjaman' </script> ";
    exit();
}

$id_peminjaman = $_GET['id_peminjaman'];

if (isset($_POST['simpan'])) {

    $id_anggota= $_POST['id_peminjaman'];

    $pdo = koneksi::connect();
    $sql = "UPDATE peminjaman SET id_peminjaman = ? WHERE id_peminjaman = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_peminjaman,$id_peminjaman));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=peminjaman' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM peminjaman WHERE id_peminjaman = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_peminjaman));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=peminjaman' </script> ";
        exit();
    }

    $peminjaman = $data['id_peminjaman'];
    koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit peminjaman</title>
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
            
        <form action="" method="post">
            <div class="form-group">
                <label>Tanggal Pengembalian</label>
                <input name="tanggal_pengembalian" type="text" class="form-control" placeholder="Tanggal Pengembalian" required value="<?php echo htmlspecialchars($tanggal_pengembalian); ?>">
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