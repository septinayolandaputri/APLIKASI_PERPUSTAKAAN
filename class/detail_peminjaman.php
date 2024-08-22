<?php

class detail_peminjaman
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
            self::$instance = new detail_peminjaman($pdo);
        }
        return self::$instance;
    }

    // FUNCTION TAMBAH DETAIL PEMINJAMAN START
   public function add($nama_buku, $id_peminjaman, $id_buku)
{
    try {
        // Menyiapkan query SQL
        $stmt = $this->db->prepare("INSERT INTO detail_peminjaman (nama_buku, id_peminjaman, id_buku) VALUES (:nama_buku, :id_peminjaman, :id_buku)");

        // Binding parameter dengan tipe yang sesuai
        $stmt->bindParam(":nama_buku", $nama_buku, PDO::PARAM_STR);
        $stmt->bindParam(":id_peminjaman", $id_peminjaman, PDO::PARAM_INT);
        $stmt->bindParam(":id_buku", $id_buku, PDO::PARAM_INT);

        // Mengeksekusi query
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        // Mencatat kesalahan ke log
        error_log("Error saat menyimpan data detail peminjaman: " . $e->getMessage());
        return false;
    }
}


    public function getID($id_detail_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM detail_peminjaman WHERE id_detail_peminjaman = :id_deatil_peminjaman");
            $stmt->execute(array(":id_detail_peminjaman" => $id_detail_peminjaman));
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION TAMBAH DETAIL_PEMINJAMAN END

    // FUNCTION EDIT DETAIL_PEMINJAMAN START
    public function update($id_detail_peminjaman, $nama_buku, $id_peminjaman, $id_buku)
    {
        try {
            $stmt = $this->db->prepare("UPDATE detail_peminjaman SET id_detail_peminjaman = :id_detail_peminjaman, nama_buku = :nama_buku, id_peminjaman = :id_peminjaman, id_buku = :id_buku WHERE id_detail_peminjaman = :id_detail_peminjaman");
            $stmt->bindParam(":id_detail_peminjaman", $id_detail_peminjaman);
            $stmt->bindParam(":nama_buku", $nama_buku);
            $stmt->bindParam(":id_peminjaman", $id_peminjaman);
            $stmt->bindParam(":id_bukun", $id_buku);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION EDIT DETAIL_PEMINJAMAN END

    // FUNCTION DELETE DETAIL_PEMINJAMNAN START
    public function delete($id_detail_peminjaman)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM detail_peminjaman WHERE id_detail_peminjaman = :id_detail_peminjaman");
            $stmt->bindParam(":id_detail_peminjaman", $id_detail_peminjaman);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION DELETE DETAIL_PEMINJAMAN END

    // FUNCTION GET ALL DETAIL_PEMINJAMAN START
    public function getAll()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM detail_peminjaman");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    // FUNCTION GET ALL DETAIL_PEMINJAMAN END
}
?>