<?php
class DashboardController
{
    public function dashboard()
    {
        $categoryModel = new CategoryUserModel();
        $listCategory = $categoryModel->getCategoryDB();

        $productModel = new ProductUserModel();
        $listProduct = $productModel->getProductDB();

        include 'app/Views/Users/index.php';
    }

    // Giỏ hàng
    public function shoppingCart()
    {
        $cartModel = new CartUserModel();
        $data = $cartModel->showCartModel();

        include 'app/Views/Users/shopping-cart.php';
    }
}
