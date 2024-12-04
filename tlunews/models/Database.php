<?php
class Database {
    public static function connect() {
        try {
            $dsn = "mysql:host=localhost;dbname=tintuc;charset=utf8";
            $username = "root";
            $password = "";

            return new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage());
        }
    }
}

