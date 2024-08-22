<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Anggota</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Anggota</label>
                <input name="nama_anggota" type="text" class="form-control" placeholder="Nama Anggota" required>
            </div>
           
    
            <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" >
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>


            <div class="form-group">
                <label>No Telepon</label> 
                <input name="no_telepon" type="text" class="form-control" placeholder="No Telepon" required> <div class="form-group">
             </div>
              
        
            <div class="form-group">
                <label>Alamat </label> 
                <input name="alamat" type="text" class="form-control" placeholder="Alamat" required> <div class="form-group">
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

<?php


if (isset($_POST['simpan'])){
    $nama_anggota = $_POST['nama_anggota'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];


    include("../../database/Koneksi.php");
    include("../../class/anggota.php");
    $pdo = Koneksi::connect();
    $anggota = anggota::getInstance($pdo);
    if (empty($nama_anggota) || empty($jenis_kelamin) || empty($no_telepon) || empty($alamat)) {
        echo '<script>window.location="index.php?page=anggota&alert=err1"</script>'; 
    } else if ($anggota->add($nama_anggota, $jenis_kelamin, $no_telepon, $alamat)) {
        echo '<script>window.location="index.php?page=anggota&alert=success1"</script>';
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>