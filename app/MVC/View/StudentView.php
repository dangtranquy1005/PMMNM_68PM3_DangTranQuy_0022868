<?php 
if (!isset($viewPage)) {
    $viewPage = 'list';
}
if (!isset($students)) {
    $students = [];
}
if (!isset($student)) {
    $student = null;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 3px; color: white; display: inline-block; cursor: pointer; border: none; }
        .btn-add { background-color: #4CAF50; margin-bottom: 10px; }
        .btn-edit { background-color: #2196F3; }
        .btn-delete { background-color: #f44336; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; box-sizing: border-box; }
        .form-container { max-width: 500px; margin: 0 auto; }
    </style>
</head>
<body>

    <h2>Quản lý Sinh viên</h2>

    <?php if ($viewPage === 'list'): ?>
        <a href="index.php?action=create" class="btn btn-add">Thêm Sinh viên</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mã SV</th>
                    <th>Tên SV</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($students)): ?>
                    <?php foreach ($students as $s): ?>
                        <tr>
                            <td><?= $s->id ?></td>
                            <td><?= htmlspecialchars($s->student_id) ?></td>
                            <td><?= htmlspecialchars($s->student_name) ?></td>
                            <td><?= htmlspecialchars($s->student_email) ?></td>
                            <td><?= htmlspecialchars($s->student_phone) ?></td>
                            <td>
                                <a href="index.php?action=edit&id=<?= $s->id ?>" class="btn btn-edit">Sửa</a>
                                <a href="index.php?action=delete&id=<?= $s->id ?>" class="btn btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Chưa có sinh viên nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    <?php elseif ($viewPage === 'create'): ?>
        <div class="form-container">
            <h3>Thêm Sinh viên mới</h3>
            <form action="index.php?action=create" method="POST">
                <div class="form-group">
                    <label>Mã Sinh viên</label>
                    <input type="text" name="student_id" required>
                </div>
                <div class="form-group">
                    <label>Tên Sinh viên</label>
                    <input type="text" name="student_name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="student_email" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="student_phone" required>
                </div>
                <button type="submit" class="btn btn-add">Lưu</button>
                <a href="index.php" class="btn btn-edit" style="background-color: #666;">Quay lại</a>
            </form>
        </div>

    <?php elseif ($viewPage === 'edit'): ?>
        <div class="form-container">
            <h3>Sửa thông tin Sinh viên</h3>
            <?php if ($student): ?>
                <form action="index.php?action=edit&id=<?= $student->id ?>" method="POST">
                    <div class="form-group">
                        <label>Mã Sinh viên</label>
                        <input type="text" name="student_id" value="<?= htmlspecialchars($student->student_id) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tên Sinh viên</label>
                        <input type="text" name="student_name" value="<?= htmlspecialchars($student->student_name) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="student_email" value="<?= htmlspecialchars($student->student_email) ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" name="student_phone" value="<?= htmlspecialchars($student->student_phone) ?>" required>
                    </div>
                    <button type="submit" class="btn btn-add">Cập nhật</button>
                    <a href="index.php" class="btn btn-edit" style="background-color: #666;">Quay lại</a>
                </form>
            <?php else: ?>
                <p>Không tìm thấy sinh viên.</p>
                <a href="index.php" class="btn btn-edit" style="background-color: #666;">Quay lại</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>
</html>
