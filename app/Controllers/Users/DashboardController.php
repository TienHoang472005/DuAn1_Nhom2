<?php
class DashboardController{
    public function dashboard(){
        $categoryModel = new CategoryUserModel();
        $listCategory = $categoryModel->getCategoryDB();

        $productModel = new ProductUserModel();
        $listProduct = $productModel->getProductDB();

        include 'app/Views/Users/index.php';
    }
}