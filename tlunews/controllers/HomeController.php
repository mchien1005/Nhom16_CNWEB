<?php
require_once 'C:\Users\minhc\OneDrive\Tài liệu\GitHub\Nhom16_CNWEB\tlunews\models\News.php';

class HomeController {
    public function index() {
        $news = News::getAll();
        include 'C:\Users\minhc\OneDrive\Tài liệu\GitHub\Nhom16_CNWEB\tlunews\views\home\index.php';
    }

    public function detail() {
        $id = $_GET['id'] ?? 0;
        $news = News::getById($id);
        include 'C:\Users\minhc\OneDrive\Tài liệu\GitHub\Nhom16_CNWEB\tlunews\views\news\detail.php';
    }
}
