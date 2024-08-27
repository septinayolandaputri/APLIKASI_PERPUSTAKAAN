<?php
include_once "database/class/petugas.php";
include_once "database/koneksi.php";

// Mengamankan nilai 'act' dari parameter URL
$act = isset($_GET['act']) ? htmlspecialchars($_GET['act']) : '';

switch ($act) {
    case 'tambah':
        include 'tambah.php';
        break;
    case 'edit':
        include 'edit.php';
        break;
    case 'hapus':
        include 'hapus.php';
        break;
    default:
        include 'index.php';
        break;
}
