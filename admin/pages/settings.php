<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}
require_once '../../includes/db.php';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE site_settings SET 
        about_title_tr = ?, about_title_en = ?, 
        about_text_tr = ?, about_text_en = ?, 
        contact_email = ?, contact_phone = ?, 
        contact_address = ?, linkedin_url = ?, 
        hero_video_url = ? WHERE id = 1");

    $stmt->execute([
        $_POST['about_title_tr'],
        $_POST['about_title_en'],
        $_POST['about_text_tr'],
        $_POST['about_text_en'],
        $_POST['contact_email'],
        $_POST['contact_phone'],
        $_POST['contact_address'],
        $_POST['linkedin_url'],
        $_POST['hero_video_url']
    ]);
    $success = "Ayarlar başarıyla güncellendi.";
}

// Fetch Current Settings
$stmt = $pdo->query("SELECT * FROM site_settings WHERE id = 1");
$settings = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Ayarları - DENIMSAN YÖNETİM</title>
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
            position: fixed;
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
            margin-left: 250px;
            padding: 30px;
            width: calc(100% - 250px);
            box-sizing: border-box;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="url"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-logo">denim<strong>san</strong></div>
        <a href="../index.php" class="nav-link">Dashboard</a>
        <a href="categories.php" class="nav-link">Koleksiyon Kategorileri</a>
        <a href="settings.php" class="nav-link active">Site Ayarları</a>
        <a href="messages.php" class="nav-link">Gelen Mesajlar</a>
        <a href="../logout.php" class="nav-link" style="margin-top: auto; border-left: 3px solid #dc3545;">Çıkış Yap</a>
    </div>

    <div class="content">
        <h1>Site Ayarları</h1>
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <?= $success ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <form method="POST">
                <h3>Genel Ayarlar</h3>
                <div class="grid-2">
                    <div class="form-group">
                        <label>Telefon Numarası</label>
                        <input type="text" name="contact_phone"
                            value="<?= htmlspecialchars($settings['contact_phone']) ?>">
                    </div>
                    <div class="form-group">
                        <label>E-posta Adresi</label>
                        <input type="email" name="contact_email"
                            value="<?= htmlspecialchars($settings['contact_email']) ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Fiziksel Adres</label>
                    <textarea name="contact_address"><?= htmlspecialchars($settings['contact_address']) ?></textarea>
                </div>
                <div class="grid-2">
                    <div class="form-group">
                        <label>LinkedIn URL</label>
                        <input type="url" name="linkedin_url"
                            value="<?= htmlspecialchars($settings['linkedin_url']) ?>">
                    </div>
                    <div class="form-group">
                        <label>Hero Arka Plan Video URL (YouTube embed linki vb.)</label>
                        <input type="text" name="hero_video_url"
                            value="<?= htmlspecialchars($settings['hero_video_url'] ?? '') ?>">
                    </div>
                </div>

                <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

                <h3>Hakkımızda Bölümü (TR)</h3>
                <div class="form-group">
                    <label>Başlık (TR)</label>
                    <input type="text" name="about_title_tr"
                        value="<?= htmlspecialchars($settings['about_title_tr']) ?>">
                </div>
                <div class="form-group">
                    <label>İçerik (TR)</label>
                    <textarea name="about_text_tr"><?= htmlspecialchars($settings['about_text_tr']) ?></textarea>
                </div>

                <hr style="margin: 30px 0; border: 0; border-top: 1px solid #eee;">

                <h3>Hakkımızda Bölümü (EN)</h3>
                <div class="form-group">
                    <label>Başlık (EN)</label>
                    <input type="text" name="about_title_en"
                        value="<?= htmlspecialchars($settings['about_title_en']) ?>">
                </div>
                <div class="form-group">
                    <label>İçerik (EN)</label>
                    <textarea name="about_text_en"><?= htmlspecialchars($settings['about_text_en']) ?></textarea>
                </div>

                <button type="submit">Ayarları Kaydet</button>
            </form>
        </div>
    </div>
</body>

</html>