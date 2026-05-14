<?php
require_once __DIR__ . '/../Model/StudentModel.php';

class StudentController {
    private $model;

    public function __construct() {
        $this->model = new StudentModel();
    }

    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';

        switch ($action) {
            case 'create':
                $this->create();
                break;
            case 'edit':
                $this->edit();
                break;
            case 'delete':
                $this->delete();
                break;
            case 'list':
            default:
                $this->list();
                break;
        }
    }

    private function list() {
        $students = $this->model->getAllStudents();
        $viewPage = 'list';
        require __DIR__ . '/../View/StudentView.php';
    }

    private function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student_id = $_POST['student_id'];
            $student_name = $_POST['student_name'];
            $student_email = $_POST['student_email'];
            $student_phone = $_POST['student_phone'];

            $this->model->addStudent($student_id, $student_name, $student_email, $student_phone);
            header("Location: index.php");
            exit();
        }
        $viewPage = 'create';
        require __DIR__ . '/../View/StudentView.php';
    }

    private function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php");
            exit();
        }

        $id = $_GET['id'];
        $student = $this->model->getStudentById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $student_id = $_POST['student_id'];
            $student_name = $_POST['student_name'];
            $student_email = $_POST['student_email'];
            $student_phone = $_POST['student_phone'];

            $this->model->updateStudent($id, $student_id, $student_name, $student_email, $student_phone);
            header("Location: index.php");
            exit();
        }

        $viewPage = 'edit';
        require __DIR__ . '/../View/StudentView.php';
    }

    private function delete() {
        if (isset($_GET['id'])) {
            $this->model->deleteStudent($_GET['id']);
        }
        header("Location: index.php");
        exit();
    }
}
?>
