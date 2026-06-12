<?php
require_once '../app/core/DB.php';

class LopModel {
    private $conn;
    public function __construct(){
        $this->conn = connectDB::Connect();
    }

    public function getAllLop(){
        $query = "SELECT * FROM tbl_lop";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data){
        $query = "INSERT INTO tbl_lop (tenlop, mota) VALUES (:tenlop, :mota)";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute($data)){
            return true;
        }else{
            return false;
        }
    }

    public function getById($id){
        $query = "SELECT * FROM tbl_lop WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function paging($limit = 5, $offset = 0, $search = '')
    {
        $search = trim($search);
        if (!empty($search)) {
            $query = "SELECT * FROM tbl_lop WHERE tenlop LIKE :search OR mota LIKE :search LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        } else {
            $query = "SELECT * FROM tbl_lop LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($search)) {
            $countQuery = $this->conn->prepare("SELECT COUNT(*) FROM tbl_lop WHERE tenlop LIKE :search OR mota LIKE :search");
            $countQuery->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $countQuery->execute();
            $totalRecords = $countQuery->fetchColumn();
        } else {
            $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM tbl_lop");
            $totalRecords   = $selectAllQuery->fetchColumn();
        }
        $totalPages     = ceil($totalRecords / $limit);
        return ['lops' => $result, 'totalpage' => $totalPages, 'totalrecords' => $totalRecords];
    }

    public function update($id, $data)
    {
        $query = "UPDATE tbl_lop SET tenlop = :tenlop, mota = :mota WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':tenlop', $data['tenlop'], PDO::PARAM_STR);
        $stmt->bindValue(':mota', $data['mota'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM tbl_lop WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>