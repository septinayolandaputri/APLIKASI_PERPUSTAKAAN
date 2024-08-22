<?php
if (empty($_GET['id_buku'])) {
    header("Location: index.php");
    exit();
}

$id_buku = $_GET['id_buku'];

// Sanitasi parameter jika perlu
$id_anggota = htmlspecialchars($id_buku, ENT_QUOTES, 'UTF-8');

include("../../database/Koneksi.php");
include("../../class/buku.php");
$pdo = Koneksi::connect();
$buku = Buku::getInstance($pdo);
$result = $buku->delete($id_buku);

if ($result) {
    header("Location: index.php?page=buku");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

Koneksi::disconnect();
?>
