<?php
// Start output buffering
ob_start();

// Including the database connection file
include('dbcon.php');

if(isset($_POST['add_students'])) {
    // Get form data
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];
    $program = $_POST['program'] ?? ''; // Get the program value or set default to empty string

    // Prepare SQL query for inserting data
    $stmt = $conn->prepare("INSERT INTO `04Crud-Todo-app` (first_name, last_name, age, Program) VALUES (:f_name, :l_name, :age, :program)");
    
    // Bind parameters
    $stmt->bindParam(':f_name', $f_name);
    $stmt->bindParam(':l_name', $l_name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':program', $program);

    // Execute query
    if($stmt->execute()){
        header('location:index.php?insert_msg=Data added successfully');
    } else {
        header('location:index.php?message=Error adding data');
    }
} elseif(isset($_POST['update_students'])) {
    // Update data

}

// Flush the output buffer
ob_end_flush();
?>
