<?php
if (empty($_GET['id_petugas'])) {
    header("Location: index.php");
    exit();
}

$id_petugas = $_GET['id_petugas'];

// Sanitasi parameter jika perlu
$id_petugas = htmlspecialchars($id_petugas, ENT_QUOTES, 'UTF-8');

include("../../database/Koneksi.php");
include("../../class/petugas.php");
$pdo = Koneksi::connect();
$petugas = petugas::getInstance($pdo);
$result = $petugas->delete($id_petugas);

if ($result) {
    header("Location: index.php?page=petugas");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

Koneksi::disconnect();
?>
