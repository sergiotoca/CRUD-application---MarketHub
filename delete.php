<?php 
    include 'database.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE from product
                WHERE product_id = $id";
        $mysqli->query($sql);
    }
    header('location:/CRUD/index.php');
    exit;