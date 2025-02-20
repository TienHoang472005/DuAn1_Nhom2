<?php

class CartUserModel
{
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function showCartModel()
    {
        $userId = $_SESSION['users']['id'];
        $sql = "select * from cart where user_id = :user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $cart = $stmt->fetch();
        if (!$cart) {
            // Lấy thời gian hiện tại
            $now = date('Y-m-d H:i:s');
            $sql = "INSERT INTO `cart`(`user_id`, `created_at`, `updated_at`) VALUES (:user_id, :created_at, :updated_at)";
            $stmt = $this->db->pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':created_at', $now);
            $stmt->bindParam(':updated_at', $now);

            if ($stmt->execute()) {
                // Lấy ID của sản phẩm mới thêm
                $cartId = $this->db->pdo->lastInsertId();
            } else {
                return false;
            }
        } else {
            $cartId = $cart->id;
        }

        $sql = "select cart_detail.*, products.name, products.image_main, products.price, products.price_sale from cart_detail JOIN products on cart_detail.product_id = products.id where cart_detail.cart_id = :cart_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':cart_id', $cartId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
