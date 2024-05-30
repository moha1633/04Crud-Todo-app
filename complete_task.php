<?php
include('dbcon.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    try {
        if (isset($conn)) {
            $stmt = $conn->prepare("UPDATE todos SET status = 'complete' WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                header("Location: index.php?update_msg=Task marked as complete.");
            } else {
                throw new Exception("Error executing SQL query.");
            }
        } else {
            throw new Exception("Database connection is not established.");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: index.php?message=No task ID provided.");
}
?>
