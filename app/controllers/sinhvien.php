<?php
require_once '../app/core/Controller.php';
class sinhvien extends Controller
{
  public function index()
  {
    $limit = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $limit;

    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    $sinhvienModel = $this->model('sinhvienModel');
    $result = $sinhvienModel->paging($limit, $offset, $search);
    $sinhviens = $result['sinhviens'];
    $totalpage = $result['totalpage'];

    $this->view("sinhvien/index", [
        'sinhviens' => $sinhviens, 
        'title' => 'Danh sách sinh viên', 
        'totalpage' => $totalpage,
        'current_page' => $page,
        'search' => $search
    ]);
  }

  public function create()
  {
    $lopModel = $this->model('LopModel');
    $lops = $lopModel->getAllLop();
    $this->view("sinhvien/create", [
      'title' => 'Thêm sinh viên',
      'lops' => $lops
    ]);
  }

  public function store()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
        'hoten' => trim($_POST['hoten']),
        'gioitinh' => $_POST['gioitinh'],
        'mssv' => trim($_POST['mssv']),
        'malop' => isset($_POST['malop']) ? (int)$_POST['malop'] : 0
      ];

      if (empty($data['hoten']) || empty($data['mssv']) || empty($data['malop'])) {
        $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
        header("Location: " . BASE_URL . "/sinhvien/create");
        exit();
      }

      $sinhvienModel = $this->model('sinhvienModel');
      $result = $sinhvienModel->create($data);
      if ($result) {
        $_SESSION['success'] = "Thêm sinh viên thành công!";
        header("Location: " . BASE_URL . "/sinhvien/index");
        exit();
      } else {
        $_SESSION['error'] = "Thêm sinh viên thất bại!";
        header("Location: " . BASE_URL . "/sinhvien/create");
        exit();
      }
    }
  }

  public function edit($id)
  {
    $sinhvienModel = $this->model('sinhvienModel');
    $sinhvien = $sinhvienModel->getById($id);
    if (!$sinhvien) {
      $_SESSION['error'] = "Không tìm thấy sinh viên!";
      header("Location: " . BASE_URL . "/sinhvien/index");
      exit();
    }
    $lopModel = $this->model('LopModel');
    $lops = $lopModel->getAllLop();
    $this->view("sinhvien/edit", [
      'sinhvien' => $sinhvien,
      'lops' => $lops,
      'title' => 'Cập nhật sinh viên'
    ]);
  }

  public function update($id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
        'hoten' => trim($_POST['hoten']),
        'gioitinh' => $_POST['gioitinh'],
        'mssv' => trim($_POST['mssv']),
        'malop' => isset($_POST['malop']) ? (int)$_POST['malop'] : 0
      ];

      if (empty($data['hoten']) || empty($data['mssv']) || empty($data['malop'])) {
        $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
        header("Location: " . BASE_URL . "/sinhvien/edit/" . $id);
        exit();
      }

      $sinhvienModel = $this->model('sinhvienModel');
      $result = $sinhvienModel->update($id, $data);
      if ($result) {
        $_SESSION['success'] = "Cập nhật thông tin sinh viên thành công!";
        header("Location: " . BASE_URL . "/sinhvien/index");
        exit();
      } else {
        $_SESSION['error'] = "Cập nhật thông tin sinh viên thất bại!";
        header("Location: " . BASE_URL . "/sinhvien/edit/" . $id);
        exit();
      }
    }
  }

  public function delete($id)
  {
    $sinhvienModel = $this->model('sinhvienModel');
    $result = $sinhvienModel->delete($id);
    if ($result) {
      $_SESSION['success'] = "Xóa sinh viên thành công!";
    } else {
      $_SESSION['error'] = "Xóa sinh viên thất bại!";
    }
    header("Location: " . BASE_URL . "/sinhvien/index");
    exit();
  }
}