<?php
if (empty($_GET['id_detail_peminjaman'])) {
    header("Location: index.php");
    exit();
}

$id_detail_peminjaman = intval($_GET['id_detail_peminjaman']); // Mengonversi ID ke integer

include("../../database/Koneksi.php");
include("../../class/detail_peminjaman.php");

try {
    $pdo = Koneksi::connect();
    $detail_peminjaman = Detail_peminjaman::getInstance($pdo);
    $result = $detail_peminjaman->delete($id_detail_peminjaman);

    if ($result) {
        header("Location: index.php?page=detail_peminjaman");
        exit();
    } else {
        echo "Terjadi kesalahan saat menghapus data.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    Koneksi::disconnect(); // Memastikan koneksi ditutup
}
?>
