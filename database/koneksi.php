<?php
class Koneksi 
{
    private static $dbName = 'aplikasi_perpustakaan'; // Nama database
    private static $dbHost = 'localhost'; // Host database
    private static $dbUsername = 'root'; // Username database
    private static $dbPass = ''; // Password database

    private static $instance = null; // Instansi PDO

    private function __construct() {
        // Mencegah pembuatan instance baru melalui konstruktor
        die('Init function is not allowed');
    }

    public static function connect()
    {
        // Jika belum ada instansi PDO yang dibuat
        if (null == self::$instance)
        {
            try
            {
                // Membuat koneksi ke database dengan PDO
                self::$instance = new PDO(
                    "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
                    self::$dbUsername,
                    self::$dbPass
                );
                // Mengatur mode kesalahan PDO
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                // Menangani kesalahan koneksi
                die($e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function disconnect()
    {
        // Memutuskan koneksi dengan mengatur instansi menjadi null
        self::$instance = null;
    }
}
?>
