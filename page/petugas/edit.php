<?php 

if (empty($_GET['id_petugas'])) {
    echo "<script> window.location.href = 'index.php?page=petugas' </script> ";
    exit();
}

$id_petugas = $_GET['id_petugas'];

if (isset($_POST['simpan'])) {

    $id_petugas = $_POST['id_petugas'];

    $pdo = koneksi::connect();
    $sql = "UPDATE petugas SET id_petugas = ? WHERE id_petugas = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_petugas,$id_petugas));
    koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=petugas' </script> ";
    exit();
} else {
    $pdo = koneksi::connect();
    $sql = "SELECT * FROM petugas WHERE id_petugas = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_petugas));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=petugas' </script> ";
        exit();
    }

    $petugas = $data['id_petugas'];
    koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Petugas</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Petugas</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Nama Petugas</label>
                <input name="nama_petugas" type="text" class="form-control" placeholder="" required value="<?php echo htmlspecialchars($nama_petugas); ?>">
            </div>
            
        <form action="" method="post">
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <input name="jenis_kelamin" type="text" class="form-control" placeholder="jenis_kelamin" required value="<?php echo htmlspecialchars($jenis_kelamin); ?>">
            </div>

            <form action="" method="post">
            <div class="form-group">
                <label>No Telepon</label>
                <input name="no_telepon" type="text" class="form-control" placeholder="no_telepon" required value="<?php echo htmlspecialchars($no_telepon); ?>">
            </div>

            <form action="" method="post">
            <div class="form-group">
                <label>Alamat Petugas</label>
                <input name="alamat_petugas" type="text" class="form-control" placeholder="alamat_petugas" required value="<?php echo htmlspecialchars($alamat_petugas); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=petugas" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>