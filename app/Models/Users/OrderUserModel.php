<?php
class OrderUserModel{
    public $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getAllOrder(){
        $user_id = $_SESSION['users']['id'];
        // $sql = "SELECT * FROM `order` WHERE user_id = :";
        $sql = "SELECT * FROM `order` WHERE user_id = :user_id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getOrderDetail() {  
        $order_id = $_GET['order_id'];  
        $sql = "SELECT order_detail.*, products.name, products.image_main,   
                (order_detail.quantity * order_detail.price) AS total   
                FROM `order_detail`   
                JOIN products ON order_detail.product_id = products.id   
                WHERE order_detail.order_id = :order_id";         
        $stmt = $this->db->pdo->prepare($sql);  
        $stmt->bindParam(':order_id', $order_id);  
        $stmt->execute();  
        
        return $stmt->fetchAll();  
    }

    public function cancelOrderModel()  
{  
    $order_id = $_GET['order_id'];  
    $status = 'canceled';    
    $sql = "UPDATE `order` SET status = :status WHERE id = :order_id";  
    $stmt = $this->db->pdo->prepare($sql);     
    $stmt->bindParam(':status', $status);  
    $stmt->bindParam(':order_id', $order_id);     
    return $stmt->execute();  
}
}
    ?>
