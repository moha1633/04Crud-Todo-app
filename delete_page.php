<?php
ob_start();  // Start output buffering

include('dbcon.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("DELETE FROM `04Crud-Todo-app` WHERE id = :id");
        
        // Bind the parameter
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Execute the statement
        if($stmt->execute()){
            header('location:index.php?delete_msg=you have deleted the record.');
        } else {
            die("query failed");
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

ob_end_flush();  // Flush the output buffer
?>
