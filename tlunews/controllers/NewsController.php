<?php
require_once 'C:\Users\minhc\OneDrive\Tài liệu\GitHub\Nhom16_CNWEB\tlunews\models\News.php';

class NewsController {
    public function index() {
        $news = News::getAll();
        include "../views/admin/new/index.php";
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $imagePath = $_POST['image'];
            $category_id = $_POST['category_id'];
            News::add($title, $content,$imagePath, $category_id);
            header("Location: index.php?controller=news&action=index");
        } else {
            include "../views/admin/new/add.php";
        }
    }

    public function edit() {
        $id = $_GET['id'] ?? 0;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            News::update($id, $title, $content);
            header("Location: index.php?controller=news&action=index");
        } else {
            $news = News::getById($id);
            include "../views/admin/new/edit.php";
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? 0;
        News::delete($id);
        header("Location: index.php?controller=news&action=index");
    }
}
