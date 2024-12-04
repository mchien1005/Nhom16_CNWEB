<?php
require_once "models/News.php";

class HomeController {
    public function index() {
        $news = News::getAll();
        include "views/home/index.php";
    }

    public function detail() {
        $id = $_GET['id'] ?? 0;
        $news = News::getById($id);
        include "views/news/detail.php";
    }
}
