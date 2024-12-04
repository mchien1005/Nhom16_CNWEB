<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Admin Dashboard</h1>
        <div class="mt-4">
            <h3>Chào mừng, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</h3>
            <a href="#" class="btn btn-danger" id="logoutButton">Đăng xuất</a>
        </div>

        <div class="mt-5">
            <h2>Quản lý</h2>
            <div class="list-group">
                <a href="../../index.php?controller=admin&action=manageNews" class="list-group-item list-group-item-action">Quản lý Tin tức</a>
                <a href="../../index.php?controller=admin&action=manageCategories" class="list-group-item list-group-item-action">Quản lý Danh mục</a>
                <a href="../../index.php?controller=admin&action=manageUsers" class="list-group-item list-group-item-action">Quản lý Người dùng</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('logoutButton').addEventListener('click', function(event) {
            event.preventDefault(); 
            if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
                window.location.href = 'logout.php';
            }
        });
    </script>
</body>
</html>

