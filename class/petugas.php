<?php

class petugas
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
            self::$instance = new petugas($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH PETUGAS START
    public function add( $nama_petugas, $jenis_kelamin, $no_telepon, $alamat_petugas)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO petugas (id_petugas, nama_petugas, jenis_kelamin, no_telepon, alamat_petugas) VALUES (:id_petugas, :nama_petugas, :jenis_kelamin, :no_telepon, :alamat_petugas)");
            $stmt->bindParam(":nama_petugas", $nama_petugas);
            $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindParam(":no_telepon", $no_telepon);
            $stmt->bindParam(":alamat_petugas", $alamat_petugas);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_petugas)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM petugas WHERE id_petugas = :id_petugas");
            $stmt->execute(array(":id_petugas" => $id_petugas));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH PETUGAS END

    // FUNCTION EDIT PETUGAS START
    public function update($id_petugas, $nama_petugas, $jenis_kelamin, $no_telepon, $alamat_petugas)
    {
        try {
            $stmt = $this->db->prepare("UPDATE petugas SET id_petugas = :id_petugas, nama_petugas = :nama_petugas, jenis_kelamin = :jenis_kelamin, no_telepon = :no_telepon, alamat_petugas = :alamat_petugas WHERE id_petugas = :id_petugas");
            $stmt->bindParam(":id_petugas", $id_petugas);
            $stmt->bindParam(":nama_petugas", $nama_petugas);
            $stmt->bindParam(":jenis_kelamin", $jenis_kelamin);
            $stmt->bindParam(":no_telepon", $no_telepon);
            $stmt->bindParam(":alamat_petugas", $alamat_petugas);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT PETUGAS END

    // FUNCTION DELETE PETUGAS START
    public function delete($id_petugas)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM petugas WHERE id_petugas = :id_petugas");
            $stmt->bindParam(":id_petugas", $id_petugas);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE PETUGAS END

    // FUNCTION GET ALL PETUGAS START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM petugas");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL PETUGAS END
}
?>