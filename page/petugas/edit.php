<?php
include("../../database/Koneksi.php");
include("../../class/petugas.php");

// Memeriksa apakah ID petugas ada di parameter GET
if (empty($_GET['id_petugas'])) {
    header("Location: index.php?page=petugas");
    exit();
}

$id_petugas = $_GET['id_petugas'];

// Proses form jika disubmit
if (isset($_POST['simpan'])) {

    $nama_petugas = $_POST['nama_petugas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telepon = $_POST['no_telepon'];
    $alamat_petugas = $_POST['alamat_petugas'];

    try {
        $pdo = Koneksi::connect();
        $sql = "UPDATE petugas SET nama_petugas = :nama_petugas, jenis_kelamin = :jenis_kelamin,  no_telepon = :no_telepon, alamat_petugas = :alamat_petugas WHERE id_petugas= :id_petugas";
        $q = $pdo->prepare($sql);
        $q->execute(array(':nama_petugas' => $nama_petugas, ':jenis_kelamin' => $jenis_kelamin, ':no_telepon' => $no_telepon, ':alamat_petugas' => $alamat_petugas, ':id_petugas' => $id_petugas));
        Koneksi::disconnect();

        header("Location: index.php?page=petugas");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    try {
        $pdo = Koneksi::connect();
        $sql = "SELECT * FROM petugas WHERE id_petugas = :id_petugas";
        $q = $pdo->prepare($sql);
        $q->execute(array(':id_petugas' => $id_petugas));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Koneksi::disconnect();

        if (!$data) {
            header("Location: index.php?page=petugas");
            exit();
        }

        $nama_petugas = $data['nama_petugas'];
        $jenis_kelamin = $data['jenis_kelamin'];
        $no_telepon = $data['no_telepon'];
        $alamat_petugas = $data['alamat_petugas'];

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
                <input name="nama_petugas" type="text" class="form-control" placeholder="Nama Petugas" required value="<?php echo htmlspecialchars($nama_petugas); ?>">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <input name="jenis_kelamin" type="text" class="form-control" placeholder="Jenis Kelamin" required value="<?php echo htmlspecialchars($jenis_kelamin); ?>">
            </div>

            <div class="form-group">
                <label>No Telepon</label>
                <input name="no_telepon" type="text" class="form-control" placeholder="No Telepon" required value="<?php echo htmlspecialchars($no_telepon); ?>">
            </div>

            <div class="form-group">
                <label>Alamat Petugas</label>
                <input name="alamat_petugas" type="text" class="form-control" placeholder="Alamat Petugas" required value="<?php echo htmlspecialchars($alamat_petugas); ?>">
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
