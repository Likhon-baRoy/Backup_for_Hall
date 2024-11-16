<?php
// Include the database configuration file
include("config.php");

// Drop the table if it exists
// $drop_table = "DROP TABLE IF EXISTS hall_rooms";
// mysqli_query($myconnect, $drop_table);

// Create the hall_rooms table
$tbl_hall_rooms = "CREATE TABLE IF NOT EXISTS hall_rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Primary key
    hall_id INT(11) NOT NULL,                   -- Foreign key to university_info table
    room_number VARCHAR(10) NOT NULL,           -- Room number
    total_seats INT(11) NOT NULL,               -- Total number of seats
    occupied_seats INT(11) DEFAULT 0,           -- Number of occupied seats
    status ENUM('available', 'full', 'maintenance') DEFAULT 'available', -- Room status
    FOREIGN KEY (hall_id) REFERENCES university_info(id) ON DELETE CASCADE, -- Foreign key constraint
    UNIQUE(hall_id, room_number)                -- Ensures unique room numbers per hall
)";

// Execute the query
if (mysqli_query($myconnect, $tbl_hall_rooms)) {
    echo "<p>Hall Rooms table created successfully</p>";
} else {
    echo "<p>Error creating hall rooms table: " . mysqli_error($myconnect) . "</p>";
}

// Close the database connection
mysqli_close($myconnect);
?>
