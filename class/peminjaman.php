<?php

class peminjaman
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
   public function add($tanggal_peminjaman, $tanggal_pengembalian)
{
    try {
        // Menyiapkan query SQL
        $stmt = $this->db->prepare("INSERT INTO peminjaman (tanggal_peminjaman, tanggal_pengembalian) VALUES (:tanggal_peminjaman, :tanggal_pengembalian)");

        // Binding parameter dengan tipe yang sesuai
        $stmt->bindParam(":tanggal_peminjaman", $tanggal_peminjaman, PDO::PARAM_STR);
        $stmt->bindParam(":tanggal_pengembalian", $tanggal_pengembalian, PDO::PARAM_INT);

        // Mengeksekusi query
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        // Mencatat kesalahan ke log
        error_log("Error saat menyimpan data  peminjaman: " . $e->getMessage());
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

    // FUNCTION EDIT PEMINJAMAN START
    public function update($id_peminjaman, $tanggal_peminjaman, $tanggal_pengembalian)
    {
        try {
            // SQL statement with consistent parameter names
            $stmt = $this->db->prepare("UPDATE peminjaman SET tanggal_peminjaman = :tanggal_peminjaman, tanggal_pengembalian = :tanggal_pengembalian WHERE id_peminjaman = :id_peminjaman");
            
            // Bind parameters with correct names
            $stmt->bindParam(":id_peminjaman", $id_peminjaman, PDO::PARAM_INT);
            $stmt->bindParam(":tanggal_peminjaman", $tanggal_peminjaman);
            $stmt->bindParam(":tanggal_pengembalian", $tanggal_pengembalian);
            
            // Execute the statement
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            // Use error logging for production environments
            error_log("Error updating peminjaman: " . $e->getMessage());
            echo "Terjadi kesalahan saat memperbarui data.";
            return false;
        }
    }
    // FUNCTION EDIT PEMINJAMAN END

    // FUNCTION DELETE PEMINJAMNAN START
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