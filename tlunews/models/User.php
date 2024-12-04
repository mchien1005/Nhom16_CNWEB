<?php
require_once "Database.php"; // Include file Database.php

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
        $user = self::findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }
    public static function login($username, $password) {
        // Kết nối cơ sở dữ liệu
        $db = Database::connect();

        // Truy vấn tìm người dùng theo tên đăng nhập
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Kiểm tra mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Trả về thông tin người dùng nếu mật khẩu đúng
        }

        return false; // Trả về false nếu đăng nhập thất bại
    }
}
