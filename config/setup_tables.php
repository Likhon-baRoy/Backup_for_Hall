<?php
// Include the database configuration file
include("config.php");

// Include individual table scripts
include("applicants.php");
include("university_info.php");
include("hall_rooms.php");

// Close the database connection
mysqli_close($myconnect);

echo "<p>All tables set up successfully!</p>";
?>
