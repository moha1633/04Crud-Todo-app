<?php
ob_start();  // Starta outputbuffring

include('dbcon.php');  // Inkludera databasanslutningen från dbcon.php

if(isset($_GET['id'])){  // Kontrollera om 'id' finns i URL-parametrarna
    $id = $_GET['id'];  // Tilldela värdet av 'id' till variabeln $id

    try {
        // Förbered SQL-frågan för att radera en post baserad på 'id'
        $stmt = $conn->prepare("DELETE FROM `04Crud-Todo-app` WHERE id = :id");
        
        // Bind 'id'-parametern till SQL-frågan
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        // Kör SQL-frågan
        if($stmt->execute()){
            // Om raderingen lyckas, omdirigera till index.php med ett meddelande
            header('location:index.php?delete_msg=you have deleted the record.');
        } else {
            // Om SQL-frågan misslyckas, avsluta scriptet med ett felmeddelande
            die("query failed");
        }
    } catch(PDOException $e) {
        // Hantera undantag och visa felmeddelande
        echo "Error: " . $e->getMessage();
    }
}

ob_end_flush();  // Flöda (skicka) den buffrade outputen
?>
