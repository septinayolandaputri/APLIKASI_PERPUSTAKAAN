<?php
class Koneksi 
{
    private static $dbName = 'aplikasi_perpustakaan'; 
    private static $dbHost = 'localhost'; 
    private static $dbUsername = 'root'; 
    private static $dbPass = ''; 

    private static $instance = null; // Instansi PDO

    // Konstruktor private untuk mencegah pembuatan instance baru
    private function __construct() {
        // Mencegah pembuatan instance baru melalui konstruktor
        die('Init function is not allowed');
    }

    // Metode untuk menghubungkan ke database
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
                self::logError($e);
                die('Database connection error. Please try again later.');
            }
        }
        return self::$instance;
    }

    // Metode untuk memutuskan koneksi
    public static function disconnect()
    {
        self::$instance = null;
    }

    // Metode untuk mencatat kesalahan ke file log
    private static function logError($e)
    {
        $logFile = 'path/to/error_log.txt'; // Ganti dengan path yang sesuai
        $errorMessage = date('Y-m-d H:i:s') . ' - ' . $e->getMessage() . PHP_EOL;
        file_put_contents($logFile, $errorMessage, FILE_APPEND);
    }
}
?>
