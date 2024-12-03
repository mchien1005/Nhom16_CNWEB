<?php
session_start();
require_once "../../../models/News.php";
require_once "../../../models/Category.php";

// Kiểm tra quyền admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    header("Location: login.php");
    exit;
}

// Kiểm tra xem ID tin tức có được truyền qua URL không
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Lấy thông tin tin tức và danh sách danh mục
$news = News::getById($id);
if (!$news) {
    header("Location: index.php");
    exit;
}

$categories = Category::getAll();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    $image = $_FILES['image'];

    // Kiểm tra dữ liệu nhập
    if (empty($title) || empty($content) || empty($category_id)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } else {
        // Xử lý ảnh
        $imagePath = $news['image']; // Giữ nguyên ảnh cũ nếu không có ảnh mới
        if ($image && $image['tmp_name']) {
            // Xóa ảnh cũ nếu có ảnh mới
            if (file_exists($news['image'])) {
                unlink($news['image']);
            }
            $targetDir = "../../uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $imagePath = $targetDir . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        // Cập nhật tin tức vào cơ sở dữ liệu
        if (News::update($id, $title, $content, '/tlunews/views/admin/new/'.$imagePath, $category_id)) {
            $success = "Cập nhật tin tức thành công!";
            header("Refresh: 2; url=index.php");
        } else {
            $error = "Có lỗi xảy ra, vui lòng thử lại.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Chỉnh sửa tin tức</h1>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($news['title']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?= htmlspecialchars($news['content']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="" disabled>Chọn danh mục</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $news['category_id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Ảnh</label>
                <input type="file" class="form-control" id="image" name="image">
                <?php if ($news['image']): ?>
                    <img src="<?= $news['image'] ?>" alt="Current Image" class="img-fluid mt-2" style="max-height: 200px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
