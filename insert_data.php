<?php
// Starta output buffering
ob_start();

// Inkludera filen för databasanslutning
include('dbcon.php');

if(isset($_POST['add_students'])) {
    // Hämta formulärdata
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $age = $_POST['age'];
    $program = $_POST['program'] ?? ''; // Hämta programvärdet eller sätt standard till tom sträng

    // Förbered SQL-fråga för att lägga till data
    $stmt = $conn->prepare("INSERT INTO `04Crud-Todo-app` (first_name, last_name, age, Program) VALUES (:f_name, :l_name, :age, :program)");
    
    // Binda parametrar
    $stmt->bindParam(':f_name', $f_name);
    $stmt->bindParam(':l_name', $l_name);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':program', $program);

    // Utför frågan
    if($stmt->execute()){
        // Om utförandet är framgångsrikt, omdirigera till index-sidan med ett meddelande
        header('location:index.php?insert_msg=Data added successfull');
    } else {
        // Om det uppstår ett fel, omdirigera till index-sidan med ett felmeddelande
        header('location:index.php?message=Fel vid tillägg av data');
    }
} elseif(isset($_POST['update_students'])) {
    // Uppdatera data
    // Här kommer koden för att uppdatera studentdata att placeras
}

// Töm output buffern
ob_end_flush();
?>
