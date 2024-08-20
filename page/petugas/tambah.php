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
                <label>Jenis Kelamin</label> 
                <input name="jenis_kelamin" type="text" class="form-control" placeholder="Jenis Kelamin" required> <div class="form-group">
             </div>


            <div class="form-group">
                <label>No Telepon</label> 
                <input name="no_telepon" type="text" class="form-control" placeholder="No Telepon" required> <div class="form-group">
             </div>
              
        
            <div class="form-group">
                <label>Alamat Petugas</label> 
                <input name="alamat_petugas" type="text" class="form-control" placeholder="Alamat_petugas" required> <div class="form-group">
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


// if(isset($_POST['simpan'])){

//     $id_petugas = $_POST['id_petugas'];
//     $pdo = koneksi::connect();
//     $sql = "INSERT INTO petugas (id_petugas) VALUES (?)";
//     $q = $pdo->prepare($sql);
//     $q->execute(array($nama_petugas));

//     koneksi::disconnect();
//     echo "<script> window.location.href = 'index.php?page=petugas' </script> ";
// }
// 



if (isset($_POST['simpan'])) {
    $nama_petugas = htmlspecialchars($_POST['nama_petugas']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $no_telepon = htmlspecialchars($_POST['jenis_kelamin']);
    $jenis_kelamin = htmlspecialchars($_POST['no_telepon']);
    $alamat_petugas= htmlspecialchars($_POST['alamat_petugas']);

    $pdo = koneksi::connect();
    $member = petugas::getInstance($pdo);
    if ($member->tambah($nama, $alamat, $no_telp, $jenis_kelamin, $total_poin)) {
        echo "<script>window.location.href = 'index.php?page=member'</script>";
    } else {
        echo "Terjadi kesalahan saat menyimpan data.";
    }
}

?>