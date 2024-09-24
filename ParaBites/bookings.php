<?php
// Include the database connection file
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
    // Get form data
    $Tbl_Number = $_POST['table'];
    $Cus_Name = $_POST['name'];
    $Cus_Contact = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Insert booking into database
    $sql = "INSERT INTO bookings (Tbl_Number, Cus_Name, Cus_Contact, date, time)
            VALUES ('$Tbl_Number', '$Cus_Name', '$Cus_Contact', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Table booked successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Nepali Restaurant - PARA Bites</title>
    <link rel="stylesheet" href="styles.css">
    <title>Book a Table</title>
    <style>
        /* Restaurant Layout */
        .restaurant-layout {
            display: grid;
            grid-template-columns: repeat(5, 1fr); /* 5 columns for balanced layout */
            gap: 30px; /* Space between tables */
            justify-items: center;
            margin: 20px 0;
            position: relative;
        }

        /* Windows */
        .window {
            position: absolute;
            width: 100px;
            height: 30px;
            background-color: lightblue;
            border: 2px solid #444;
        }

        .window-left {
            left: 10px;
            top: 50px;
        }

        .window-right {
            right: 10px;
            top: 50px;
        }

        /* Entrance/Exit */
        .door {
            position: absolute;
            bottom: 0;
            width: 80px;
            height: 100px;
            background-color: brown;
            border: 2px solid #444;
        }

        .door-label {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            color: white;
        }

        /* Table Styles */
        .table {
            position: relative;
            background-color: #e0b97b;
            border: 2px solid #444;
            border-radius: 10px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .table.small {
            width: 80px;
            height: 80px;
        }

        .table.medium {
            width: 120px;
            height: 120px;
        }

        .table.large {
            width: 160px;
            height: 160px;
        }

        .table.selected {
            border-color: green;
            background-color: #c4dcb9;
        }

        .table .chair {
            position: absolute;
            width: 30px;
            height: 30px;
            background-color: #444;
            border-radius: 50%;
        }

        .chair-top {
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .chair-bottom {
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .chair-left {
            left: -20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .chair-right {
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
        }

        .chair-top-left {
            top: -20px;
            left: -20px;
        }

        .chair-top-right {
            top: -20px;
            right: -20px;
        }

        .chair-bottom-left {
            bottom: -20px;
            left: -20px;
        }

        .chair-bottom-right {
            bottom: -20px;
            right: -20px;
        }

        .table-number {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: bold;
        }

        /* Family Room Styling */
        .family-room {
            border: 3px solid #444;
            padding: 20px;
            position: relative;
            grid-column: span 2; /* Occupies two grid columns */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .family-room-title {
            position: absolute;
            top: 0;
            background-color: #444;
            color: white;
            padding: 5px;
        }
		

    </style>
</head>
<body>
    <header>
	    <div class="logo">
            <img src="logo.jpg" alt="PARA Bites Logo">
        </div>
        <h1 style="font-size: 4em; margin: 0; color: #ffffff; margin-left: 10px;">Book a Table</h1>
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

    <section>
        <h2>Select Your Table</h2>

        <div class="restaurant-layout">
            <!-- Windows -->
            <div class="window window-left"></div>
            <div class="window window-right"></div>

            <!-- Row 1: Small 2-chair Tables -->
            <div class="table small" id="table1" onclick="selectTable(1)">
                <div class="chair chair-top"></div>
                <div class="chair chair-bottom"></div>
                <div class="table-number">1</div>
            </div>

            <div class="table small" id="table2" onclick="selectTable(2)">
                <div class="chair chair-top"></div>
                <div class="chair chair-bottom"></div>
                <div class="table-number">2</div>
            </div>

            <div class="table small" id="table3" onclick="selectTable(3)">
                <div class="chair chair-top"></div>
                <div class="chair chair-bottom"></div>
                <div class="table-number">3</div>
            </div>

            <div class="table small" id="table4" onclick="selectTable(4)">
                <div class="chair chair-top"></div>
                <div class="chair chair-bottom"></div>
                <div class="table-number">4</div>
            </div>

            <!-- Row 2: Medium 4-chair Tables -->
            <div class="table medium" id="table9" onclick="selectTable(9)">
                <div class="chair chair-top"></div>
                <div class="chair chair-bottom"></div>
                <div class="chair chair-left"></div>
                <div class="chair chair-right"></div>
                <div class="table-number">9</div>
            </div>

            <div class="table medium" id="table10" onclick="selectTable(10)">
                <div class="chair chair-top"></div>
                <div class="chair chair-bottom"></div>
                <div class="chair chair-left"></div>
                <div class="chair chair-right"></div>
                <div class="table-number">10</div>
            </div>

            <div class="table medium" id="table11" onclick="selectTable(11)">
                <div class="chair chair-top"></div>
                <div class="chair chair-bottom"></div>
                <div class="chair chair-left"></div>
                <div class="chair chair-right"></div>
                <div class="table-number">11</div>
            </div>

            <div class="table medium" id="table12" onclick="selectTable(12)">
                <div class="chair chair-top"></div>
                <div class="chair chair-bottom"></div>
                <div class="chair chair-left"></div>
                <div class="chair chair-right"></div>
                <div class="table-number">12</div>
            </div>

            <!-- Row 3: Family Rooms with 10-chair Tables -->
            <div class="family-room" id="family-room1">
                <div class="family-room-title">Family Room 1</div>
                <div class="table large" id="table5" onclick="selectTable(5)">
                    <div class="chair chair-top"></div>
                    <div class="chair chair-bottom"></div>
                    <div class="chair chair-left"></div>
                    <div class="chair chair-right"></div>
                    <div class="chair chair-top-left"></div>
                    <div class="chair chair-top-right"></div>
                    <div class="chair chair-bottom-left"></div>
                    <div class="chair chair-bottom-right"></div>
                    <div class="table-number">5</div>
                </div>
            </div>

            <div class="family-room" id="family-room2">
                <div class="family-room-title">Family Room 2</div>
                <div class="table large" id="table6" onclick="selectTable(6)">
                    <div class="chair chair-top"></div>
                    <div class="chair chair-bottom"></div>
                    <div class="chair chair-left"></div>
                    <div class="chair chair-right"></div>
                    <div class="chair chair-top-left"></div>
                    <div class="chair chair-top-right"></div>
                    <div class="chair chair-bottom-left"></div>
                    <div class="chair chair-bottom-right"></div>
                    <div class="table-number">6</div>
                </div>
            </div>
        </div>

        <form action="bookings.php" method="post" class="booking-form"> <!-- Change action to submit to the same page -->
            <input type="hidden" id="table" name="table" required> <!-- Change name to 'table' -->

            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="phone">Your Phone:</label> <!-- Change label to 'phone' and name to 'phone' -->
            <input type="text" id="phone" name="phone" required>

            <label for="date">Booking Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="time">Booking Time:</label>
            <input type="time" id="time" name="time" required>

            <p id="selectionMessage"></p>

            <input type="submit" value="Confirm Booking">
        </form>
    </section>

    <!-- Entrance/Exit -->
    <div class="door"></div>
    <div class="door-label">Entrance/Exit</div>

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
    <script>
        function selectTable(tableNumber) {
            // Highlight selected table
            document.querySelectorAll('.table').forEach(function(table) {
                table.classList.remove('selected');
            });
            document.getElementById('table' + tableNumber).classList.add('selected');

            // Set the hidden input value
            document.getElementById('table').value = tableNumber;

            // Update selection message
            document.getElementById('selectionMessage').innerText = 'You have selected Table ' + tableNumber;
        }
    </script>
</body>
</html>
