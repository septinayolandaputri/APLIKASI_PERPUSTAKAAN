<?php

class Penerbit
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
            self::$instance = new Penerbit($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH PENERBIT START
    public function add($id_penerbit, $nama_penerbit, $asal_negara)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO penerbit (id_penerbit, nama_penerbit, asal_negara) VALUES (:id_penerbit, :nama_penerbit, :asal_negara)");
            $stmt->bindParam(":id_penerbit", $id_penerbit);
            $stmt->bindParam(":nama_penerbit", $nama_penerbit);
            $stmt->bindParam(":asal_negara", $asal_negara);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_penerbit)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM penerbit WHERE id_penerbit = :id_penerbit");
            $stmt->execute(array(":id_penerbit" => $id_penerbit));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH PENERBIT END

    // FUNCTION EDIT PENERBIT START
    public function update($id_penerbit, $nama_penerbit, $asal_negara)
    {
        try {
            $stmt = $this->db->prepare("UPDATE penerbit SET nama_penerbit = :nama_penerbit, asal_negara = :asal_negara WHERE id_penerbit = :id_penerbit");
            $stmt->bindParam(":id_penerbit", $id_penerbit);
            $stmt->bindParam(":nama_penerbit", $nama_penerbit);
            $stmt->bindParam(":asal_negara", $asal_negara);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT PENERBIT END

    // FUNCTION DELETE PENERBIT START
    public function delete($id_penerbit)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM penerbit WHERE id_penerbit = :id_penerbit");
            $stmt->bindParam(":id_penerbit", $id_penerbit);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE PENERBIT END

    // FUNCTION GET ALL PENERBIT START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM penerbit");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL PENERBIT END
}
?>