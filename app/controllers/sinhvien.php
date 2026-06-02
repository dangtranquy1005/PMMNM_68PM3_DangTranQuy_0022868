
<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller {
    public function index() {
        $sinhvienModel = $this->model('sinhvienModel');
        $sinhvien = $sinhvienModel->getAllSinhvien();
        $this->view('sinhvien/index', ['sinhviens' => $sinhvien]);
    }

    public function create() {
        $this->view('sinhvien/create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hoten = trim($_POST['hoten'] ?? '');
            $gioitinh = trim($_POST['gioitinh'] ?? '');
            $mssv = trim($_POST['mssv'] ?? '');

            if (!empty($hoten) && !empty($gioitinh) && !empty($mssv)) {
        $sinhvienModel = $this->model('sinhvienModel');
                $result = $sinhvienModel->create($hoten, $gioitinh, $mssv);
                if ($result) {
                   
            header('Location: ' . BASE_URL . '/sinhvien');
                    exit();
        }
            }
        }
        
        // Thất bại hoặc không đúng phương thức POST, quay lại trang thêm mới
        header('Location: ' . BASE_URL . '/sinhvien/create');
        exit();
    }
}