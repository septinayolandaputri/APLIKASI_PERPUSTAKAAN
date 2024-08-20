<?php
if (empty($_GET['id_peminjaman'])) header("Location: index.php");

$id_peminjaman = $_GET['id_peminjaman'];

$pdo = koneksi::connect();
$peminjaman = peminjaman::getInstance($pdo);
$result = $peminjaman->delete($id_prminjaman);
if ($result) {

    echo "<script>window.location.href = 'index.php?page=peminjaman';</script>";
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

koneksi::disconnect();
?>