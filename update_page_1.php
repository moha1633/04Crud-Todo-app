<?php
ob_start();  // Starta output buffering
include('header.php');  // Inkluderar en header-fil för webbplatsen
include('dbcon.php');  // Inkluderar filen med databasanslutning

$message = '';  // Variabel för meddelanden
$student = [];  // Array för att lagra studentdata

// Kontrollera om ett ID har skickats via GET-parameter
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    try {
        // Förbered en SQL-fråga för att hämta data för en specifik student
        $stmt = $conn->prepare("SELECT * FROM `04Crud-Todo-app` WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);  // Binder ID:et till SQL-frågan
        
        if ($stmt->execute()) {
            $student = $stmt->fetch(PDO::FETCH_ASSOC);  // Hämta studentdata
        } else {
            throw new Exception("Error executing SQL query.");
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();  // Fångar och lagrar eventuella PDO-fel
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();  // Fångar och lagrar generella fel
    }
}

// Kontrollera om formuläret för att uppdatera studenter har skickats via POST
if(isset($_POST['update_students'])) {
    $id = $_POST['id'];
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];
    $program = $_POST['program'];

    try {
        // Förbered en SQL-fråga för att uppdatera studentdata
        $stmt = $conn->prepare("UPDATE `04Crud-Todo-app` SET first_name = :f_name, last_name = :l_name, age = :age, program = :program WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':f_name', $f_name);
        $stmt->bindParam(':l_name', $l_name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':program', $program);
    
        if($stmt->execute()){
            header('location:index.php?update_msg=Data updated successfully');  // Omdirigera till index med ett framgångsmeddelande
            exit;
        } else {
            throw new Exception("Error updating data.");
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();  // Fångar och lagrar PDO-fel
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();  // Fångar och lagrar generella fel
    }
}
?>

<div class="container mt-5">
    <?php if(!empty($message)): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>  <!-- Visa felmeddelande om det finns något -->
    <?php endif; ?>
    
    <!-- Formulär för att uppdatera studentdata -->
    <form action="update_page_1.php" method="post">
        <div class="modal-body">
            <!-- Input-fält för förnamn -->
            <div class="form-group">
                <label for="f_name">First Name</label>
                <input type="text" name="f_name" class="form-control" value="<?php echo isset($student['first_name']) ? htmlspecialchars($student['first_name']) : ''; ?>">
            </div>
            <!-- Input-fält för efternamn -->
            <div class="form-group">
                <label for="l_name">Last Name</label>
                <input type="text" name="l_name" class="form-control" value="<?php echo isset($student['last_name']) ? htmlspecialchars($student['last_name']) : ''; ?>">
            </div>
            <!-- Input-fält för ålder -->
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" name="age" class="form-control" value="<?php echo isset($student['age']) ? htmlspecialchars($student['age']) : ''; ?>">
            </div>
            <!-- Dropdown-lista för program -->
            <div class="form-group">
                <label for="program">Program</label>
                <select name="program" class="form-control">
                    <!-- Alternativ för olika program med förvalda värden baserat på studentens nuvarande program -->
                    <option value="Fullstack Developer" <?php echo isset($student['program']) && $student['program'] == 'Fullstack Developer' ? 'selected' : ''; ?>>Fullstack Developer</option>
                    <!-- ... liknande alternativ för andra program ... -->
                </select>
            </div>
            <!-- Dolt input-fält för att skicka med studentens ID -->
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : ''; ?>">
            <!-- Knapp för att skicka formuläret -->
            <button type="submit" class="btn btn-success" name="update_students" value="UPDATE">UPDATE</button>
            
        </div>
    </form>
</div>
