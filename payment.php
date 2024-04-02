<!-- PHP CODE BEGINS -->
<?php
// Check if Semester is in the URL
if (!isset($_GET['Sem']) || !isset($_GET['ID'])) {
    // Redirect to the login page
    header("Location: login.html");
}

// Get the Semester from URL
$Semester = $_GET['Sem'];

// Get the ID of the student from URL
$ID = $_GET['ID'];

// Include the db.php file
require_once "db.php";
    
// Get the value of Email from the Database
$sql = "SELECT * FROM studentdata WHERE ID = $ID";
$result = $conn->query($sql);

if ($result) {
    // Check if the student ID exists in the database
    if ($result->num_rows > 0) {
        // Store the value of Email in a email variable
        $row = $result->fetch_assoc();
        $email = $row['Email'];
        $checkSem = $row[$Semester];
    } else {
        // Student ID not found, redirect to login.html
        $conn->close();
        header("Location: login.html");
        exit();
    }
}

// See whether the Semester has already been Paid
if ($checkSem == 'Paid') {
    header("Location: login.html");
}

// Check whether Student has submitted Form
if (isset($_POST['ID']) && isset($_GET['Sem'])) {
    
    // Update the value of the Semester to "Paid"
    $sql = "UPDATE studentdata SET $Semester = 'Paid' WHERE ID = $ID";
    $update = $conn->query($sql);

    // Close the database connection
    $conn->close();
    
    // Redirect Student to the Success Page
    if ($update) {
        header('Location: success.html');
        exit();
    }
}
?>
<!-- PHP CODE ENDS -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Should have this for the proper encoding -->
        <meta charset="utf-8">

        <!-- Must have for Responsive Web Design -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>The SPG - Payment</title>
        <link rel="stylesheet" href="styles/payment.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=IBM+Plex+Mono:bold|Ubuntu">
        <link rel="shortcut icon" href="images/spg logo favicon.png">
    </head>

    <body>
        <div class="navbar">
            <ul id="left-nav">
                <li>
                    <img src="images/spg logo side.png" style="width:16%;"/>
                </li>
            </ul>
            <ul id="right-nav">
                <a href="index.html">Log Out</a>
            </ul>
        </div>

        <div class="wrapper">
            <h2>Payment</h2>
            
            <form method="post">
                <h4>Student ID & Email</h4>

                <!-- STUDENT ID -->
                <div class="input-group">
                    <div class="input-box">
                        <input class="name" type="number" required value="<?php echo $ID; ?>" name="ID" readonly>
                    </div>
                </div>

                <!-- STUDENT EMAIL ID -->
                <div class="input-group">
                    <div class="input-box">
                        <input class="name" type="email" required value="<?php echo $email; ?>" readonly>
                    </div>
                </div>

                <!-- CARD TYPE OPTION -->
                <div class="input-group">
                    <div class="input-box">
                        <h4>Payment</h4>
                        <input type="radio" name=card id="bc1" checked class="radio">
                        <label for="bc1"><span>Credit Card</span></label>
                        <input type="radio" name=card id="bc2" class="radio">
                        <label for="bc2"><span>Debit Card</span></label>
                    </div>
                </div>

                <!-- CARD NUMBER & CVV FIELD -->
                <div class="input-group">
                    <div class="input-box">
                        <input type="tel" placeholder="Card Number" required class="name" pattern="\d{16}">
                    </div>
                    <div class="input-box">
                        <input type="tel" placeholder="CVV" required class="name" pattern="\d{3}">
                    </div>
                </div>

                <!-- CARD EXPIRY OPTIONS -->
                <div class="input-group">
                    <div>
                        <p>Card Expiry</p>
                    </div>
                    <div class="input-box">
                        <select>
                            <option>22 mar</option>
                            <option>10 apr</option>
                            <option>27 may</option>
                        </select>
                        <select>
                            <option>2021</option>
                            <option>2022</option>
                            <option>2023</option>
                        </select>
                    </div>
                </div>
                
                <!-- PAY NOW BUTTON -->
                <div class="input-group">
                    <div class="input-box">
                        <button type="submit">PAY NOW</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
