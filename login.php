<?php

// Include the db.php file
require_once "db.php";

// Get the ID and Password from the login form
$formid = $_POST["formid"];
$formpassword = $_POST["formpassword"];

// Check if the user is an admin
$sql = "SELECT * FROM adminlogin WHERE AdminID = '$formid' AND AdminPassword = '$formpassword'";
$result = $conn->query($sql);

// If the user is an admin, redirect them to the admin dashboard
if ($result->num_rows > 0) {
    header("Location: admindash.html");
} else {

    // Check if the user is a student
    $sql = "SELECT * FROM studentdata WHERE ID = '$formid' AND UserPassword = '$formpassword'";
    $result = $conn->query($sql);

    // If the user is a student, check their stream
    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $stream = $row["Stream"];

    // Redirect the user to the appropriate landing page
    switch ($stream) {
        case "MCA":
        header("Location: landing4.php?ID=$formid");
        break;
        case "BCA":
        header("Location: landing6.php?ID=$formid");
        break;
        case "BTech - CSE":
        header("Location: landing8.php?ID=$formid");
        break;
    }
    } else {
        /* The user is not an admin or a student */
        echo '<script>
                    alert("Please enter valid credentials.");
                    window.location.href = "login.html";
                </script>';
    }
}

// Close the database connection
$conn->close();
?>