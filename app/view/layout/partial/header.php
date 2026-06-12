<?php
$current_url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
$is_lop = (strpos($current_url, 'lop') === 0);
$is_sv = (strpos($current_url, 'sinhvien') === 0 || $current_url === '' || strpos($current_url, 'home') === 0);
?>
<div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
    <div style="display: flex; align-items: center; gap: 40px;">
        <a href="<?php echo BASE_URL; ?>/" style="font-weight: 600; font-size: 1.1rem; display: flex; align-items: center; gap: 8px; color: #ffffff; text-decoration: none; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
            <span style="background: linear-gradient(135deg, #3b82f6, #8b5cf6); width: 12px; height: 24px; border-radius: 4px; display: inline-block;"></span>
            Hệ Thống Quản Lý
        </a>
        <?php if (isset($_SESSION['username'])): ?>
        <nav style="display: flex; align-items: center; gap: 24px;">
            <a href="<?php echo BASE_URL; ?>/sinhvien" style="color: <?php echo $is_sv ? '#ffffff' : '#94a3b8'; ?>; text-decoration: none; font-weight: 500; font-size: 0.95rem; transition: all 0.2s; border-bottom: 2px solid <?php echo $is_sv ? '#3b82f6' : 'transparent'; ?>; padding: 4px 0;" onmouseover="this.style.color='#ffffff'; this.style.borderBottomColor='#3b82f6';" onmouseout="if(!<?php echo $is_sv ? 'true' : 'false'; ?>) { this.style.color='#94a3b8'; this.style.borderBottomColor='transparent'; }">
                🎓 Sinh viên
            </a>
            <a href="<?php echo BASE_URL; ?>/lop" style="color: <?php echo $is_lop ? '#ffffff' : '#94a3b8'; ?>; text-decoration: none; font-weight: 500; font-size: 0.95rem; transition: all 0.2s; border-bottom: 2px solid <?php echo $is_lop ? '#3b82f6' : 'transparent'; ?>; padding: 4px 0;" onmouseover="this.style.color='#ffffff'; this.style.borderBottomColor='#3b82f6';" onmouseout="if(!<?php echo $is_lop ? 'true' : 'false'; ?>) { this.style.color='#94a3b8'; this.style.borderBottomColor='transparent'; }">
                🏫 Lớp học
            </a>
        </nav>
        <?php endif; ?>
    </div>
    <div style="display: flex; align-items: center; gap: 16px; font-size: 0.9rem;">
        <?php if (isset($_SESSION['username'])): ?>
            <span style="color: #94a3b8;">Xin chào, <strong style="color: #f1f5f9;"><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
            <a href="<?php echo BASE_URL; ?>/home/logout" style="color: #f43f5e; text-decoration: none; font-weight: 500; transition: color 0.2s;" onmouseover="this.style.color='#fda4af'" onmouseout="this.style.color='#f43f5e'">Đăng xuất</a>
        <?php endif; ?>
    </div>
</div>
