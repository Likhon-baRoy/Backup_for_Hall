<?php
// Include the database configuration file to connect to the database
include("config.php");

// Drop the table if it exists to avoid duplicate errors
// $drop_table = "DROP TABLE IF EXISTS applicants";
// mysqli_query($myconnect, $drop_table);

// Create the applicants table
$tbl_applicants = "CREATE TABLE IF NOT EXISTS applicants (
    uid INT(11) NOT NULL UNIQUE,             -- Unique user ID provided during signup
    username VARCHAR(30) NOT NULL UNIQUE,    -- Unique username
    first_name VARCHAR(30) NOT NULL,         -- First name of the user
    last_name VARCHAR(30) NOT NULL,          -- Last name of the user
    birthdate DATE,                          -- Birthdate
    gender ENUM('male', 'female', 'other'),  -- Gender
    email VARCHAR(50) NOT NULL,              -- Email address for notifications
    phone VARCHAR(15) NOT NULL,              -- Phone number
    hometown VARCHAR(30),                    -- Hometown
    preferred_hall VARCHAR(50),              -- Preferred hall name
    room_type VARCHAR(15),                   -- Room type preference
    move_in_date DATE,                       -- Move-in date
    password VARCHAR(255) NOT NULL,          -- Encrypted password
    role ENUM('student', 'teacher', 'staff', 'instructor', 'admin') NOT NULL, -- User role
    department ENUM('CSE', 'EEE', 'CE', 'ME', 'BBA', 'LLB', 'TEX', 'Pharmacy', 'English', 'Other') DEFAULT NULL, -- Department for students/teachers
    application_status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending', -- Application status
    room VARCHAR(15) DEFAULT NULL,           -- Room number assigned upon approval
    hall VARCHAR(50) DEFAULT NULL,           -- Hall name assigned upon approval
    seat VARCHAR(15) DEFAULT NULL,           -- Seat number assigned upon approval
    PRIMARY KEY (uid)
)";

// Execute the query to create the applicants table
if (mysqli_query($myconnect, $tbl_applicants)) {
    echo "<p>Applicants table created successfully</p>";
} else {
    echo "<p>Error creating applicants table: " . mysqli_error($myconnect) . "</p>";
}

// Close the database connection
mysqli_close($myconnect);
?>
