<?php
class Koneksi
{
    private static $dbName = 'aplikasi_perpustakaan';
    private static $dbHost = 'localhost';
    private static $dbUsername = 'root';
    private static $dbPass = '';

    private static $instance = null;
    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect()
    {
        if (null == self::$instance)
        {
            try
            {
                self::$instance = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbUsername, self::$dbPass);
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$instance;
    } 

    public static function disconnect()
    {
        self::$instance = null;
    }
}
?>
   