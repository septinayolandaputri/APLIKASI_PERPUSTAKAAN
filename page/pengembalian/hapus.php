<?php
if (empty($_GET['id_pengembalian'])) {
    header("Location: index.php");
    exit();
}

$id_pengembalian= intval($_GET['id_pengembalian']); // Mengonversi ID ke integer

include("../../database/Koneksi.php");
include("../../class/pengembalian.php");

try {
    $pdo = Koneksi::connect();
    $pengembalian = Pengembalian::getInstance($pdo);
    $result = $pengembalian->delete($id_pengembalian);

    if ($result) {
        header("Location: index.php?page=pengembalian");
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
