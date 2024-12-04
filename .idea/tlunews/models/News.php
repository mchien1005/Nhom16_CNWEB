<?php
require_once __DIR__ . '/Database.php';

class News {
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM news");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function add($title, $content, $imagePath, $category_id) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO news (title, content, image, category_id, created_at) VALUES (?, ?, ?, ?, NOW())");
        return $stmt->execute([$title, $content, $imagePath, $category_id]);
    }


    public static function update($id, $title, $content) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE news SET title = ?, content = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $id]); // Trả về true/false
    }
    
    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM news WHERE id = ?");
        return $stmt->execute([$id]); // Trả về true/false
    }
    
    
}
