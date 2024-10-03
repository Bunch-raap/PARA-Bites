<?php
session_start();

// Admin password (you can store this securely in a database)
$admin_password = 'Admin';

// Handle form submission for login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];

    // Check if password matches
    if ($password === $admin_password) {
        $_SESSION['admin_logged_in'] = true; // Set session variable
    } else {
        $error = "Incorrect password!";
    }
}

// Handle logout functionality
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy(); // Destroy session on logout
    header('Location: view_bookings.php'); // Redirect to login page after logout
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bookings - PARA Bites</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9; /* Light background color for contrast */
        }

        .logo img {
            width: 100px; /* Adjust logo size */
        }

        .login-box {
            background-color: white; /* White background for the login box */
            border: 2px solid #be5d00; /* Border to match theme */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Soft shadow */
            padding: 30px;
            width: 400px; /* Set width of login box */
            margin: 100px auto; /* Center the box vertically and horizontally */
        }

        .login-box h2 {
            color: #be5d00; /* Header color to match theme */
        }

        .login-box input[type="password"],
        .login-box input[type="submit"] {
            width: 100%; /* Full width inputs */
            padding: 10px;
            margin: 10px 0; /* Space between inputs */
            border: 1px solid #ccc; /* Light border */
            border-radius: 5px; /* Rounded corners for inputs */
        }

        .login-box input[type="submit"] {
            background-color: #be5d00; /* Submit button color */
            color: white; /* Text color for button */
            border: none; /* No border */
            cursor: pointer; /* Pointer cursor */
        }

        .login-box input[type="submit"]:hover {
            background-color: #e67e22; /* Darker shade on hover */
        }

        table {
            width: 90%; /* Full width for the table */
            margin: 20px auto; /* Center table */
            border-collapse: collapse; /* Merge borders */
        }

        table, th, td {
            border: 1px solid #ccc; /* Light border for table */
        }

        th, td {
            padding: 10px; /* Padding for table cells */
            text-align: center; /* Center text */
        }

        th {
            background-color: #be5d00; /* Header background color */
            color: white; /* Header text color */
        }

        p.no-bookings {
            text-align: center; /* Center text */
        }

        .logout-button {
            text-align: center; /* Center logout button */
            margin-top: 40px;
        }

        .logout-button button {
            padding: 10px 30px; 
            background-color: #be5d00; 
            color: white; 
            border: none; 
            cursor: pointer; 
        }

        .logout-button button:hover {
            background-color: #e67e22; /* Darker shade on hover */
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <img src="logo.jpg" alt="PARA Bites Logo">
        </div>
        <h1 style="font-size: 4em; margin: 0; color: #ff7f00; margin-left: 10px;">PARA Bites</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home   | </a></li>
                <li><a href="bookings.php">Book a Table   | </a></li>
                <li><a href="search.php">Search   | </a></li>
                <li><a href="Contacts.php">Reviews  | </a></li>
				<li><a href="view_Bookings.php">View Bookings   | </a></li>
            </ul>
        </nav>
    </header>

    <?php
    // Check if the admin is logged in
    if (!isset($_SESSION['admin_logged_in'])) {
        // Display the login form if not logged in
    ?>
        <div class="login-box">
            <h2>Admin Login</h2>
            <form action="view_bookings.php" method="post">
                <label for="password">Enter Password</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="Login">
                <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
            </form>
        </div>
    <?php
    } else {
        // Display bookings if admin is logged in
        // Include the database connection file
        include 'db.php';

        // Query to select all bookings
        $sql = "SELECT * FROM bookings";
        $result = $conn->query($sql);

        echo "<h1 style='text-align: center; color: #be5d00;'>Table Bookings</h1>";

        if ($result->num_rows > 0) {
            echo "<table>
                    <tr>
                        <th>ID</th>
                        <th>Table Number</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                    </tr>";

            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["Cus_ID"] . "</td>
                        <td>" . $row["Tbl_Number"] . "</td>
                        <td>" . $row["Cus_Name"] . "</td>
                        <td>" . $row["Cus_Contact"] . "</td>
                        <td>" . $row["Date"] . "</td>
                        <td>" . $row["Time"] . "</td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-bookings'>No bookings found.</p>";
        }

        // Close the connection
        $conn->close();
    ?>
        <!-- Logout button -->
        <div class="logout-button">
            <a href="view_bookings.php?action=logout">
                <button>Logout</button>
            </a>
        </div>
    <?php
    }
    ?>

    <section class="menu" id="menu">
        <h2>Our Specialties</h2>
        <div class="menu-items">
            <div class="menu-item">
                <img src="momo.jpg" alt="Momo">
                <h3>Momo</h3>
                <p>Delicious Nepali dumplings.</p>
            </div>
            <div class="menu-item">
                <img src="Dal Bhat.jpg" alt="Dal Bhat">
                <h3>Dal Bhat</h3>
                <p>A traditional Nepali meal of rice and lentils.</p>
            </div>
            <div class="menu-item">
                <img src="choila.jpg" alt="Choila">
                <h3>Choila</h3>
                <p>Spicy grilled meat, a Newari delicacy.</p>
            </div>
        </div>
    </section>
    
    <?php include 'footer.php'; ?>

</body>
</html>
