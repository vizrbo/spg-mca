<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <!-- Should have this for the proper encoding -->
        <meta charset="utf-8">

        <!-- Must have for Responsive Web Design -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>The SPG - Student Dashboard</title>
        <link rel="stylesheet" href="../styles/landing.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono:bold|Ubuntu">
        <link rel="shortcut icon" href="../images/spg logo favicon.png">
    </head>

    <body>
        <!-- TOP NAVIGATION BAR -->
        <div class="navbar">
            <ul id="left-nav">
                <li>
                    <img src="../images/spg logo side.png" style="width:16%;"/>
                </li>
            </ul>
            <ul id="right-nav">   
                <a href="../index.html">Log Out</a>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <div class="center">
            <h1>Welcome!</h1>
            <h2>Please choose the<br>BTech - CSE Semester<br><small>(The semester fee is: Rs 45,000)</small></h2>

            <form method="post">
                <!-- ROW 1 -->
                <div class="center1">
                    <div class="center2">
                        <input type="submit" value="Semester 1" name="semester">
                    </div>
                    <div class="center2">
                        <input type="submit" value="Semester 2" name="semester">
                    </div>
                </div>

                <!-- ROW 2 -->
                <div class="center1">
                    <div class="center2">
                        <input type="submit" value="Semester 3" name="semester">
                    </div>
                    <div class="center2">
                        <input type="submit" value="Semester 4" name="semester">
                    </div>
                </div>

                <!-- ROW 3 -->
                <div class="center1">
                    <div class="center2">
                        <input type="submit" value="Semester 5" name="semester">
                    </div>
                    <div class="center2">
                        <input type="submit" value="Semester 6" name="semester">
                    </div>
                </div>
                
                <!-- ROW 4 -->
                <div class="center1">
                    <div class="center2">
                        <input type="submit" value="Semester 7" name="semester">
                    </div>
                    <div class="center2">
                        <input type="submit" value="Semester 8" name="semester">
                    </div>
                </div>

                <!-- PHP CODE BEGINS -->
                <?php
                    // Check if student ID is in the URL
                    if (!isset($_GET['ID'])) {
                        // Redirect to the login page
                        header("Location: ../login.html");
                    }

                    // Include the db.php file
                    require_once "../db.php";

                    // Get the ID of the student
                    $id = $_GET['ID'];

                    // Get the semester that the user wants to check
                    $semester = $_POST['semester'];

                    // To ensure we are getting the correct column in the database
                    $column = "Semester" . substr($semester, -1);

                    // Get the value of the semester from the database
                    $sql = "SELECT $column FROM studentdata WHERE ID = '$id'";
                    $result = $conn->query($sql);

                    // Get the value of the semester
                    $row = $result->fetch_assoc();
                    $value = $row[$column];

                    // Close the connection to the database
                    $conn->close();

                    // Check if the semester is unpaid
                    if ($value == 'Unpaid') {
                        // Send the user to the page where they can pay for the semester
                        header('Location: payment.php?ID=' . $id . '&Sem=' . $column);
                    } else {
                        // Alert the user that they have already paid for the semester
                        echo '<script>
                                    alert("You have already paid for this semester.");
                                </script>';
                    }
                ?>
            </form>
        </div>
    </body>
</html>
