<?php
include('header.php'); // Include header file
include('dbcon.php'); // Include database connection file

try {
    // Check if $conn is set
    if (isset($conn)) {
        // Prepare and execute SQL statement to fetch data
        $stmt = $conn->prepare("SELECT * FROM `04Crud-Todo-app`");

        // Check if query executed successfully
        if ($stmt->execute()) {
            // Fetch all rows as an associative array
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error executing SQL query.");
        }
    } else {
        throw new Exception("Database connection is not established.");
    }
} catch (PDOException $e) {
    // Catch PDOException and display error message
    echo "Error: " . $e->getMessage();
} catch (Exception $e) {
    // Catch general Exception and display error message
    echo "Error: " . $e->getMessage();
}
?>


    

    <div class="row">
        <div class="col-md-6">
        <button class="btn btn-primary"><a href="add_student.php" class="text-white">Add Students</a></button>

        </div>
        <div class="col-md-6 text-end">
            <!-- Empty div to align button to the right -->
        </div>
    </div>

    <h1 class="text-center mb-4">All Students</h1>
    <table class="table table-hover mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
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
                    </tr>
                <?php
                endforeach;
            else :
                ?>
                <tr>
                    <td colspan="4">No students found.</td>
                </tr>
            <?php
            endif;
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
