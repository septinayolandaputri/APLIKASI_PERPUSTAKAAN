<?php

class Anggota
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
            self::$instance = new Anggota($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH ANGGOTA START
    public function add($id_anggota, $nama_anggota, $jenis_kelamin, $no_telepon, $alamat)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO anggota (id_anggota, nama_anggota, jenis_kelamin, no_telepon, alamat) VALUES (:id_angota, :nama_anggota, :jenis_kelamin, :no_telepon, :alamat)");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->bindParam(":nama_anggota", $nama_anggota);
            $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindParam(":no_telepon", $no_telepon);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_anggota)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->execute(array(":id_anggota" => $id_anggota));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH ANGGOTA END

    // FUNCTION EDIT ANGGOTA START
    public function update($id_anggota, $nama_anggota, $jenis_kelamin, $no_telepon, $alamat)
    {
        try {
            $stmt = $this->db->prepare("UPDATE anggota SET nama_anggota = :nama_anggota, jenis_kelamin = :jenis_kelamin, no_telepon = :no_telepon, alamat = :alamat WHERE id_anggota = :id_anggota");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->bindParam(":nama_anggota", $nama_anggota);
            $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindParam(":no_telepon", $no_telepon);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT ANGGOTA END

    // FUNCTION DELETE ANGGOTA START
    public function delete($id_anggota)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM anggota WHERE id_anggota = :id_anggota");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE ANGGOTA END

    // FUNCTION GET ALL ANGGOTA START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM anggota");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL ANGGOTA END
}
?>