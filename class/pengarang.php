<?php

class Pengarang
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
            self::$instance = new Pengarang($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH PENGARANG START
    public function add($id_pengarang, $nama_pengarang, $asal_negara)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO pengarag (id_pengarang, nama_pengarang, asal_negara) VALUES (:id_pengarang, :nama_pengarang, :asal_negara)");
            $stmt->bindParam(":id_pengarang", $id_pengarang);
            $stmt->bindParam(":nama_pengarang", $nama_pengarang);
            $stmt->bindParam(":asal_negara", $asal_negara);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_pengarang)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pengarang WHERE id_pengarang = :id_pengarang");
            $stmt->execute(array(":id_pengarang" => $id_pengarang));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH PENGARANG END

    // FUNCTION EDIT PENGARANG START
    public function update($id_pengarang, $nama_pengarang, $asal_negara)
    {
        try {
            $stmt = $this->db->prepare("UPDATE pengarang SET nama_pengarang = :nama_pengarang, asal_negara = :asal_negara WHERE id_pengarang = :id_pengarang");
            $stmt->bindParam(":id_pengarang", $id_pengarang);
            $stmt->bindParam(":nama_pengarang", $nama_pengarang);
            $stmt->bindParam(":asal_negara", $asal_negara);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT PENGARANG END

    // FUNCTION DELETE PENGARANG START
    public function delete($id_pengarang)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM pengarang WHERE id_pengarang = :id_pengarang");
            $stmt->bindParam(":id_pengarang", $id_pengarang);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE PENGARANG END

    // FUNCTION GET ALL PENGARANG START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM pengarang");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL PENGARANG END
}
?>