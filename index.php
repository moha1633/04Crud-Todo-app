<?php
include('header.php');
include('dbcon.php');

try {
    if (isset($conn)) {
        $stmt = $conn->prepare("SELECT id, task, description, due_date, completed FROM `todos`");
        if ($stmt->execute()) {
            $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Todo</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mt-2">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Task</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Completed</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($todos) && is_array($todos)) :
                            foreach ($todos as $todo) :
                        ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($todo['id']); ?></td>
                                    <td><?php echo htmlspecialchars($todo['task']); ?></td>
                                    <td><?php echo htmlspecialchars($todo['description']); ?></td>
                                    <td><?php echo htmlspecialchars($todo['due_date']); ?></td>
                                    <td>
                                        <form action="mark_complete.php" method="post">
                                            <input type="hidden" name="todo_id" value="<?php echo $todo['id']; ?>">
                                            <input type="checkbox" name="completed" value="1" <?php echo $todo['completed'] ? 'checked' : ''; ?> onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $todo['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $todo['id']; ?>">
                                                <li><a class="dropdown-item" style="border-color: green; color: green;" href="update_page.php?id=<?php echo $todo['id']; ?>">Update</a></li>
                                                <li><a class="dropdown-item" style="border-color: red; color: red;" href="delete_page.php?id=<?php echo $todo['id']; ?>">Delete</a></li>
                                                <li>
                                                    <form action="mark_complete.php" method="post" style="display:inline;">
                                                        <input type="hidden" name="todo_id" value="<?php echo $todo['id']; ?>">
                                                        <input type="hidden" name="completed" value="1">
                                                        <button type="submit" class="dropdown-item" style="border-color: blue; color: blue;">Complete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                        else :
                            ?>
                            <tr>
                                <td colspan="6">No todos found.</td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['message'])) {
    echo "<div class='alert alert-danger'>" . $_GET['message'] . "</div>";
}

if (isset($_GET['insert_msg'])) {
    echo "<div class='alert alert-success'>" . $_GET['insert_msg'] . "</div>";
}

if (isset($_GET['update_msg'])) {
    echo "<div class='alert alert-success'>" . $_GET['update_msg'] . "</div>";
}

if (isset($_GET['delete_msg'])) {
    echo "<div class='alert alert-success'>" . $_GET['delete_msg'] . "</div>";
}

if (isset($_GET['complete_msg'])) {
    echo "<div class='alert alert-success'>" . $_GET['complete_msg'] . "</div>";
}
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Todo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="insert_data.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="task">Task</label>
                        <input type="text" name="task" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Due Date</label>
                        <input type="date" name="due_date" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="add_todo" value="ADD">ADD</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
