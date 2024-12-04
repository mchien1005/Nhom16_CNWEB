<?php
require_once __DIR__ . "/Database.php"; // Include file Database.php

class User {
    // Lấy tất cả người dùng
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin người dùng theo ID
    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tìm người dùng theo username
    public static function findByUsername($username) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm người dùng mới
    public static function create($username, $password, $role = 0) {
        $db = Database::connect();

        $existingUser = self::findByUsername($username);
        if ($existingUser) {
            throw new Exception("Tên đăng nhập đã tồn tại.");
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Mã hóa mật khẩu
        $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        return $stmt->execute([$username, $hashedPassword, $role]);
    }

    // Cập nhật thông tin người dùng
    public static function update($id, $username, $password = null, $role = 0) {
        $db = Database::connect();
        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $db->prepare("UPDATE users SET username = ?, password = ?, role = ? WHERE id = ?");
            return $stmt->execute([$username, $hashedPassword, $role, $id]);
        } else {
            $stmt = $db->prepare("UPDATE users SET username = ?, role = ? WHERE id = ?");
            return $stmt->execute([$username, $role, $id]);
        }
    }

    // Xóa người dùng
    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Xác thực người dùng (Đăng nhập)
    public static function authenticate($username, $password) {
        $db = Database::connect();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            // Debug kiểm tra mật khẩu
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                error_log("Mật khẩu không khớp: " . $password . " | " . $user['password']);
            }
        } else {
            error_log("Không tìm thấy người dùng: " . $username);
        }
    
        return false;
    }
    

}
