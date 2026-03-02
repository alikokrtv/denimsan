<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}
require_once '../../includes/db.php';

// Handle Mark as Read or Delete
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($_GET['action'] == 'read') {
        $pdo->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?")->execute([$id]);
    } elseif ($_GET['action'] == 'delete') {
        $pdo->prepare("DELETE FROM contact_messages WHERE id = ?")->execute([$id]);
    }
    header("Location: messages.php");
    exit;
}

// Fetch Messages
$messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelen Mesajlar - DENIMSAN YÖNETİM</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; display: flex; }
        .sidebar { width: 250px; background-color: #1a1a1a; color: white; min-height: 100vh; padding: 20px 0; position: fixed;}
        .sidebar-logo { padding: 0 20px 20px; font-size: 24px; font-weight: 300; border-bottom: 1px solid #333; margin-bottom: 20px; }
        .sidebar-logo strong { font-weight: 600; }
        .nav-link { display: block; padding: 15px 20px; color: #ccc; text-decoration: none; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: #333; color: white; border-left: 3px solid #007bff; }
        .content { margin-left: 250px; padding: 30px; width: calc(100% - 250px); box-sizing: border-box; }
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        tr.unread { font-weight: bold; background-color: #f0f7ff; }
        .btn { padding: 4px 8px; background-color: #007bff; color: white; border: none; border-radius: 4px; text-decoration: none; font-size:12px;}
        .btn-success { background-color: #28a745; }
        .btn-danger { background-color: #dc3545; }
        .msg-text { max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; cursor: pointer; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">denim<strong>san</strong></div>
        <a href="../index.php" class="nav-link">Dashboard</a>
        <a href="categories.php" class="nav-link">Koleksiyon Kategorileri</a>
        <a href="settings.php" class="nav-link">Site Ayarları</a>
        <a href="messages.php" class="nav-link active">Gelen Mesajlar</a>
        <a href="../logout.php" class="nav-link" style="margin-top: auto; border-left: 3px solid #dc3545;">Çıkış Yap</a>
    </div>

    <div class="content">
        <h1>Gelen İletişim Formu Mesajları</h1>
        
        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Tarih</th>
                        <th>İsim</th>
                        <th>E-posta</th>
                        <th>Konu</th>
                        <th>Mesaj</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($messages as $row): ?>
                    <tr class="<?= $row['is_read'] ? '' : 'unread' ?>">
                        <td><?= date('d.m.Y H:i', strtotime($row['created_at'])) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></td>
                        <td><?= htmlspecialchars($row['subject']) ?></td>
                        <td class="msg-text" title="<?= htmlspecialchars($row['message']) ?>"><?= htmlspecialchars($row['message']) ?></td>
                        <td>
                            <?php if(!$row['is_read']): ?>
                                <a href="messages.php?action=read&id=<?= $row['id'] ?>" class="btn btn-success">Okundu İşaretle</a>
                            <?php endif; ?>
                            <a href="messages.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(count($messages) === 0): ?>
                        <tr><td colspan="6" style="text-align:center;">Henüz mesaj yok.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
