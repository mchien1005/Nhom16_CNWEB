<?php
session_start();
require_once 'C:\xampp\htdocs\BTTH\tlunews (1)\models\News.php';
require_once 'C:\xampp\htdocs\BTTH\tlunews (1)\models\Category.php';

// Lấy ID bài viết từ URL, đảm bảo an toàn khi truy xuất
$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : 0;

// Kiểm tra nếu ID hợp lệ và lấy chi tiết bài viết theo ID
if ($id > 0) {
    $news = News::getById($id);
}

if (empty($news)) {
    // Nếu không tìm thấy bài viết, chuyển hướng về trang chủ
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($news['title'], ENT_QUOTES, 'UTF-8') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1><?= htmlspecialchars($news['title'], ENT_QUOTES, 'UTF-8') ?></h1>
        <p><small>Ngày đăng: <?= date('d/m/Y H:i', strtotime($news['created_at'])) ?></small></p>

        <!-- Hiển thị ảnh bài viết -->
        <?php if (!empty($news['image'])): ?>
            <img src="<?= htmlspecialchars($news['image'], ENT_QUOTES, 'UTF-8') ?>" alt="image" class="img-fluid mb-4">
        <?php endif; ?>

        <!-- Hiển thị nội dung bài viết -->
        <div>
            <p><?= nl2br(htmlspecialchars($news['content'], ENT_QUOTES, 'UTF-8')) ?></p>
        </div>

        <!-- Quay lại trang danh sách tin tức -->
        <a href="index.php" class="btn btn-secondary">Quay lại danh sách tin tức</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
