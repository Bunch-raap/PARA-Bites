<?php
// Include the database connection file
include 'db.php';

// Initialize variables to store form data for the summary
$Tbl_Number = $Cus_Name = $Cus_Contact = $date = $time = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $Tbl_Number = $_POST['guests'];
    $Cus_Name = $_POST['name'];
    $Cus_Contact = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Insert booking into the database
    $sql = "INSERT INTO bookings (Tbl_Number, Cus_Name, Cus_Contact, date, time)
            VALUES ('$Tbl_Number', '$Cus_Name', '$Cus_Contact', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        // Booking inserted successfully
        $bookingSuccess = true;
    } else {
        // Booking failed
        $bookingSuccess = false;
        $errorMsg = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Table</title>
    <link rel="stylesheet" href="styles.css"> <!-- Your existing CSS file -->
    <style>
        /* Add styling for the summary box */
        .summary-box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            background-color: #f9f9f9;
            max-width: 500px;
            margin: 0 auto;
        }
        .summary-box h3 {
            margin-bottom: 15px;
            color: #be5d00;
        }
        .summary-box p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
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

    <!-- Reservation Form Section -->
	<section class="table1" id="table1">
	<div class=table1-content">
    <section class="booking-section">
        <div class="booking-form">
            <h2>Book a Table</h2>
            <form action="#" method="post">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="date">Reservation Date</label>
                <input type="date" id="date" name="date" required>

                <label for="time">Reservation Time</label>
                <input type="time" id="time" name="time" required>

                <label for="guests">Number of Guests</label>
                <input type="number" id="guests" name="guests" placeholder="Enter number of guests" min="1" required>

                <input type="submit" value="Book Now">
            </form>
        </div>

        <!-- Booking Summary Section (Only shown after form submission) -->
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($bookingSuccess) && $bookingSuccess): ?>
        <div class="summary-box">
            <h3>Booking Summary</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($Cus_Name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($Cus_Contact); ?></p>
            <p><strong>Reservation Date:</strong> <?php echo htmlspecialchars($date); ?></p>
            <p><strong>Reservation Time:</strong> <?php echo htmlspecialchars($time); ?></p>
            <p><strong>Number of Guests:</strong> <?php echo htmlspecialchars($Tbl_Number); ?></p>
        </div>
        <?php elseif (isset($bookingSuccess) && !$bookingSuccess): ?>
        <div class="summary-box">
            <h3>Booking Failed</h3>
            <p><?php echo htmlspecialchars($errorMsg); ?></p>
        </div>
        <?php endif; ?>
	</div>
		
		
	</section>
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
