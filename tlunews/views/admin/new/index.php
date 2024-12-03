<?php
session_start();
require_once 'C:\Users\minhc\OneDrive\Tài liệu\GitHub\Nhom16_CNWEB\tlunews\models\News.php';
require_once 'C:\Users\minhc\OneDrive\Tài liệu\GitHub\Nhom16_CNWEB\tlunews\models\Category.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
   header("Location: login.php");
   exit;
}

// Lấy danh sách tin tức
$newsList = News::getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Quản lý tin tức</h1>

        <a href="add.php" class="btn btn-success mb-3">Thêm tin tức mới</a>

        <?php if (count($newsList) > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($newsList as $news): ?>
                <tr>
                    <td><?= $news['id'] ?></td>
                    <td><?= htmlspecialchars($news['title']) ?></td>
                    <td><?= Category::getById($news['category_id'])['name'] ?></td>
                    <td><?= $news['created_at'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $news['id'] ?>" class="btn btn-warning">Sửa</a>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $news['id'] ?>">
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Bạn có chắc muốn xóa tin tức này không?')">Xóa</button>
                        </form>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>Không có tin tức nào để hiển thị.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>