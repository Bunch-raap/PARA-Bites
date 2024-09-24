
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nepali Restaurant - PARA Bites</title>
    <link rel="stylesheet" href="styles.css">
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
				<li><a href="view_Bookings.php">View Bookings   | </a></li>
				<li><a href="search.php">Search   | </a></li>
                <li><a href="Contacts.php">Contact Us   | </a></li>
            </ul>
        </nav>
    </header>
	<?php
// Include the database connection file
include 'db.php';

// Query to select all bookings
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    echo "<h1>Table Bookings</h1>";
    echo "<table border='1'>
            <tr>
                <th></th>
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
    echo "No bookings found.";
}

// Close the connection
$conn->close();
?>
    <footer id="contact">
        <div class="footer-container">
            <div class="socials">
                <h3>Follow Us</h3>
                <a href="#"><img src="facebook.png" alt="Facebook"></a>
                <a href="#"><img src="instagram.png" alt="Instagram"></a>
                <a href="#"><img src="twitter.png" alt="Twitter"></a>
            </div>
            <div class="address">
                <h3>Contact Us</h3>
                <p>123 Nepali Street, Sydney, Australia</p>
                <p>Email: info@parabites.com</p>
                <p>Phone: +61 123 456 789</p>
            </div>
        </div>
    </footer>
</body>
</html>
