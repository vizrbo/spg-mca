<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Should have this for the proper encoding -->
        <meta charset="utf-8">

        <!-- Must have for Responsive Web Design -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>The SPG - Student Info</title>
        <link rel="stylesheet" href="status.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono:bold|Ubuntu">
        <link rel="shortcut icon" href="spg logo favicon.png">
    </head>

    <body>
        <div class="navbar">
            <ul id="left-nav">
                <li>
                    <img src="spg logo side.png" style="width:16%;"/>
                </li>
            </ul>
            <ul id="right-nav">
                <a href="index.html">Log Out</a>
            </ul>
            <ul id="right-nav">
                <a href="admindash.html">Dashboard</a>
            </ul>
        </div>
        
        <div class="wrapper">
            <h2>Enter Student ID</h2>

            <!--  INPUT SECTION STARTS HERE -->

            <form method="POST" action="status.php">
                <div class="input-group">
                    <div class="input-box">
                        <!-- for MySQL: id -->
                        <input class="name" type="text" placeholder="Student ID" required name="id">
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-box">
                        <button type="submit">Submit</button>
                    </div>
                </div>
            </form>

            <!-- OUTPUT SECTION STARTS HERE -->

            <table>
                <tbody>
                    <?php
                        // Include the db.php file
                        require_once "db.php";

                        // Check if the user submitted a ID
                        if (isset($_POST["id"])) {

                        // Get the form data
                        $id = $_POST['id'];

                        // Create the SQL query
                        $query = "SELECT * FROM studentdata WHERE ID = $id";

                        // Execute the query
                        $result = $conn->query($query);

                        // Check if the query returned any results
                        if ($result->num_rows > 0) {

                            // Get the first row of the results
                            $row = $result->fetch_assoc();

                            // Display the results in a table
                            echo "<tr>";
                            echo "<th>Student ID</th>";
                            echo "<td>{$row["ID"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Password</th>";
                            echo "<td>{$row["UserPassword"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Stream</th>";
                            echo "<td>{$row["Stream"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Student's Name</th>";
                            echo "<td>{$row["StudentName"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Email ID</th>";
                            echo "<td>{$row["Email"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Mobile Number</th>";
                            echo "<td>{$row["MobileNumber"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Father's Name</th>";
                            echo "<td>{$row["FatherName"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Mother's Name</th>";
                            echo "<td>{$row["MotherName"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Semester 1</th>";
                            echo "<td>{$row["Semester1"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Semester 2</th>";
                            echo "<td>{$row["Semester2"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Semester 3</th>";
                            echo "<td>{$row["Semester3"]}</td>";
                            echo "</tr>";

                            echo "<tr>";
                            echo "<th>Semester 4</th>";
                            echo "<td>{$row["Semester4"]}</td>";
                            echo "</tr>";

                            if ($row["Stream"] == "BCA") {
                                echo "<tr>";
                                echo "<th>Semester 5</th>";
                                echo "<td>{$row["Semester5"]}</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Semester 6</th>";
                                echo "<td>{$row["Semester6"]}</td>";
                                echo "</tr>";
                            } elseif ($row["Stream"] == "BTech - CSE") {
                                echo "<tr>";
                                echo "<th>Semester 5</th>";
                                echo "<td>{$row["Semester5"]}</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Semester 6</th>";
                                echo "<td>{$row["Semester6"]}</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Semester 7</th>";
                                echo "<td>{$row["Semester7"]}</td>";
                                echo "</tr>";
                                echo "<tr>";
                                echo "<th>Semester 8</th>";
                                echo "<td>{$row["Semester8"]}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<p>Please enter a valid ID</p>";
                        }
                        }
                        // Close the database connection
                        $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- CLEAR FORM IF PAGE IS REFRESHED -->
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
    </body>
</html>