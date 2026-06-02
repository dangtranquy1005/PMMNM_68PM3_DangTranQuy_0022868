<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            height: 100%;
        }
        body {
            font-family: 'Inter', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .header {
            width: 100%;
            height: 60px;
            background-color: #1e293b;
            color: #ffffff;
            display: flex;
            align-items: center;
            padding: 0 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .content {
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        .footer {
            width: 100%;
            height: 50px;
            background-color: #0f172a;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            border-top: 1px solid #334155;
        }
    </style>    
</head>
<body>
        <div class="header">
            <?php require_once '../app/view/layout/partial/header.php'; ?>
        </div>
        <div class="content">
            <?php require_once '../app/view/' .$viewname .'.php'; ?>
        </div>
        <div class="footer">
            <?php require_once '../app/view/layout/partial/footer.php'; ?>
        </div>
    </body>
</html>