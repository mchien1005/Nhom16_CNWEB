<?php
session_start();
require_once "models/News.php";
require_once "models/Category.php";

<<<<<<< HEAD
// Kiểm tra xem có tìm kiếm không
$searchTerm = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

// Lấy danh sách tin tức nếu có từ khóa tìm kiếm
if ($searchTerm) {
    $newsList = News::search($searchTerm); // Hàm tìm kiếm theo từ khóa
} else {
    $newsList = News::getAll(); // Lấy tất cả tin tức nếu không có từ khóa
=======

$searchTerm = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

if ($searchTerm) {
    $newsList = News::search($searchTerm); 
} else {
    $newsList = News::getAll(); 
>>>>>>> feature/index
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tin tức</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
<<<<<<< HEAD
    /* Cấu hình chung cho body */
=======
   
>>>>>>> feature/index
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f7fa;
        color: #333;
        margin: 0;
        padding: 0;
    }

<<<<<<< HEAD
    /* Container chính */
=======

>>>>>>> feature/index
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 30px;
    }

<<<<<<< HEAD
    /* Tiêu đề */
=======
>>>>>>> feature/index
    h1 {
        font-size: 36px;
        color: #495057;
        font-weight: bold;
        text-align: center;
        margin-bottom: 40px;
    }

<<<<<<< HEAD
    /* Form tìm kiếm */
=======
   
>>>>>>> feature/index
    .input-group {
        max-width: 600px;
        margin: 0 auto 40px;
    }

    .input-group input {
        border-radius: 20px;
        padding: 10px 15px;
        border: 1px solid #ddd;
    }

    .input-group button {
        border-radius: 20px;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
    }

    .input-group button:hover {
        background-color: #0056b3;
    }

<<<<<<< HEAD
    /* Card chứa tin tức */
=======
    
>>>>>>> feature/index
    .card {
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
    }

    .card-title {
        font-size: 18px;
        color: #495057;
        font-weight: bold;
    }

    .card-text {
        font-size: 14px;
        color: #6c757d;
        margin-bottom: 20px;
    }

    .card img {
        border-radius: 12px 12px 0 0;
        max-height: 250px;
        object-fit: cover;
        width: 100%;
    }

    .btn-primary {
        background-color: #007bff;
        border-radius: 20px;
        padding: 8px 20px;
        text-align: center;
        text-decoration: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

<<<<<<< HEAD
    /* Khi không có tin tức */
=======
  
>>>>>>> feature/index
    .no-news {
        font-size: 18px;
        color: #888;
        text-align: center;
        margin-top: 40px;
    }

<<<<<<< HEAD
    /* Footer */
=======
>>>>>>> feature/index
    footer {
        background-color: #343a40;
        color: white;
        text-align: center;
        padding: 15px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
    h1 {
<<<<<<< HEAD
    font-family: 'Arial', sans-serif; /* Thay đổi font chữ để tiêu đề đẹp hơn */
    font-size: 48px; /* Tăng kích thước chữ */
    color: #333; /* Màu chữ tối để dễ đọc */
    font-weight: bold; /* Đặt chữ đậm */
    text-align: center; /* Căn giữa chữ */
    text-transform: uppercase; /* Đổi chữ thành in hoa */
    letter-spacing: 2px; /* Thêm khoảng cách giữa các chữ cái */
    margin-bottom: 40px; /* Khoảng cách dưới tiêu đề */
    padding-top: 40px;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); /* Thêm bóng cho chữ để nó nổi bật hơn */
=======
    font-family: 'Arial', sans-serif; 
    font-size: 48px;
    color: #333; 
    font-weight: bold; 
    text-align: center; 
    text-transform: uppercase; 
    letter-spacing: 2px; 
    margin-bottom: 40px; 
    padding-top: 40px;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); 
>>>>>>> feature/index
}
</style>
</head>

<body>
    <div class="container mt-5">
        <h1>Danh sách tin tức</h1>

<<<<<<< HEAD
        <!-- Tìm kiếm tin tức -->
=======
        
>>>>>>> feature/index
        <form action="index.php" method="get" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm tin tức..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                <button class="btn btn-primary" type="submit">Tìm kiếm</button>
            </div>
        </form>

        <?php if (count($newsList) > 0): ?>
            <div class="row">
                <?php foreach ($newsList as $news): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?= $news['image'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($news['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars(substr($news['content'], 0, 100)) ?>...</p>
                                <a href="index.php?controller=home&action=detail&id=<?= $news['id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Không có tin tức nào để hiển thị.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
