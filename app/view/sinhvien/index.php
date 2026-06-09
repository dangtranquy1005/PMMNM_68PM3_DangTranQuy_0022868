<style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #edf2f7;
            padding-bottom: 1rem;
        }

        h1 {
            color: #1a1a1a;
            font-size: 1.75rem;
            margin: 0;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            padding: 1rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr {
            transition: background-color 0.2s ease;
        }

        tr:hover td {
            background-color: #f1f5f9;
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .badge-nam {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .badge-nu {
            background-color: #fce7f3;
            color: #be185d;
        }

        /* Action Buttons Styles */
        .btn-action-group {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 6px;
            border: 1px solid #000000;
            background-color: #ffffff;
            color: #000000;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-action:hover {
            background-color: #f1f5f9;
            color: #000000;
        }

        /* Pagination Link Styles */
        .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            min-width: 2.25rem;
            height: 2.25rem;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            background-color: #ffffff;
            color: #475569;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .page-link:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            border-color: #94a3b8;
        }

        .page-link.active {
            background-color: #3b82f6;
            color: #ffffff;
            border-color: #3b82f6;
        }
    </style>

    <div class="container" style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1); padding: 2rem;">
        <div class="page-header">
            <h1><?php echo isset($title) ? $title : 'Danh sách sinh viên'; ?></h1>
            <div style="display: flex; gap: 0.75rem;">
                <a href="<?php echo BASE_URL; ?>/" style="display: inline-flex; align-items: center; gap: 6px; background-color: #f1f5f9; color: #475569; padding: 0.625rem 1.25rem; border-radius: 8px; font-weight: 500; text-decoration: none; font-size: 0.9rem; border: 1px solid #e2e8f0; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#0f172a';" onmouseout="this.style.background='#f1f5f9'; this.style.color='#475569';">
                    🏠 Trang chủ
                </a>
                <a href="<?php echo BASE_URL; ?>/sinhvien/create" style="display: inline-flex; align-items: center; gap: 6px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: #ffffff; padding: 0.625rem 1.25rem; border-radius: 8px; font-weight: 500; text-decoration: none; font-size: 0.9rem; box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.2); transition: all 0.2s;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 12px -2px rgba(37, 99, 235, 0.3)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(37, 99, 235, 0.2)';">
                    ➕ Thêm sinh viên
                </a>
            </div>
        </div>

        <!-- Success / Error Alerts -->
        <?php if (isset($_SESSION['success'])): ?>
            <div style="background-color: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; display: flex; align-items: center; gap: 8px;">
                ✅ <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div style="background-color: #fef2f2; border: 1px solid #fca5a5; color: #b91c1c; padding: 0.75rem 1rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.9rem; display: flex; align-items: center; gap: 8px;">
                ⚠️ <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Search Bar -->
        <div style="margin-bottom: 1.5rem; display: flex; justify-content: flex-start; align-items: center;">
            <form action="<?php echo BASE_URL; ?>/sinhvien/index" method="GET" style="display: flex; gap: 10px; width: 100%; max-width: 500px;">
                <input type="text" name="search" placeholder="Tìm kiếm theo tên hoặc MSSV..." value="<?php echo htmlspecialchars($search ?? ''); ?>" style="flex: 1; padding: 0.625rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.9rem; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3b82f6';" onblur="this.style.borderColor='#cbd5e1';">
                <button type="submit" style="background-color: #1e293b; color: #ffffff; border: none; padding: 0.625rem 1.25rem; border-radius: 8px; font-weight: 500; font-size: 0.9rem; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#0f172a';" onmouseout="this.style.backgroundColor='#1e293b';">Tìm kiếm</button>
                <?php if (!empty($search)): ?>
                    <a href="<?php echo BASE_URL; ?>/sinhvien/index" style="display: inline-flex; align-items: center; background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; padding: 0.625rem 1.25rem; border-radius: 8px; font-weight: 500; font-size: 0.9rem; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#e2e8f0'; this.style.color='#0f172a';" onmouseout="this.style.background='#f1f5f9'; this.style.color='#475569';">Xóa lọc</a>
                <?php endif; ?>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>MSSV</th>
                    <th style="text-align: right;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinhviens)): ?>
                    <?php 
                        $stt = 1;
                        if (isset($current_page) && $current_page > 1) {
                            $stt = ($current_page - 1) * 5 + 1; // Assuming limit is 5
                        }
                    ?>
                    <?php foreach ($sinhviens as $sv): ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td><?php echo htmlspecialchars($sv['hoten']); ?></td>
                            <td>
                                <?php 
                                    $gioitinh = htmlspecialchars($sv['gioitinh'] ?? '');
                                    $badgeClass = (strtolower($gioitinh) == 'nam') ? 'badge-nam' : 'badge-nu';
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo $gioitinh; ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($sv['mssv']); ?></td>
                            <td>
                                <div class="btn-action-group" style="justify-content: flex-end;">
                                    <a href="<?php echo BASE_URL; ?>/sinhvien/edit/<?php echo $sv['id']; ?>" class="btn-action">Sửa</a>
                                    <a href="<?php echo BASE_URL; ?>/sinhvien/delete/<?php echo $sv['id']; ?>" class="btn-action" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên <?php echo htmlspecialchars($sv['hoten']); ?> không?');">Xóa</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 2rem;">Không có dữ liệu sinh viên.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if (isset($totalpage) && $totalpage > 1): ?>
            <div style="display: flex; justify-content: center; align-items: center; gap: 0.5rem; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #edf2f7;">
                <?php if ($current_page > 1): ?>
                    <a href="<?php echo BASE_URL; ?>/sinhvien/index?page=<?php echo $current_page - 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" class="page-link">Trang trước</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalpage; $i++): ?>
                    <a href="<?php echo BASE_URL; ?>/sinhvien/index?page=<?php echo $i; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" class="page-link <?php echo ($i === $current_page) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($current_page < $totalpage): ?>
                    <a href="<?php echo BASE_URL; ?>/sinhvien/index?page=<?php echo $current_page + 1; ?><?php echo !empty($search) ? '&search=' . urlencode($search) : ''; ?>" class="page-link">Trang sau</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>