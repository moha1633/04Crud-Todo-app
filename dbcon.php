<?php
// Definiera databasanlutningsuppgifter
$host = 'db';  // Namnet på Docker Compose-tjänsten för databasen
$dbname = '04Crud-Todo-app';
$user = 'root';
$pass = 'mariadb';

try {
    // Skapa en ny instans av PDO med angivna anslutningsuppgifter
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    
    // Ange att PDO ska kasta undantag vid fel
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Hantera eventuellt fel som uppstår vid anslutning
    echo "Connection failed: " . $e->getMessage();
    exit;  // Avsluta scriptet om anslutningen misslyckas
}
?>
