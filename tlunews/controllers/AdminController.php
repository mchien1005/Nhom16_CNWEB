<?php
require_once "models/User.php";  // Đảm bảo đường dẫn này chính xác
require_once "models/Database.php";

class AdminController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Xử lý kết nối cơ sở dữ liệu và kiểm tra lỗi kết nối
            try {
                $db = Database::connect();  // Kết nối với cơ sở dữ liệu
            } catch (PDOException $e) {
                die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
            }

            // Truy vấn và xác thực người dùng
            $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND role = 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Đăng nhập thành công
                session_start();
                $_SESSION['admin'] = $user;
                header("Location: views/admin/dashboard.php");
                exit;
            } else {
                // Sai thông tin đăng nhập
                echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!');</script>";
            }
        }
    }

    public function dashboard() {
        include "../views/admin/dashboard.php";
    }
}
