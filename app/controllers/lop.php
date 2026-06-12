<?php
require_once '../app/core/Controller.php';
class lop extends Controller
{
  public function index()
  {
    $limit = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    $offset = ($page - 1) * $limit;

    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    $lopModel = $this->model('LopModel');
    $result = $lopModel->paging($limit, $offset, $search);
    $lops = $result['lops'];
    $totalpage = $result['totalpage'];

    $this->view("lop/index", [
        'lops' => $lops, 
        'title' => 'Danh sách lớp học', 
        'totalpage' => $totalpage,
        'current_page' => $page,
        'search' => $search
    ]);
  }

  public function create()
  {
    $this->view("lop/create", ['title' => 'Thêm lớp học']);
  }

  public function store()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
        'tenlop' => trim($_POST['tenlop']),
        'mota' => trim($_POST['mota'])
      ];

      if (empty($data['tenlop'])) {
        $_SESSION['error'] = "Vui lòng nhập tên lớp!";
        header("Location: " . BASE_URL . "/lop/create");
        exit();
      }

      $lopModel = $this->model('LopModel');
      $result = $lopModel->create($data);
      if ($result) {
        $_SESSION['success'] = "Thêm lớp học thành công!";
        header("Location: " . BASE_URL . "/lop/index");
        exit();
      } else {
        $_SESSION['error'] = "Thêm lớp học thất bại!";
        header("Location: " . BASE_URL . "/lop/create");
        exit();
      }
    }
  }

  public function edit($id)
  {
    $lopModel = $this->model('LopModel');
    $lop = $lopModel->getById($id);
    if (!$lop) {
      $_SESSION['error'] = "Không tìm thấy lớp học!";
      header("Location: " . BASE_URL . "/lop/index");
      exit();
    }
    $this->view("lop/edit", [
      'lop' => $lop,
      'title' => 'Cập nhật lớp học'
    ]);
  }

  public function update($id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $data = [
        'tenlop' => trim($_POST['tenlop']),
        'mota' => trim($_POST['mota'])
      ];

      if (empty($data['tenlop'])) {
        $_SESSION['error'] = "Vui lòng nhập tên lớp!";
        header("Location: " . BASE_URL . "/lop/edit/" . $id);
        exit();
      }

      $lopModel = $this->model('LopModel');
      $result = $lopModel->update($id, $data);
      if ($result) {
        $_SESSION['success'] = "Cập nhật thông tin lớp học thành công!";
        header("Location: " . BASE_URL . "/lop/index");
        exit();
      } else {
        $_SESSION['error'] = "Cập nhật thông tin lớp học thất bại!";
        header("Location: " . BASE_URL . "/lop/edit/" . $id);
        exit();
      }
    }
  }

  public function delete($id)
  {
    $lopModel = $this->model('LopModel');
    
    // Check if there are any students in this class
    $sinhvienModel = $this->model('sinhvienModel');
    $allStudents = $sinhvienModel->getAllSinhVien();
    $hasStudents = false;
    foreach ($allStudents as $sv) {
        if ($sv['malop'] == $id) {
            $hasStudents = true;
            break;
        }
    }

    if ($hasStudents) {
        $_SESSION['error'] = "Không thể xóa lớp học này vì đang có sinh viên tham gia!";
    } else {
        $result = $lopModel->delete($id);
        if ($result) {
          $_SESSION['success'] = "Xóa lớp học thành công!";
        } else {
          $_SESSION['error'] = "Xóa lớp học thất bại!";
        }
    }
    header("Location: " . BASE_URL . "/lop/index");
    exit();
  }
}
