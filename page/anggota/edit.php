<?php
include("../../database/Koneksi.php");
include("../../class/anggota.php");

// Memeriksa apakah ID anggota ada di parameter GET
if (empty($_GET['id_anggota'])) {
    header("Location: index.php?page=anggota");
    exit();
}

$id_anggota = $_GET['id_anggota'];

// Proses form jika disubmit
if (isset($_POST['simpan'])) {

    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nama_anggota = $_POST['nama_anggota'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    try {
        $pdo = Koneksi::connect();
        $sql = "UPDATE anggota SET jenis_kelamin = :jenis_kelamin, nama_anggota = :nama_anggota, no_telepon = :no_telepon, alamat = :alamat WHERE id_anggota = :id_anggota";
        $q = $pdo->prepare($sql);
        $q->execute(array(':jenis_kelamin' => $jenis_kelamin, ':nama_anggota' => $nama_anggota, ':no_telepon' => $no_telepon, ':alamat' => $alamat, ':id_anggota' => $id_anggota));
        Koneksi::disconnect();

        header("Location: index.php?page=anggota");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    try {
        $pdo = Koneksi::connect();
        $sql = "SELECT * FROM anggota WHERE id_anggota = :id_anggota";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id_anggota' => $id_anggota));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Koneksi::disconnect();

        if (!$data) {
            header("Location: index.php?page=anggota");
            exit();
        }

        $jenis_kelamin = $data['jenis_kelamin'];
        $nama_anggota = $data['nama_anggota'];
        $no_telepon = $data['no_telepon'];
        $alamat = $data['alamat'];

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
            
            <div class="form-group">
                <label>Nama Anggota</label>
                <input name="nama_anggota" type="text" class="form-control" placeholder="Nama Anggota" required value="<?php echo htmlspecialchars($nama_anggota); ?>">
            </div>

            <div class="form-group">
                <label>No Telepon</label>
                <input name="no_telepon" type="text" class="form-control" placeholder="No Telepon" required value="<?php echo htmlspecialchars($no_telepon); ?>">
            </div>

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
