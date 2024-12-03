### Hướng dẫn hoàn thành bài tập xây dựng website tin tức theo mô hình MVC

Dựa trên nội dung yêu cầu trong file bài tập, đây là các bước cụ thể bạn có thể làm để hoàn thành dự án:

---

#### **1. Thiết kế cơ sở dữ liệu**
- **Tạo CSDL `tintuc`** bằng MySQL Workbench hoặc phpMyAdmin với các bảng:
  - **users**: Chứa thông tin người dùng và quyền (0: người dùng khách, 1: quản trị viên).
  - **categories**: Chứa danh mục tin tức.
  - **news**: Chứa bài viết tin tức.
- Mã SQL mẫu:
  ```sql
  CREATE DATABASE tintuc;
  USE tintuc;

  CREATE TABLE users (
      id INT PRIMARY KEY AUTO_INCREMENT,
      username VARCHAR(255),
      password VARCHAR(255),
      role INT
  );

  CREATE TABLE categories (
      id INT PRIMARY KEY AUTO_INCREMENT,
      name VARCHAR(255)
  );

  CREATE TABLE news (
      id INT PRIMARY KEY AUTO_INCREMENT,
      title VARCHAR(255),
      content TEXT,
      image VARCHAR(255),
      created_at DATETIME,
      category_id INT,
      FOREIGN KEY (category_id) REFERENCES categories(id)
  );
  ```

---

#### **2. Tổ chức thư mục theo mô hình MVC**
- **Cấu trúc thư mục**:
  ```
  tlunews/
  ├── controllers/
  │   ├── HomeController.php
  │   ├── AdminController.php
  │   └── NewsController.php
  ├── models/
  │   ├── User.php
  │   ├── Category.php
  │   └── News.php
  ├── views/
  │   ├── home/
  │   │   └── index.php
  │   ├── news/
  │   │   └── detail.php
  │   ├── admin/
  │   │   ├── login.php
  │   │   ├── dashboard.php
  │   │   └── news/
  │   │       ├── index.php
  │   │       ├── add.php
  │   │       └── edit.php
  ├── .htaccess
  └── index.php
  ```

---

#### **3. Lập trình chức năng**
- **Người dùng khách**:
  - Xem danh sách tin tức (hiển thị trong `views/home/index.php`).
  - Xem chi tiết tin tức (hiển thị trong `views/news/detail.php`).
  - Tìm kiếm tin tức (thêm chức năng tìm kiếm trong `controllers/HomeController.php`).

- **Quản trị viên**:
  - Đăng nhập/đăng xuất (`views/admin/login.php`).
  - Quản lý tin tức (thêm, sửa, xóa, hiển thị tin tức trong `views/admin/news/*`).

- **Lập trình cơ bản**:
  - Tạo Controller: Ví dụ `NewsController.php`:
  
  
    ```php
    class NewsController {
        public function index() {
            $news = News::getAll();
            include "views/home/index.php";
        }

        public function detail($id) {
            $news = News::getById($id);
            include "views/news/detail.php";
        }
    }
    ```
  - Tạo Model: Ví dụ `News.php`:
  

/*     ```
    class News {
        public static function getAll() {
            $db = Database::connect();
            $stmt = $db->query("SELECT * FROM news");
            return $stmt->fetchAll();
        }

        public static function getById($id) {
            $db = Database::connect();
            $stmt = $db->prepare("SELECT * FROM news WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch();
        }
    }
    ``` */

---

#### **4. Giao diện cơ bản với Bootstrap 5**
- Sử dụng Bootstrap 5 để tạo các trang giao diện:
  - **Trang danh sách tin tức**:
    
	
	```
    <div class="container mt-5">
        <h1>Danh sách tin tức</h1>
        <div class="row">
            <?php foreach ($news as $item): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?= $item['image'] ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $item['title'] ?></h5>
                            <a href="index.php?controller=news&action=detail&id=<?= $item['id'] ?>" class="btn btn-primary">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    ```

