<style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 2rem;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 2rem;
        }

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
    </style>
</head>

<body>
    <div class="container">
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
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>MSSV</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinhviens)): ?>
                    <?php foreach ($sinhviens as $sv): ?>
                        <tr>
                            <td><?php echo $sv['id']; ?></td>
                            <td><?php echo htmlspecialchars($sv['hoten']); ?></td>
                            <td>
                                <?php 
                                    $gioitinh = htmlspecialchars($sv['gioitinh'] ?? '');
                                    $badgeClass = (strtolower($gioitinh) == 'nam') ? 'badge-nam' : 'badge-nu';
                                ?>
                                <span class="badge <?php echo $badgeClass; ?>"><?php echo $gioitinh; ?></span>
                            </td>
                            <td><?php echo htmlspecialchars($sv['mssv']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 2rem;">Không có dữ liệu sinh viên.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>