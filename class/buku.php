<?php
class Buku
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
            self::$instance = new Buku($pdo);
        }
        return self::$instance;
    }
    /**
     * Menambahkan buku baru ke database.
     *
     * @param string $nama_buku
     * @param string $tahun_penerbit
     * @return bool
     */
    public function add($nama_buku, $tahun_penerbit)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO buku (nama_buku, tahun_penerbit) VALUES (:nama_buku, :tahun_penerbit)");
            $stmt->execute([
                ':nama_buku' => $nama_buku,
                ':tahun_penerbit' => $tahun_penerbit,
            ]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Mengambil data buku berdasarkan ID.
     *
     * @param int $id_buku
     * @return array|false
     */
    public function getID($id_buku)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM buku WHERE id_buku = :id_buku");
            $stmt->execute([':id_buku' => $id_buku]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Memperbarui data buku berdasarkan ID.
     *
     * @param int $id_buku
     * @param string $nama_buku
     * @param string $id_penerbit
     * @param string $tahun_penerbit
     * @param string $id_pengarang
     * @return bool
     */
    public function update($id_buku, $nama_buku, $tahun_penerbit)
    {
        try {
            $stmt = $this->db->prepare("UPDATE buku SET nama_buku = :nama_buku, tahun_penerbit = :tahun_penerbit WHERE id_buku = :id_buku");
            $stmt->execute([
                ':id_buku' => $id_buku,
                ':nama_buku' => $nama_buku,
                ':tahun_penerbit' => $tahun_penerbit,
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
     * @param int $id_buku
     * @return bool
     */
    public function delete($id_buku)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM buku WHERE id_buku = :id_buku");
            $stmt->execute([':id_buku' => $id_buku]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Mengambil semua data buku.
     *
     * @return array|false
     */
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM buku");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
