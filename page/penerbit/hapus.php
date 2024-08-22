<?php
if (empty($_GET['id_penerbit'])) {
    header("Location: index.php");
    exit();
}

$id_penerbit = intval($_GET['id_penerbit']); // Mengonversi ID ke integer

include("../../database/Koneksi.php");
include("../../class/penerbit.php");

try {
    $pdo = Koneksi::connect();
    $penerbit = Penerbit::getInstance($pdo);
    $result = $penerbit->delete($id_penerbit);

    if ($result) {
        header("Location: index.php?page=penerbit");
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
