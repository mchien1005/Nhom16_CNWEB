<?php
require_once 'C:/Users/minhc/OneDrive/Tài liệu/GitHub/Nhom16_CNWEB/tlunews/models/News.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Xóa tin tức khỏi cơ sở dữ liệu
    if (News::delete($id)) {
        header("Location: index.php"); // Chuyển hướng về trang index sau khi xóa
        exit;
    } else {
        echo "Xóa tin tức thất bại.";
    }
}
?>