<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];

    // Server-side validation
    if (empty($name) || empty($email) || empty($message) || empty($rating)) {
        echo "All fields are required!";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Validate rating (should be between 1 and 5)
    if ($rating < 1 || $rating > 5) {
        echo "Rating must be between 1 and 5!";
        exit;
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'parabites');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, message) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ssis", $name, $email, $rating, $message);

    if ($stmt->execute()) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PARA Bites</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .feedback-form {
            margin: 20px;
        }
        .feedback-list {
            margin: 20px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .feedback-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .rating {
            color: #ffcc00;
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
                <li><a href="view_Bookings.php">View Bookings   | </a></li>
                <li><a href="search.php">Search   | </a></li>
                <li><a href="Contacts.php">Contact Us   | </a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h2>Contact Us and Leave a Feedback</h2>
        <form action="Contacts.php" method="POST" class="feedback-form">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="rating">Rating:</label>
            <select id="rating" name="rating" required>
                <option value="1">1 Star</option>
                <option value="2">2 Stars</option>
                <option value="3">3 Stars</option>
                <option value="4">4 Stars</option>
                <option value="5">5 Stars</option>
            </select><br><br>

            <label for="message">Feedback:</label><br>
            <textarea id="message" name="message" rows="5" required></textarea><br><br>

            <input type="submit" value="Submit Feedback">
        </form>
    </section>

    <section class="feedback-list">
        <h2>Customer Feedback</h2>
        <?php
        // Retrieve and display feedback from the database
        $conn = new mysqli('localhost', 'root', '', 'parabites');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $result = $conn->query("SELECT name, email, rating, message, created_at FROM feedback ORDER BY created_at DESC");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='feedback-item'>";
                echo "<p><strong>" . htmlspecialchars($row['name']) . " (" . htmlspecialchars($row['email']) . ")</strong></p>";
                echo "<p class='rating'>" . str_repeat("★", $row['rating']) . str_repeat("☆", 5 - $row['rating']) . "</p>";
                echo "<p>" . nl2br(htmlspecialchars($row['message'])) . "</p>";
                echo "<small>Posted on " . htmlspecialchars($row['created_at']) . "</small>";
                echo "</div>";
            }
        } else {
            echo "<p>No feedback available yet. Be the first to leave your review!</p>";
        }

        $conn->close();
        ?>
    </section>
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
