<?php

if(isset($_POST['add_students'])){
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name']; // Corrected variable name
    $age = $_POST['age'];
 
    if($f_name == "" || empty($f_name)){
      header('location:index.php?message=you need to fill in the first name!');
      exit; // Stop further execution
    }
 
    else {
     // Corrected SQL query with proper variable names and table/column names
     $query = "INSERT INTO students (first_name, last_name, age) VALUES ('$f_name', '$l_name', '$age')";
 
     $result = mysqli_query($conn, $query); // Added connection parameter
 
     if(!$result){
         die("Query Failed" . mysqli_error($conn)); // Added connection parameter
     }
     else{
         header('location:index.php?insert_msg=your data has been added successfully');
         exit;
     }
    }
 }
 ?>
 
?>
