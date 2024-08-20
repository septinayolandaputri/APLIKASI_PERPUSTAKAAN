<?php

class Buku
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
            self::$instance = new Buku($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH BUKU START
    public function add($id_buku, $nama_buku, $id_penerbit, $tahun_penerbit, $id_pengarang)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO buku (id_buku, nama_buku, id_penerbit, tahun_penerbit, id_pengarang) VALUES (:id_buku, :nama_buku, :id_penerbit, :tahun_penerbit, :id_pengarang)");
            $stmt->bindParam(":id_buku", $id_buku);
            $stmt->bindParam(":nama_buku", $nama_buku);
            $stmt->bindParam(":id_penerbit", $id_penerbit);
            $stmt->bindParam(":tahun_penerbit", $tahun_penerbit);
            $stmt->bindParam(":id_pengarang", $id_pengarang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_buku)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM buku WHERE id_buku = :id_buku");
            $stmt->execute(array(":id_buku" => $id_buku));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH BUKU END

    // FUNCTION EDIT BUKU START
    public function update($id_buku, $nama_buku, $id_penerbit, $tahun_penerbit, $id_pengarang)
    {
        try {
            $stmt = $this->db->prepare("UPDATE buku SET nama_buku = :nama_buku, id_penerbit = :id_penerbit, tahun_penerbit= :tahun_penerbit, id_pengarang = :id_pengarang WHERE id_buku = :id_buku");
            $stmt->bindParam(":id_buku", $id_buku);
            $stmt->bindParam(":nama_buku", $nama_buku);
            $stmt->bindParam(":id_penerbit", $id_penerbit);
            $stmt->bindParam(":tahun_penerbit", $tahun_penerbit);
            $stmt->bindParam(":id_pengarang", $id_pengarang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT BUKU END

    // FUNCTION DELETE BUKU START
    public function delete($id_buku)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM buku WHERE id_buku = :id_buku");
            $stmt->bindParam(":id_buku", $id_buku);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE BUKU END

    // FUNCTION GET ALL BUKU START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM buku");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL BUKU END
}
?>