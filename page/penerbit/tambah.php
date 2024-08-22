<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penerbit</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Penerbit</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Penerbit</label>
                <input name="nama_penerbit" type="text" class="form-control" placeholder="Nama Penerbit" required>
            </div>


            <div class="form-group">
                <label>Asal Negara</label> 
                <input name="asal_negara" type="text" class="form-control" placeholder="Asal Negara" required> <div class="form-group">
             </div>

              

             <div class="form-group">
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php?page=penerbit" class="btn btn-secondary">Kembali</a>
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

    $nama_penerbit = $_POST['nama_penerbit'];
    $asal_negara = $_POST['asal_negara'];



    include("../../database/Koneksi.php");
    include("../../class/penerbit.php");
    $pdo = Koneksi::connect();
    $penerbit = penerbit::getInstance($pdo);
    if (empty($nama_penerbit) || empty($asal_negara)) {
        echo '<script>window.location="index.php?page=penerbit&alert=err1"</script>'; 
    } else if ($penerbit->add($nama_penerbit, $asal_negara)) {
        echo '<script>window.location="index.php?page=penerbit&alert=success1"</script>';
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>