<?php
if (empty($_GET['id_petugas'])) header("Location: index.php");

$id_petugas = $_GET['id_petugas'];

$pdo = koneksi::connect();
$petugas = petugas::getInstance($pdo);
$result = $petugas->delete($id_petugas);
if ($result) {

    echo "<script>window.location.href = 'index.php?page=petugas';</script>";
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

koneksi::disconnect();
?>