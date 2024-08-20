<?php
if (empty($_GET['id_anggota'])) header("Location: index.php");

$id_anggota = $_GET['id_anggota'];

$pdo = koneksi::connect();
$anggota = anggota::getInstance($pdo);
$result = $anggota->delete($id_anggota);
if ($result) {

    echo "<script>window.location.href = 'index.php?page=anggota';</script>";
} else {
    echo "Terjadi kesalahan saat menghapus data.";
}

koneksi::disconnect();
?>