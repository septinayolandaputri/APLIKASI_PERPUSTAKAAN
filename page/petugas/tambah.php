<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Petugas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
    <div class="container mt-5">
        <div class="mb-4">
            <h3>Tambah Petugas</h3>
        </div>
        
        <form action="" method="post">
            <div class="form-group">
                <label>Nama Petugas</label>
                <input name="nama_petugas" type="text" class="form-control" placeholder="Nama Petugas" required>
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
                <label>Alamat Petugas</label> 
                <input name="alamat_petugas" type="text" class="form-control" placeholder="Alamat Petugas" required> <div class="form-group">
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

<?php


if (isset($_POST['simpan'])){
    $nama_petugas = $_POST['nama_petugas'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telepon = $_POST['no_telepon'];
    $alamat_petugas = $_POST['alamat_petugas'];


    include("../../database/Koneksi.php");
    include("../../class/petugas.php");
    $pdo = Koneksi::connect();
    $petugas = Petugas::getInstance($pdo);
    if (empty($nama_petugas) || empty($jenis_kelamin) || empty($no_telepon) || empty($alamat_petugas)) {
        echo '<script>window.location="index.php?page=petugas&alert=err1"</script>'; 
    } else if ($petugas->add($nama_petugas, $jenis_kelamin, $no_telepon, $alamat_petugas)) {
        echo '<script>window.location="index.php?page=petugas&alert=success1"</script>';
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}
?>