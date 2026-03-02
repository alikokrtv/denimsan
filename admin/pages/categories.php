<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}
require_once '../../includes/db.php';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    // Get image path to delete file
    $stmt = $pdo->prepare("SELECT cover_image FROM collection_categories WHERE id = ?");
    $stmt->execute([$id]);
    $cat = $stmt->fetch();
    
    if ($cat && !empty($cat['cover_image']) && file_exists('../../' . $cat['cover_image'])) {
        unlink('../../' . $cat['cover_image']); // Delete physical file
    }
    
    $pdo->prepare("DELETE FROM collection_categories WHERE id = ?")->execute([$id]);
    header("Location: categories.php?msg=deleted");
    exit;
}

// Process Form Add/Edit
$editMode = isset($_GET['edit']);
$editId = $editMode ? (int)$_GET['edit'] : 0;
$catData = [
    'title_tr' => '', 'title_en' => '', 
    'description_tr' => '', 'description_en' => '', 
    'video_url' => '', 'order_num' => 0
];

if ($editMode) {
    $stmt = $pdo->prepare("SELECT * FROM collection_categories WHERE id = ?");
    $stmt->execute([$editId]);
    $catData = $stmt->fetch() ?: $catData;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title_tr = $_POST['title_tr'] ?? '';
    $title_en = $_POST['title_en'] ?? '';
    $description_tr = $_POST['description_tr'] ?? '';
    $description_en = $_POST['description_en'] ?? '';
    $video_url = $_POST['video_url'] ?? '';
    $order_num = (int)($_POST['order_num'] ?? 0);
    
    $imgPath = $editMode ? $catData['cover_image'] : '';

    // Handle File Upload
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === 0) {
        $uploadDir = '../../assets/img/categories/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        
        $fileName = time() . '_' . basename($_FILES['cover_image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetPath)) {
            // Delete old image if exists
            if ($editMode && !empty($imgPath) && file_exists('../../' . $imgPath)) {
                unlink('../../' . $imgPath);
            }
            $imgPath = 'assets/img/categories/' . $fileName; // Store relative path
        }
    }

    if ($editMode) {
        $stmt = $pdo->prepare("UPDATE collection_categories SET 
            title_tr=?, title_en=?, description_tr=?, description_en=?, 
            cover_image=?, video_url=?, order_num=? WHERE id=?");
        $stmt->execute([$title_tr, $title_en, $description_tr, $description_en, $imgPath, $video_url, $order_num, $editId]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO collection_categories 
            (title_tr, title_en, description_tr, description_en, cover_image, video_url, order_num) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title_tr, $title_en, $description_tr, $description_en, $imgPath, $video_url, $order_num]);
    }
    
    header("Location: categories.php?msg=" . ($editMode ? "updated" : "added"));
    exit;
}

// Fetch all categories
$categories = $pdo->query("SELECT * FROM collection_categories ORDER BY order_num ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksiyon Kategorileri - DENIMSAN YÖNETİM</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; display: flex; }
        .sidebar { width: 250px; background-color: #1a1a1a; color: white; min-height: 100vh; padding: 20px 0; position: fixed;}
        .sidebar-logo { padding: 0 20px 20px; font-size: 24px; font-weight: 300; border-bottom: 1px solid #333; margin-bottom: 20px; }
        .sidebar-logo strong { font-weight: 600; }
        .nav-link { display: block; padding: 15px 20px; color: #ccc; text-decoration: none; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: #333; color: white; border-left: 3px solid #007bff; }
        .content { margin-left: 250px; padding: 30px; width: calc(100% - 250px); box-sizing: border-box; }
        .card { background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; color: #333; }
        input[type="text"], input[type="number"], textarea, input[type="file"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { height: 80px; resize: vertical;}
        .btn { padding: 8px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; text-decoration: none; cursor: pointer; display: inline-block;}
        .btn-danger { background-color: #dc3545; }
        .btn-warning { background-color: #ffc107; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        .img-preview { max-width: 100px; height: auto; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">denim<strong>san</strong></div>
        <a href="../index.php" class="nav-link">Dashboard</a>
        <a href="categories.php" class="nav-link active">Koleksiyon Kategorileri</a>
        <a href="settings.php" class="nav-link">Site Ayarları</a>
        <a href="messages.php" class="nav-link">Gelen Mesajlar</a>
        <a href="../logout.php" class="nav-link" style="margin-top: auto; border-left: 3px solid #dc3545;">Çıkış Yap</a>
    </div>

    <div class="content">
        <h1>Koleksiyon Kategorileri</h1>
        
        <?php if(isset($_GET['msg'])): ?>
            <div style="background:#d4edda; color:#155724; padding:10px; border-radius:4px; margin-bottom:15px;">
                İşlem başarıyla tamamlandı.
            </div>
        <?php endif; ?>

        <div class="grid-2">
            <!-- Form Card -->
            <div class="card">
                <h3><?= $editMode ? 'Kategoriyi Düzenle' : 'Yeni Kategori Ekle' ?></h3>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Sıra No (Order)</label>
                        <input type="number" name="order_num" value="<?= htmlspecialchars($catData['order_num']) ?>" required>
                    </div>
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Başlık (TR)</label>
                            <input type="text" name="title_tr" value="<?= htmlspecialchars($catData['title_tr']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Başlık (EN)</label>
                            <input type="text" name="title_en" value="<?= htmlspecialchars($catData['title_en']) ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Açıklama (TR) / İsteğe Bağlı</label>
                        <textarea name="description_tr"><?= htmlspecialchars($catData['description_tr']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Açıklama (EN) / İsteğe Bağlı</label>
                        <textarea name="description_en"><?= htmlspecialchars($catData['description_en']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Video URL (Opsiyonel, Youtube link)</label>
                        <input type="text" name="video_url" value="<?= htmlspecialchars($catData['video_url']) ?>">
                    </div>
                    <div class="form-group">
                        <label>Kapak Görseli</label>
                        <?php if($editMode && !empty($catData['cover_image'])): ?>
                            <div style="margin-bottom:10px;">
                                <img src="../../<?= $catData['cover_image'] ?>" alt="Current Image" class="img-preview">
                            </div>
                        <?php endif; ?>
                        <input type="file" name="cover_image" accept="image/*" <?= $editMode ? '' : 'required' ?>>
                        <small style="color:#666;">Tavsiye: 800x1200 px, dikey format.</small>
                    </div>
                    
                    <button type="submit" class="btn"><?= $editMode ? 'Güncelle' : 'Ekle' ?></button>
                    <?php if($editMode): ?>
                        <a href="categories.php" class="btn btn-warning">İptal</a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- List Card -->
            <div class="card">
                <h3>Mevcut Kategoriler</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Sıra</th>
                            <th>Görsel</th>
                            <th>Başlık (TR)</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $row): ?>
                        <tr>
                            <td><?= $row['order_num'] ?></td>
                            <td>
                                <?php if($row['cover_image']): ?>
                                    <img src="../../<?= $row['cover_image'] ?>" class="img-preview" style="max-width: 60px;">
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($row['title_tr']) ?></td>
                            <td>
                                <a href="categories.php?edit=<?= $row['id'] ?>" class="btn" style="padding: 4px 8px; font-size:12px;">Düzenle</a>
                                <a href="categories.php?delete=<?= $row['id'] ?>" class="btn btn-danger" style="padding: 4px 8px; font-size:12px;" onclick="return confirm('Silmek istediğinize emin misiniz?');">Sil</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if(count($categories) === 0): ?>
                            <tr><td colspan="4" style="text-align:center;">Henüz kategori eklenmedi.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
