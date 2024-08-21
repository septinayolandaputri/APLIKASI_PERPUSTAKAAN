<?php 

if (empty($_GET['id_anggota'])) {
    echo "<script> window.location.href = 'index.php?page=anggota' </script> ";
    exit();
}

$id_anggota = $_GET['id_anggota'];

if (isset($_POST['simpan'])) {

    $nama_anggota = $_POST['nama_anggota'];

    $pdo = Koneksi::connect();
    $sql = "UPDATE anggota SET nama_anggota = :nama_anggota WHERE id_anggota = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($nama_anggota,$id_anggota));
    Koneksi::disconnect();

    echo "<script> window.location.href = 'index.php?page=anggota' </script> ";
    exit();
} else {
    $pdo = Koneksi::connect();
    $sql = "SELECT * FROM anggota WHERE id_anggota = :id_anggota";
    $q = $pdo->prepare($sql);
    $q->execute(array($id_anggota));
    $data = $q->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        echo "<script> window.location.href = 'index.php?page=anggota' </script> ";
        exit();
    }

    $nama_anggota = $data['nama_anggota'];
    Koneksi::disconnect();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Edit Anggota</h3>
        </div>

        <form action="" method="post">
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <input name="jenis_kelamin" type="text" class="form-control" placeholder="Jenis Kelamin" required value="<?php echo htmlspecialchars($jenis_kelamin); ?>">
            </div>
            
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Anggota</label>
                <input name="nama_anggota" type="text" class="form-control" placeholder="Nama Anggota" required value="<?php echo htmlspecialchars($nama_anggota); ?>">
            </div>

            <form action="" method="post">
            <div class="form-group">
                <label>No Telepon</label>
                <input name="no_telepon" type="text" class="form-control" placeholder="No Telepon" required value="<?php echo htmlspecialchars($no_telepon); ?>">
            </div>

            <form action="" method="post">
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" type="text" class="form-control" placeholder="Alamat" required value="<?php echo htmlspecialchars($alamat); ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=anggota" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>