<?php
require_once __DIR__ . '/../Controller/Conn.php';
require_once 'StudentEntity.php';

class StudentModel {
    private $db;

    public function __construct() {
        $connObj = new Conn();
        $this->db = $connObj->conn;
    }

    public function getAllStudents() {
        $sql = "SELECT * FROM students";
        $result = $this->db->query($sql);
        $students = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $student = new Student();
                $student->id = $row['id'];
                $student->student_id = $row['student_id'];
                $student->student_name = $row['student_name'];
                $student->student_email = $row['student_email'];
                $student->student_phone = $row['student_phone'];
                $students[] = $student;
            }
        }
        return $students;
    }

    public function getStudentById($id) {
        $sql = "SELECT * FROM students WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $student = new Student();
            $student->id = $row['id'];
            $student->student_id = $row['student_id'];
            $student->student_name = $row['student_name'];
            $student->student_email = $row['student_email'];
            $student->student_phone = $row['student_phone'];
            return $student;
        }
        return null;
    }

    public function addStudent($student_id, $student_name, $student_email, $student_phone) {
        $sql = "INSERT INTO students (student_id, student_name, student_email, student_phone) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $student_id, $student_name, $student_email, $student_phone);
        return $stmt->execute();
    }

    public function updateStudent($id, $student_id, $student_name, $student_email, $student_phone) {
        $sql = "UPDATE students SET student_id=?, student_name=?, student_email=?, student_phone=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssi", $student_id, $student_name, $student_email, $student_phone, $id);
        return $stmt->execute();
    }

    public function deleteStudent($id) {
        $sql = "DELETE FROM students WHERE id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
