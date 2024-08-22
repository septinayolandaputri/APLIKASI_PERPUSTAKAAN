<?php
if (empty($_GET['id_peminjaman'])) {
    header("Location: index.php");
    exit();
}

$id_peminjaman = intval($_GET['id_peminjaman']); // Mengonversi ID ke integer

include("../../database/Koneksi.php");
include("../../class/peminjaman.php");

try {
    $pdo = Koneksi::connect();
    $peminjaman = Peminjaman::getInstance($pdo);
    $result = $peminjaman->delete($id_peminjaman);

    if ($result) {
        header("Location: index.php?page=peminjaman");
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
