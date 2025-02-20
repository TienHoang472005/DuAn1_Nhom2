<?php
class ProductUserModel {
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getProductDB(){
        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 8";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }

    public function getDataShop(){
        $sql = "SELECT * FROM `products`";
        if(isset($_GET['category_id'])){
            $sql = $sql . "where category_id = :category_id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':category_id', $_GET['category_id']);
        }else{
            $stmt = $this->db->pdo->prepare($sql);
        }
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getProductById(){
        if(isset($_GET['product_id'])){
            $product_id = intval($_GET['product_id']); 
            $sql = "SELECT * FROM `products` WHERE id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch();
            return $result ?: null; 
        }
        return null;
    }
    

    public function getProductImageById(){
        if(isset($_GET['product_id'])){
            $sql = "SELECT * FROM `product_image` WHERE product_id = :id";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':id', $_GET['product_id']);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }
    }

    public function getOtherProduct($categoryId, $productId){
        $sql = "SELECT * FROM `products` WHERE category_id = :category_id and id != :productId";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':category_id', $categoryId);
        $stmt->bindParam(':productId', $productId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function getComment($productId){
        $sql = "SELECT product_comment.*, users.name, users.image FROM `product_comment` JOIN users on product_comment.user_id = users.id where product_comment.product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    

    public function getRating($productId){
        $sql = "select * from product_rating where product_id = :product_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':product_id', $productId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>