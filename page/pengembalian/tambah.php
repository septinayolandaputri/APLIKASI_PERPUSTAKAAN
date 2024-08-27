<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengembalian</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Pengembalian</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Tanggal Pengembalian</label>
                <input name="tanggal_pengembalian" type="text" class="form-control" placeholder="Tanggal Pengembalian" required>
            </div>


            <div class="form-group">
                <label>Jumlah Pinjam</label> 
                <input name="jumlah_pinjam" type="text" class="form-control" placeholder="Jumlah Pinjam" required> <div class="form-group">
             </div>

              

             <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=pengembalian" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php


if (isset($_POST['simpan'])){

    $tanggal_pengembalian= $_POST['tanggal_pengembalian'];
    $jumlah_pinjam = $_POST['jumlah_pinjam'];



    include("../../database/Koneksi.php");
    include("../../class/pengembalian.php");
    $pdo = Koneksi::connect();
    $pengembalian = pengembalian::getInstance($pdo);
    if (empty($tanggal_pengembalian) || empty($jumlah_pinjam)) {
        echo '<script>window.location="index.php?page=pengembalian&alert=err1"</script>'; 
    } else if ($pengembalian->add($tanggal_pengembalian, $jumlah_pinjam)) {
        echo '<script>window.location="index.php?page=pengembalian&alert=success1"</script>';
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>