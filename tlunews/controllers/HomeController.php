<?php
require_once 'C:\xampp\htdocs\Nhom16_CNWEB\tlunews\models\News.php';

class HomeController {
    public function index() {
        $news = News::getAll();
        include 'C:\xampp\htdocs\tlunews\views\home\index.php';
    }

    public function detail() {
        $id = $_GET['id'] ?? 0;
        $news = News::getById($id);
        include 'C:\xampp\htdocs\tlunews\views\news\detail.php';
    }
}
