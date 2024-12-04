<?php
session_start(); // Bắt đầu session

// Hủy tất cả session
session_unset(); 

// Hủy session
session_destroy();

// Chuyển hướng người dùng về trang login.php
header("Location: login.php");
exit;
?>
