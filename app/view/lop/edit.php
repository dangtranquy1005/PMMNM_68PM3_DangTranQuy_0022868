<style>
    .form-container {
        max-width: 600px;
        margin: 2rem auto;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        padding: 2.5rem;
        border: 1px solid #f1f5f9;
    }

    .form-header {
        margin-bottom: 2rem;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 1rem;
    }

    .form-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #0f172a;
        margin: 0;
    }

    .form-subtitle {
        font-size: 0.875rem;
        color: #64748b;
        margin-top: 0.25rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #334155;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        color: #0f172a;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        transition: all 0.2s ease;
        outline: none;
    }

    .form-control:focus {
        border-color: #3b82f6;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }

    .btn-submit {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: #ffffff;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2);
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 12px -2px rgba(37, 99, 235, 0.3);
    }

    .btn-back {
        background-color: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    .btn-back:hover {
        background-color: #e2e8f0;
        color: #0f172a;
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2 class="form-title">Cập Nhật Thông Tin Lớp Học</h2>
        <p class="form-subtitle">Chỉnh sửa thông tin chi tiết của lớp học dưới đây</p>
    </div>

    <!-- Success / Error Alerts -->
    <?php if (isset($_SESSION['error'])): ?>
        <div style="background-color: #fef2f2; border: 1px solid #fca5a5; color: #b91c1c; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; display: flex; align-items: center; gap: 8px;">
            ⚠️ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo BASE_URL; ?>/lop/update/<?php echo $lop['id']; ?>" method="POST">
        <div class="form-group">
            <label class="form-label" for="tenlop">Tên lớp học</label>
            <input type="text" id="tenlop" name="tenlop" class="form-control" placeholder="Ví dụ: 68PM3" value="<?php echo htmlspecialchars($lop['tenlop']); ?>" required autocomplete="off">
        </div>

        <div class="form-group">
            <label class="form-label" for="mota">Mô tả / Ghi chú</label>
            <textarea id="mota" name="mota" class="form-control" placeholder="Ví dụ: Lớp Công nghệ phần mềm K68..." rows="4" style="resize: vertical; font-family: inherit;"><?php echo htmlspecialchars($lop['mota'] ?? ''); ?></textarea>
        </div>

        <div class="btn-group">
            <a href="<?php echo BASE_URL; ?>/lop" class="btn btn-back">Hủy bỏ</a>
            <button type="submit" class="btn btn-submit">Lưu thay đổi</button>
        </div>
    </form>
</div>
