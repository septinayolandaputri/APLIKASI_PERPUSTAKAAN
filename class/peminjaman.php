<?php

class Peminjaman
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
            self::$instance = new peminjaman($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH PEMINJAMAN START
    public function add( $id_anggota, $id_petugas, $tanggal_peminjaman, $tanggal_pengembalian)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO peminjaman (id_anggota, id_petugas, tanggal_peminjaman, tanggal_pengembalian) VALUES ( :id_anggota, :id_petugas, :tanggal_peminjaman, :tanggal_pengembalian)");
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->bindParam(":id_petugas", $id_petugas);
            $stmt->bindParam(":tanggal_peminjaman", $tanggal_peminjaman);
            $stmt->bindParam(":tanggal_pengembalian", $tanggal_pengembalian);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getID($id_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM peminjaman WHERE id_peminjaman = :id_peminjaman");
            $stmt->execute(array(":id_peminjaman" => $id_peminjaman));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH PEMINJAMAN END

    //FUNCTION EDIT PEMINJAMAN START
    public function update($id_peminjaman, $id_anggota, $id_petugas, $tanggal_peminjaman, $tanggal_pengembalian)
    {
        try {
            $stmt = $this->db->prepare("UPDATE peminjaman SET id_peminjaman = :id_peminjaman, id_anggota = :id_anggota, id_petugas = :id_petugas, tangga_peminjaman = :tanggal_peminjaman, tanggal_pengembalian = :tanggal_pengembakian WHERE id_peminjaman = :id_peminjaman");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->bindParam(":id_anggota", $id_anggota);
            $stmt->bindParam(":id_petugas", $id_petugas);
            $stmt->bindParam(":tanggal_peminjaman", $tanggal_peminjaman);
            $stmt->bindParam(":tanggal_pengembalian", $tanggal_pengembalian);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT PEMINJAMAN END

    // FUNCTION DELETE PEMINJAMAN START
    public function delete($id_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM peminjaman WHERE id_peminjaman = :id_peminjaman");
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE PEMINJAMAN END

    // FUNCTION GET ALL PEMINJAMAN START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM peminjaman");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL PEMINJAMAN END
}
?>