<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Peminjaman</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Tanggal Peminjaman</label>
                <input name="tanggal_peminjaman" type="text" class="form-control" placeholder="Tanggal Peminjaman" required>
            </div>


            <div class="form-group">
                <label>Tanggal Pengembalian</label> 
                <input name="tanggal_pengembalian" type="text" class="form-control" placeholder="Tanggal Pengembalian" required> <div class="form-group">
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

<?php


if (isset($_POST['simpan'])){

    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];



    include("../../database/Koneksi.php");
    include("../../class/peminjaman.php");
    $pdo = Koneksi::connect();
    $peminjaman = peminjaman::getInstance($pdo);
    if (empty($tanggal_peminjaman) || empty($tanggal_pengembalian)) {
        echo '<script>window.location="index.php?page=peminjaman&alert=err1"</script>'; 
    } else if ($peminjaman->add($tanggal_peminjaman, $tanggal_pengembalian)) {
        echo '<script>window.location="index.php?page=peminjaman&alert=success1"</script>';
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>