<?php
include_once "database/class/pengembalian.php";
include_once "database/Koneksi.php";



$act = isset($_GET['act']) ? $_GET['act'] : '';
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