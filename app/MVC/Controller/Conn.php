<?php
class Conn {
    private $host = "localhost";
    private $username = "root";
    private $password = "quy25102005";
    private $database = "quanly_sinhvien";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
?>
