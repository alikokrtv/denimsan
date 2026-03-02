<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once '../includes/db.php';
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENIMSAN YÖNETİM</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #1a1a1a;
            color: white;
            min-height: 100vh;
            padding: 20px 0;
        }

        .sidebar-logo {
            padding: 0 20px 20px;
            font-size: 24px;
            font-weight: 300;
            border-bottom: 1px solid #333;
            margin-bottom: 20px;
        }

        .sidebar-logo strong {
            font-weight: 600;
        }

        .nav-link {
            display: block;
            padding: 15px 20px;
            color: #ccc;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #333;
            color: white;
            border-left: 3px solid #007bff;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        h1 {
            margin-top: 0;
            color: #333;
        }

        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .stat-value {
            font-size: 32px;
            font-weight: bold;
            color: #1a1a1a;
        }

        .stat-label {
            color: #666;
            font-size: 14px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-logo">denim<strong>san</strong></div>
        <a href="index.php" class="nav-link active">Dashboard</a>
        <a href="pages/categories.php" class="nav-link">Koleksiyon Kategorileri</a>
        <a href="pages/settings.php" class="nav-link">Site Ayarları</a>
        <a href="pages/messages.php" class="nav-link">Gelen Mesajlar</a>
        <a href="logout.php" class="nav-link" style="margin-top: auto; border-left: 3px solid #dc3545;">Çıkış Yap</a>
    </div>

    <div class="content">
        <h1>Dashboard</h1>
        <p>DENIMSAN Yönetim Paneline Hoş Geldiniz.</p>

        <div class="stat-grid">
            <?php
            // Fetch basic stats
            $catCount = $pdo->query("SELECT COUNT(*) FROM collection_categories")->fetchColumn();
            $msgCount = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE is_read = 0")->fetchColumn();
            ?>
            <div class="stat-card">
                <div class="stat-value">
                    <?= $catCount ?>
                </div>
                <div class="stat-label">Toplam Kategori</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">
                    <?= $msgCount ?>
                </div>
                <div class="stat-label">Okunmamış Mesaj</div>
            </div>
        </div>
    </div>
</body>

</html>