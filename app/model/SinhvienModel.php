<?php
require_once '../app/core/DB.php';
class sinhvienModel
{
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB::Connect();
    }
    public function getAllSinhVien()
    {
        $query = "SELECT sv.*, l.tenlop FROM tbl_sinhviens sv LEFT JOIN tbl_lop l ON sv.malop = l.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($data)
    {
        $query = "INSERT INTO tbl_sinhviens (hoten, gioitinh, mssv, malop) VALUES (:hoten, :gioitinh, :mssv, :malop)";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }
    public function paging($limit = 5, $offset = 0, $search = '')
    {
        $search = trim($search);
        if (!empty($search)) {
            $query = "SELECT sv.*, l.tenlop FROM tbl_sinhviens sv LEFT JOIN tbl_lop l ON sv.malop = l.id WHERE sv.hoten LIKE :search OR sv.mssv LIKE :search OR l.tenlop LIKE :search LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
        } else {
            $query = "SELECT sv.*, l.tenlop FROM tbl_sinhviens sv LEFT JOIN tbl_lop l ON sv.malop = l.id LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($query);
        }
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

         
        if (!empty($search)) {
            $countQuery = $this->conn->prepare("SELECT COUNT(*) FROM tbl_sinhviens sv LEFT JOIN tbl_lop l ON sv.malop = l.id WHERE sv.hoten LIKE :search OR sv.mssv LIKE :search OR l.tenlop LIKE :search");
            $countQuery->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
            $countQuery->execute();
            $totalRecords = $countQuery->fetchColumn();
        } else {
            $selectAllQuery = $this->conn->query("SELECT COUNT(*) FROM tbl_sinhviens");
            $totalRecords   = $selectAllQuery->fetchColumn();
        }
        $totalPages     = ceil($totalRecords / $limit);
        return ['sinhviens' => $result, 'totalpage' => $totalPages, 'totalrecords' => $totalRecords];
    }

    public function getById($id)
    {
        $query = "SELECT sv.*, l.tenlop FROM tbl_sinhviens sv LEFT JOIN tbl_lop l ON sv.malop = l.id WHERE sv.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $query = "UPDATE tbl_sinhviens SET hoten = :hoten, gioitinh = :gioitinh, mssv = :mssv, malop = :malop WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':hoten', $data['hoten'], PDO::PARAM_STR);
        $stmt->bindValue(':gioitinh', $data['gioitinh'], PDO::PARAM_STR);
        $stmt->bindValue(':mssv', $data['mssv'], PDO::PARAM_STR);
        $stmt->bindValue(':malop', $data['malop'], PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM tbl_sinhviens WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}