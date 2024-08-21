<?php
if (empty($_GET['id_buku'])) header("Location: index.php");

$id_buku = $_GET['id_buku'];

$pdo = koneksi::connect();
$buku = buku::getInstance($pdo);
$result = $buku->delete($id_buku);
if ($result) {

    echo "<script>window.location.href = 'index.php?page=buku';</script>";
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

koneksi::disconnect();
?>