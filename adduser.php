<?php

// Include the db.php file
require_once "db.php";

// Get the form data
$id = $_POST['id'];
$userpassword = $_POST['userpassword'];
$stream = $_POST['stream'];
$studentname = $_POST['studentname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$father = $_POST['father'];
$mother = $_POST['mother'];

// Check for Duplicate ID
$sql = "SELECT * FROM studentdata WHERE ID = '$id'";
$result = mysqli_query($conn, $sql);

// See if any row is getting returned having the same ID
if (mysqli_num_rows($result) > 0) {
    echo '<script>
                alert("This ID is already in use. Please use a different ID.");
                window.location.href = "adduser.html";
            </script>';
} else {
    // Insert data into the database
    $sql = "INSERT INTO studentdata (ID, UserPassword, Stream, StudentName, Email, MobileNumber, FatherName, MotherName)
    VALUES ('$id', '$userpassword', '$stream', '$studentname', '$email', '$phone', '$father', '$mother')";
    
    // Check if result of query is TRUE
    if ($conn->query($sql) === TRUE) {
        echo '<script>
                    alert("Student added to Database.");
                    window.location.href = "adduser.html";
                </script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>