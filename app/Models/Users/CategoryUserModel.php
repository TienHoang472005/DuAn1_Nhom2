<?php
class CategoryUserModel {
    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCategoryDB(){
        $sql = "select * from categories";
        $query = $this->db->pdo->query($sql);
        $result = $query->fetchAll();
        return $result;
    }
}

?>