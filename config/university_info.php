<?php
// Include the database configuration file
include("config.php");

// Drop the table if it exists
// $drop_table = "DROP TABLE IF EXISTS university_info";
// mysqli_query($myconnect, $drop_table);

// Create the university_info table
$tbl_university_info = "CREATE TABLE IF NOT EXISTS university_info (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Primary key
    type ENUM('hall', 'department', 'library', 'building') NOT NULL, -- Type of entity
    name VARCHAR(50) NOT NULL,                 -- Name of the entity
    description TEXT,                           -- Description of the entity
    location VARCHAR(50),                      -- Physical location
    status ENUM('active', 'inactive', 'maintenance') DEFAULT 'active', -- Status
    added_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp of creation
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP -- Timestamp of the last update
)";

// Execute the query
if (mysqli_query($myconnect, $tbl_university_info)) {
    echo "<p>University Info table created successfully</p>";
} else {
    echo "<p>Error creating university info table: " . mysqli_error($myconnect) . "</p>";
}

// Close the database connection
mysqli_close($myconnect);
?>
