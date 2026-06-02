<?php
    if (!isset($_SESSION['username'])) {
        header('Location: ' . BASE_URL . '/home/login');
        exit();
    }
?>

<div style="max-width: 600px; margin: 4rem auto; padding: 2.5rem; background: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05); text-align: center; border: 1px solid #f1f5f9;">
    <div style="background: linear-gradient(135deg, #e0f2fe, #dbeafe); width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
        <span style="font-size: 1.75rem;">👋</span>
    </div>
    
    <h1 style="font-size: 1.75rem; font-weight: 600; color: #0f172a; margin-bottom: 0.5rem; letter-spacing: -0.025em;">
        Chào mừng quay trở lại!
    </h1>
    
    <p style="color: #64748b; font-size: 1rem; margin-bottom: 2rem;">
        Tài khoản: <strong style="color: #0f172a;"><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
    </p>

    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
        <a href="<?php echo BASE_URL; ?>/sinhvien" style="display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #3b82f6, #2563eb); color: #ffffff; padding: 0.875rem 1.5rem; border-radius: 8px; font-weight: 500; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 12px -2px rgba(37, 99, 235, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(37, 99, 235, 0.2)';">
            📂 Quản Lý Sinh Viên
        </a>
        
        <a href="<?php echo BASE_URL; ?>/home/logout" style="display: inline-flex; align-items: center; justify-content: center; background: #f8fafc; color: #64748b; padding: 0.875rem 1.5rem; border-radius: 8px; font-weight: 500; text-decoration: none; border: 1px solid #e2e8f0; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'; this.style.color='#0f172a';" onmouseout="this.style.background='#f8fafc'; this.style.color='#64748b';">
            Đăng xuất
        </a>
    </div>
</div>