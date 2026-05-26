<?php
require_once __DIR__ . '/../core/Database.php';

class Sinhvien {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }


    public function getAll() {
        $sql = "SELECT * FROM sinhvien";
        $stmt = $this->db->conn->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
