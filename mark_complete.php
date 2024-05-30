<?php
include('dbcon.php');

if (isset($_POST['todo_id'])) {
    $todo_id = $_POST['todo_id'];
    $completed = isset($_POST['completed']) ? 1 : 0;

    try {
        $stmt = $conn->prepare("UPDATE `todos` SET completed = :completed WHERE id = :id");
        $stmt->bindParam(':completed', $completed, PDO::PARAM_INT);
        $stmt->bindParam(':id', $todo_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: index.php?complete_msg=Todo marked as completed");
            exit();
        } else {
            throw new Exception("Error executing SQL query.");
        }
    } catch (PDOException $e) {
        header("Location: index.php?message=" . urlencode($e->getMessage()));
        exit();
    } catch (Exception $e) {
        header("Location: index.php?message=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: index.php?message=Invalid todo ID.");
    exit();
}
?>
