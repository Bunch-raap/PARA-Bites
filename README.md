# PARA-Bites
Nepali Cuisine
<?php
      $cars = array("Volvo", "BMW", "Toyota");
?>


<!DOCTYPE html>
<html>
<head>
<title>Para Bites</title>
<link rel="stylesheet" href="mystyles.css">
</head>
<body>
<h4 style="text-align:center;color:blue;">Home</h4>
Home |
<a href="contact.php">Contact</a> |
<a href="about.php">About</a>
<hr>

<ul>   
    <?php
	    foreach ($cars as $car) {
           print ("\n\t<li>$car</li>");
		}
    ?> 
</ul>


</body>
</html>


<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" href="mystyles.css">
</head>
<body>
<h4 style="text-align:center;color:blue;">Contact</h4>
<a href="index.php">Home</a> |
Contact |
<a href="about.php">About</a>
<hr>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" href="mystyles.css">
</head>
<body>
<h4 style="text-align:center;color:blue;">About</h4>
<a href="index.php">Home</a> |
<a href="contact.php">Contact</a> |
About
<hr>
</body>
</html>
