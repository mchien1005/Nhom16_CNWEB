<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Web</title>
   
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
  
body {
    font-family: 'Roboto', sans-serif;
    background: #fafafa; 
    color: #333;
    line-height: 1.6;
}


.navbar {
    background-color: #343a40; 
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
    padding: 15px 0;
}
.navbar a {
    color: #f8f9fa !important; 
    text-transform: uppercase;
    letter-spacing: 1px;
}
.navbar a:hover {
    color: #ff6347 !important;
    transition: color 0.3s ease;
}

.card {
    border-radius: 10px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease;
}
.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    opacity: 0.9;
}
.card-body {
    padding: 40px;
    font-size: 16px;
    color: #555;
}


.page-header {
    text-align: center;
    margin: 60px 0;
    padding: 20px 0;
}
.page-header h1 {
    font-size: 42px;
    font-weight: 700;
    color: #343a40; 
}
.page-header p {
    font-size: 20px;
    color: #6c757d;
}


.content-section {
    background-color: #ffffff;
    border-radius: 8px;
    padding: 50px;
    margin-top: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease, transform 0.3s ease;
}
.content-section:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    transform: translateY(-5px);
}
.content-section h2 {
    color: #495057;
    margin-bottom: 25px;
    font-size: 32px;
    font-weight: 600;
}
.content-section p {
    font-size: 18px;
    line-height: 1.8;
    color: #555;
}


.breadcrumb-item > a {
    color: #6c757d;
    text-decoration: none;
}
.breadcrumb-item > a:hover {
    color: #ff6347;
    transition: color 0.3s ease;
}


footer {
    background-color: #343a40; 
    color: white;
    padding: 20px 0;
    text-align: center;
    position: fixed;
    width: 100%;
    bottom: 0;
    box-shadow: 0px -4px 10px rgba(0, 0, 0, 0.1);
}
footer p {
    font-size: 14px;
    color: #f8f9fa;
}

@media (max-width: 768px) {
    .page-header h1 {
        font-size: 32px;
    }
    .content-section {
        padding: 30px;
    }
    .navbar {
        padding: 10px 0;
    }
}

    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="?controller=home&action=index">Trang Chủ</a>
    </div>
</nav>


<div class="container">
    <div class="row">
        <div class="col-md-12">
        <?php
                require_once "models/Database.php";
                require_once "controllers/HomeController.php";
                require_once "controllers/AdminController.php";
                require_once "controllers/NewsController.php";

                
                $controller = isset($_GET['controller']) ? $_GET['controller'] : 'home';
                $action = isset($_GET['action']) ? $_GET['action'] : 'index';

             
                switch ($controller) {
                    case 'home':
                        $controllerObj = new HomeController();
                        break;
                    case 'admin':
                        $controllerObj = new AdminController();
                        break;
                    case 'news':
                        $controllerObj = new NewsController();
                        break;
                    default:
                        die("Controller không hợp lệ!");
                }

                if (method_exists($controllerObj, $action)) {
                    $controllerObj->$action();
                } else {
                    die("Action không hợp lệ!");
                }
            ?>
        </div>
    </div>
</div>


<footer>
    <p>© 2024 - Website của tôi. Mọi quyền lợi được bảo vệ.</p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
