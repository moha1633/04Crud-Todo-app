<?php
ob_start();
include('dbcon.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM `todos` WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if($stmt->execute()){
            header('location:index.php?delete_msg=Task deleted successfully');
        } else {
            die("query failed");
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

ob_end_flush();
?>
