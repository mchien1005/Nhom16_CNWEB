<?php
require_once 'C:/xampp/htdocs/tlunews/models/User.php';

class AdminController {
    public function login() {
        include "../views/admin/login.php";
    }

    public function dashboard() {
        include "../views/admin/dashboard.php";
    }
    public function manageNews()
    {
        include 'C:\xampp\htdocs\tlunews\views\admin\new\index.php';
    }
}
