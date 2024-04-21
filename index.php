<?php
include('header.php');
include('dbcon.php');

try {
    if (isset($conn)) {
        $stmt = $conn->prepare("SELECT id, first_name, last_name, age, program FROM `04Crud-Todo-app`");
        if ($stmt->execute()) {
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
            <h1 class="text-center bg-secondary text-white p-1 rounded">Student Registration Form</h1>
            <div class="d-flex justify-content-end mb-3">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Students</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mt-2">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Age</th>
                            <th>Program</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($students) && is_array($students)) :
                        foreach ($students as $student) :
                    ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['id']); ?></td>
                                <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($student['age']); ?></td>
                                <td><?php echo htmlspecialchars($student['program']); ?></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton<?php echo $student['id']; ?>" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton<?php echo $student['id']; ?>">
                                            <li><a class="dropdown-item" style="border-color: green; color: green;" href="update_page_1.php?id=<?php echo $student['id']; ?>">Update</a></li>
                                            <li><a class="dropdown-item" style="border-color: red; color: red;" href="delete_page.php?id=<?php echo $student['id']; ?>">Delete</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        endforeach;
                    else :
                    ?>
                            <tr>
                                <td colspan="6">No students found.</td>
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
if(isset($_GET['message'])){
    echo "<div class='alert alert-danger'>" . $_GET['message'] . "</div>";
}

if(isset($_GET['insert_msg'])){
    echo "<div class='alert alert-success'>" . $_GET['insert_msg'] . "</div>";
}

if(isset($_GET['update_msg'])){
    echo "<div class='alert alert-success'>" . $_GET['update_msg'] . "</div>";
}

if(isset($_GET['delete_msg'])){
    echo "<div class='alert alert-success'>" . $_GET['delete_msg'] . "</div>";
}
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="insert_data.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="f_name">First Name</label>
                        <input type="text" name="f_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="l_name">Last Name</label>
                        <input type="text" name="l_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" name="age" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="program">Program</label>
                        <select name="program" class="form-control">
                            <option value="Fullstack Developer">Fullstack Developer</option>
                            <option value="Frontend Developer">Frontend Developer</option>
                            <option value="Cloud Developer">Cloud Developer</option>
                            <option value="UX Design Developer">UX Design Developer</option>
                            <option value="Fullstack.NET Developer">Fullstack.NET Developer</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="add_students" value="ADD">ADD</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
