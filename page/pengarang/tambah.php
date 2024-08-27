<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengarang</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Pengarang</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Pengarang</label>
                <input name="nama_pengarang" type="text" class="form-control" placeholder="Nama Pengarang" required>
            </div>


            <div class="form-group">
                <label>Asal Negara</label> 
                <input name="asal_negara" type="text" class="form-control" placeholder="Asal Negara" required>
             </div>

              

             <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=pengarang" class="btn btn-secondary">Kembali</a>
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

    $nama_pengarang = $_POST['nama_pengarang'];
    $asal_negara = $_POST['asal_negara'];



    include("../../database/Koneksi.php");
    include("../../class/pengarang.php");
    $pdo = Koneksi::connect();
    $pengarang = pengarang::getInstance($pdo);
    if (empty($nama_pengarang) || empty($asal_negara)) {
        echo '<script>window.location="index.php?page=pengarang&alert=err1"</script>'; 
    } else if ($pengarang->tambah($nama_pengarang, $asal_negara)) {
        echo '<script>window.location="index.php?page=pengarang&alert=success1"</script>';
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>