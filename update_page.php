<?php
ob_start();
include('header.php');  // Include header file
include('dbcon.php');   // Include database connection

$message = '';
$todo = [];

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Prepare and execute SQL query to fetch the todo item
        $stmt = $conn->prepare("SELECT * FROM `todos` WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $todo = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the todo item
        } else {
            throw new Exception("Error executing SQL query.");
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_todo'])) {
    // Extract data from POST request
    $id = $_POST['id'];
    $task = $_POST['task'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $completed = isset($_POST['completed']) ? 1 : 0;

    try {
        // Prepare SQL query to update the todo item
        $update_stmt = $conn->prepare("UPDATE `todos` SET task = :task, description = :description, due_date = :due_date, completed = :completed WHERE id = :id");
        $update_stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $update_stmt->bindParam(':task', $task, PDO::PARAM_STR);
        $update_stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $update_stmt->bindParam(':due_date', $due_date, PDO::PARAM_STR);
        $update_stmt->bindParam(':completed', $completed, PDO::PARAM_INT);

        // Execute the update query
        if ($update_stmt->execute()) {
            header('Location: index.php?update_msg=Todo successfully updated');
            exit();
        } else {
            header('Location: update_page.php?id=' . $id . '&message=Error updating todo');
            exit();
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!-- Update Todo Form -->
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center bg-secondary text-white p-1 rounded">Update Todo</h1>
            <form action="update_page.php?id=<?php echo $id; ?>" method="post">
                <input type="hidden" name="id" value="<?php echo isset($todo['id']) ? $todo['id'] : ''; ?>"> <!-- Hidden field to send todo ID -->
                <div class="form-group">
                    <label for="task">Task</label>
                    <input type="text" name="task" class="form-control" value="<?php echo isset($todo['task']) ? htmlspecialchars($todo['task']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" class="form-control"><?php echo isset($todo['description']) ? htmlspecialchars($todo['description']) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" name="due_date" class="form-control" value="<?php echo isset($todo['due_date']) ? htmlspecialchars($todo['due_date']) : ''; ?>">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="completed" value="1" <?php echo isset($todo['completed']) && $todo['completed'] ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="completed">Completed</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="update_todo">Update Todo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (!empty($message)) {
    echo "<div class='alert alert-danger'>" . $message . "</div>";
}
ob_end_flush();
?>
