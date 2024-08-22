<?php
if (empty($_GET['id_anggota'])) {
    header("Location: index.php");
    exit();
}

$id_anggota = $_GET['id_anggota'];

// Sanitasi parameter jika perlu
$id_anggota = htmlspecialchars($id_anggota, ENT_QUOTES, 'UTF-8');

include("../../database/Koneksi.php");
include("../../class/anggota.php");
$pdo = Koneksi::connect();
$anggota = Anggota::getInstance($pdo);
$result = $anggota->delete($id_anggota);

if ($result) {
    header("Location: index.php?page=anggota");
    exit();
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

Koneksi::disconnect();
?>
