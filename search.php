<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Bookings - PARA Bites</title>
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
                <li><a href="search.php">Search   | </a></li>
                <li><a href="Contacts.php">Reviews  | </a></li>
				<li><a href="view_Bookings.php">View Bookings   | </a></li>
            </ul>
        </nav>
    </header>
	<section class="food1" id="food1">
	<div class=food1-content">
    <section class="search-section">
        <h2>Search Bookings and Contacts</h2>
        <form method="POST" action="search.php">
            <input type="text" name="query" placeholder="Search by name, email, or date" required>
            <button type="submit" class="btn">Search</button>
        </form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST['query'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'parabites');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT * FROM bookings WHERE Cus_Name LIKE ? OR Cus_Contact LIKE ? OR date LIKE ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $search_query = "%$query%";
    $stmt->bind_param("sss", $search_query, $search_query, $search_query);

    // Execute the statement
    if (!$stmt->execute()) {
        die("Execute failed: " . htmlspecialchars($stmt->error));
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h3>Search Results:</h3>";
        echo "<table class='search-results'>
                <tr>
                    <th>Booking ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            // Check if keys exist in the fetched row before using them
            $booking_id = isset($row["Cus_ID"]) ? htmlspecialchars($row["Cus_ID"]) : 'N/A';
            $cus_name = isset($row["Cus_Name"]) ? htmlspecialchars($row["Cus_Name"]) : 'N/A';
            $cus_contact = isset($row["Cus_Contact"]) ? htmlspecialchars($row["Cus_Contact"]) : 'N/A';
            $date = isset($row["Date"]) ? htmlspecialchars($row["Date"]) : 'N/A';
            $time = isset($row["Time"]) ? htmlspecialchars($row["Time"]) : 'N/A';

            echo "<tr>
                    <td>$booking_id</td>
                    <td>$cus_name</td>
                    <td>$cus_contact</td>
                    <td>$date</td>
                    <td>$time</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No results found for '$query'.</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>


        <div class="navigation-links">
            <a href="index.php" class="btn">Back to Home</a>
            <a href="bookings.php" class="btn">Book a Table</a>
        </div>
    </section>
</div>
</section>
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

