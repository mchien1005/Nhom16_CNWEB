<?php
require_once __DIR__ . "/Database.php";

class User {

    public static function authenticate($username, $password) {
        $db = Database::connect();
    
        
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
       
        if ($user && $user['password'] === $password) {
            return $user; // Trả về thông tin người dùng nếu đúng
        }

        return false; // Trả về false nếu không tìm thấy hoặc mật khẩu sai
        
    }
    
    

}