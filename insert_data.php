<?php
ob_start();
include('dbcon.php');

if(isset($_POST['add_todo'])) {
    $task = $_POST['task'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $completed = 0; // Default to not completed

    $stmt = $conn->prepare("INSERT INTO `todos` (task, description, due_date, completed) VALUES (:task, :description, :due_date, :completed)");
    $stmt->bindParam(':task', $task);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':due_date', $due_date);
    $stmt->bindParam(':completed', $completed);

    if($stmt->execute()){
        header('Location: index.php?insert_msg=Todo added successfully');
    } else {
        header('Location: index.php?message=Error adding todo');
    }
}
ob_end_flush();
?>
