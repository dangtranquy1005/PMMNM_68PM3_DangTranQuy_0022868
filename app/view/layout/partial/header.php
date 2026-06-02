<div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
    <a href="<?php echo BASE_URL; ?>/sinhvien" style="font-weight: 600; font-size: 1.1rem; display: flex; align-items: center; gap: 8px; color: #ffffff; text-decoration: none; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
        <span style="background: linear-gradient(135deg, #3b82f6, #8b5cf6); width: 12px; height: 24px; border-radius: 4px; display: inline-block;"></span>
        Hệ Thống Quản Lý Sinh Viên
    </a>
    <div style="display: flex; align-items: center; gap: 16px; font-size: 0.9rem;">
        <?php if (isset($_SESSION['username'])): ?>
            <span style="color: #94a3b8;">Xin chào, <strong style="color: #f1f5f9;"><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
            <a href="<?php echo BASE_URL; ?>/home/logout" style="color: #f43f5e; text-decoration: none; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='#fda4af'" onmouseout="this.style.color='#f43f5e'">Đăng xuất</a>
        <?php endif; ?>
    </div>
</div>
