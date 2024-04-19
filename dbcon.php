<?php
$host = 'db';  // Docker Compose service name
$dbname = '04Crud-Todo-app';
$user = 'root';
$pass = 'mariadb';

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Echo a success message
    echo "";

} catch(PDOException $e) {
    // If connection fails, echo the error message
    echo "Connection failed: " . $e->getMessage();
    exit;  // Exit the script if connection fails
}
?>
