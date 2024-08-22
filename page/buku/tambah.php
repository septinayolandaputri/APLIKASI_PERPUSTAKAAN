<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Buku</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Buku</label>
                <input name="nama_buku" type="text" class="form-control" placeholder="Nama Buku" required>
            </div>


            <div class="form-group">
                <label>Tahun Penerbit</label> 
                <input name="tahun_penerbit" type="text" class="form-control" placeholder="Tahun Penerbit" required> <div class="form-group">
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

<?php


if (isset($_POST['simpan'])){

    $nama_buku= $_POST['nama_buku'];
    $tahun_penerbit = $_POST['tahun_penerbit'];


    include("../../database/Koneksi.php");
    include("../../class/buku.php");
    $pdo = Koneksi::connect();
    $buku = buku::getInstance($pdo);
    if (empty($nama_buku) || empty($tahun_penerbit)) {
        echo '<script>window.location="index.php?page=buku&alert=err1"</script>'; 
    } else if ($buku->add($nama_buku, $tahun_penerbit)) {
        echo '<script>window.location="index.php?page=anggota&alert=success1"</script>';
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>