<?php

$role = isset($_GET['role']) ? $_GET['role'] : "user";
$act = isset($_GET['act']) ? $_GET['act'] : "";

// Đăng nhập user
if ($role == "user") {
        echo "Trang client"; 
} else {
    // Đăng nhập Admin
    switch ($act) {
        case 'home':
            $homeController = new HomeController();
            $homeController->dashboard();
            break;

        case 'login':
            $loginController = new LoginController();
            $loginController->login();
            break;

        case 'post-login':
            $loginController = new LoginController();
            $loginController->postLogin();
            break;

        case 'logout':
            $loginController = new LoginController();
            $loginController->logout();
            break;

        // Quản lý sản phẩm
        case 'all-product': {
            $productController = new ProductController();
            $productController->showAllProduct();
            break;
        }

        case 'delete-product': {
            $productController = new ProductController();
            $productController->deleteProduct();
            break;
        }

        case 'add-product': {
            $productController = new ProductController();
            $productController->addProduct();
            break;
        }
        
        case 'add-post-product': {
            $productController = new ProductController();
            $productController->addPostProduct();
            break;
        }

        case 'update-product': {
            $productController = new ProductController();
            $productController->updateProduct();
            break;
        }

        case 'update-post-product': {
            $productController = new ProductController();
            $productController->updatePostProduct();
            break;
        }

        case 'show-product': {
            $productController = new ProductController();
            $productController->showProduct();
            break;
        }
    }

}
