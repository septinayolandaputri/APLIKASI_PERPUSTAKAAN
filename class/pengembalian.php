<?php

class Pengembalian
{
    private $db;
    private static $instance = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function getInstance($pdo)
    {
        if (self::$instance == null) {
            self::$instance = new pengembalian($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH PENGEMBALIAN START
    public function add($tanggal_pengembalian, $jumlah_pinjam)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO pengembalian (tanggal_pengembalian, jumlah_pinjam) VALUES (:tanggal_pengembalian, :jumlah_pinjam)");
            $stmt->bindParam(":tanggal_pengembalian", $tanggal_pengembalian);
            $stmt->bindParam(":jumlah_pinjam", $jumlah_pinjam);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_pengembalian)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pengembalian WHERE id_pengembalian = :id_pengembalian");
            $stmt->execute(array(":id_pengembalian" => $id_pengembalian));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH PENGEMBALIAN END

    //FUNCTION EDIT PENGEMBALIAN START
    public function update($id_pengembalian, $id_peminjaman, $id_petugas, $tanggal_pengembalian, $id_buku, $jumlah_pinjam)
    {
        try {
            $stmt = $this->db->prepare("UPDATE pengembalian SET id_peminjaman = :id_peminjaman, id_petugas = :id_petugas, tanggal_pengembalian = :tanggal_pengembalian, id_buku = :id_buku, jumlah_pinjam = :jumlah_pinjam WHERE id_pengembalian = :id_pengembalian");
            $stmt->bindParam(":id_pengembalian", $id_pengembalian);
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->bindParam(":id_petugas", $id_petugas);
            $stmt->bindParam(":tanggal_pengembalian", $tanggal_pengembalian);
            $stmt->bindParam(":id_buku", $id_buku);
            $stmt->bindParam(":jumlah_pinjam", $jumlah_pinjam);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT PENGEMBALIAN END

    // FUNCTION DELETE PENGEMBALIAN START
    public function delete($id_pengembalian)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM pengembalian WHERE id_pengembalian = :id_pengembalian");
            $stmt->bindParam(":id_pengembalian", $id_pengembalian);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE PENGEMBALIAN END

    // FUNCTION GET ALL PENGEMBALIAN START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pengembalian");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL PENGEMBALIAN END
}
?>