<?php
include('dbcon.php');

if(isset($_POST['add_students'])) {
    // Insert data
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];
    $program = $_POST['program'] ?? ''; // Get the program value or set default to empty string

    $stmt = $conn->prepare("INSERT INTO `04Crud-Todo-app` (first_name, last_name, age, Program) VALUES (:f_name, :l_name, :age, :program)");
    $stmt->bindParam(':f_name', $f_name);
    $stmt->bindParam(':l_name', $l_name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':program', $program); // Bind program value

    if($stmt->execute()){
        header('location:index.php?insert_msg=Data added successfully');
    } else {
        header('location:index.php?message=Error adding data');
    }
} elseif(isset($_POST['update_students'])) {
    // Update data
    $id = $_POST['id'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];

    $stmt = $conn->prepare("UPDATE `04Crud-Todo-app` SET first_name = :f_name, last_name = :l_name, age = :age WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':f_name', $f_name);
    $stmt->bindParam(':l_name', $l_name);
    $stmt->bindParam(':age', $age);

    if($stmt->execute()){
        header('location:index.php?insert_msg=Data updated successfully');
    } else {
        header('location:index.php?message=Error updating data');
    }
}
?>
