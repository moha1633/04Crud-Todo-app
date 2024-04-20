<?php
ob_start();  // Start output buffering
include('header.php'); 
include('dbcon.php');

$message = '';
$student = [];

$message = '';
$student = [];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    try {
        $stmt = $conn->prepare("SELECT * FROM `04Crud-Todo-app` WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $student = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error executing SQL query.");
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}

if(isset($_POST['update_students'])) {
    $id = $_POST['id'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];
    $program = $_POST['program'];

    try {
        $stmt = $conn->prepare("UPDATE `04Crud-Todo-app` SET first_name = :f_name, last_name = :l_name, age = :age, program = :program WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':f_name', $f_name);
        $stmt->bindParam(':l_name', $l_name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':program', $program);
    
        if($stmt->execute()){
            header('location:index.php?insert_data_msg=Data updated successfully');  // Corrected query parameter name
            exit;
        } else {
            throw new Exception("Error updating data.");
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<div class="container mt-5">
    <?php if(!empty($message)): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <form action="update_page_1.php" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label for="f_name">First Name</label>
                <input type="text" name="f_name" class="form-control" value="<?php echo isset($student['first_name']) ? htmlspecialchars($student['first_name']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="l_name">Last Name</label>
                <input type="text" name="l_name" class="form-control" value="<?php echo isset($student['last_name']) ? htmlspecialchars($student['last_name']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" name="age" class="form-control" value="<?php echo isset($student['age']) ? htmlspecialchars($student['age']) : ''; ?>">
            </div>
            <div class="form-group">
                <label for="program">Program</label>
                <select name="program" class="form-control">
                    <option value="Fullstack Developer" <?php echo isset($student['program']) && $student['program'] == 'Fullstack Developer' ? 'selected' : ''; ?>>Fullstack Developer</option>
                    <option value="Frontend Developer" <?php echo isset($student['program']) && $student['program'] == 'Frontend Developer' ? 'selected' : ''; ?>>Frontend Developer</option>
                    <option value="Cloud Developer" <?php echo isset($student['program']) && $student['program'] == 'Cloud Developer' ? 'selected' : ''; ?>>Cloud Developer</option>
                    <option value="UX Design Developer" <?php echo isset($student['program']) && $student['program'] == 'UX Design Developer' ? 'selected' : ''; ?>>UX Design Developer</option>
                    <option value="Fullstack.NET Developer" <?php echo isset($student['program']) && $student['program'] == 'Fullstack.NET Developer' ? 'selected' : ''; ?>>Fullstack.NET Developer</option>
                </select>
            </div>
            <!-- Hidden input field to send student ID -->
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
            <button type="submit" class="btn btn-success" name="update_students" value="UPDATE">UPDATE</button>
        </div>
    </form>
</div>
