<?php
class Anggota
{
    private $db;
    private static $instance = null;

    private function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new Anggota($pdo);
        }
        return self::$instance;
    }
    /**
     * Menambahkan anggota baru ke database.
     *
     * @param string $nama_anggota
     * @param string $jenis_kelamin
     * @param string $no_telepon
     * @param string $alamat
     * @return bool
     */
    public function add($nama_anggota, $jenis_kelamin, $no_telepon, $alamat)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO anggota (nama_anggota, jenis_kelamin, no_telepon, alamat) VALUES (:nama_anggota, :jenis_kelamin, :no_telepon, :alamat)");
            $stmt->execute([
                ':nama_anggota' => $nama_anggota,
                ':jenis_kelamin' => $jenis_kelamin,
                ':no_telepon' => $no_telepon,
                ':alamat' => $alamat
            ]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Mengambil data anggota berdasarkan ID.
     *
     * @param int $id_anggota
     * @return array|false
     */
    public function getID($id_anggota)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->execute([':id_anggota' => $id_anggota]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Memperbarui data anggota berdasarkan ID.
     *
     * @param int $id_anggota
     * @param string $nama_anggota
     * @param string $jenis_kelamin
     * @param string $no_telepon
     * @param string $alamat
     * @return bool
     */
    public function update($id_anggota, $nama_anggota, $jenis_kelamin, $no_telepon, $alamat)
    {
        try {
            $stmt = $this->db->prepare("UPDATE anggota SET nama_anggota = :nama_anggota, jenis_kelamin = :jenis_kelamin, no_telepon = :no_telepon, alamat = :alamat WHERE id_anggota = :id_anggota");
            $stmt->execute([
                ':id_anggota' => $id_anggota,
                ':nama_anggota' => $nama_anggota,
                ':jenis_kelamin' => $jenis_kelamin,
                ':no_telepon' => $no_telepon,
                ':alamat' => $alamat
            ]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Menghapus data anggota berdasarkan ID.
     *
     * @param int $id_anggota
     * @return bool
     */
    public function delete($id_anggota)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->execute([':id_anggota' => $id_anggota]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Mengambil semua data anggota.
     *
     * @return array|false
     */
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
