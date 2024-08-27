<?php
if (empty($_GET['id_pengarang'])) {
    header("Location: index.php");
    exit();
}

$id_pengarang = intval($_GET['id_pengarang']); // Mengonversi ID ke integer

include("../../database/Koneksi.php");
include("../../class/pengarang.php");

try {
    $pdo = Koneksi::connect();
    $pengarang = Pengarang::getInstance($pdo);
    $result = $pengarang->delete($id_pengarang);

    if ($result) {
        header("Location: index.php?page=pengarang");
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
