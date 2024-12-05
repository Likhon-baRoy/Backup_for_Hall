<?php
// Include the database configuration file to connect to the database
include("config.php");

// Create a new table for approval tokens
$tbl_approval_tokens = "CREATE TABLE IF NOT EXISTS approval_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique token ID
    uid INT NOT NULL,                   -- Foreign key to applicants' UID
    token VARCHAR(255) NOT NULL UNIQUE, -- Unique approval token
    token_expiry DATETIME NOT NULL,     -- Token expiry time
    is_used TINYINT(1) DEFAULT 0,       -- Whether the token has been used
    room VARCHAR(15),           		-- Store proposed room
    hall VARCHAR(50),           		-- Store proposed hall
    seat VARCHAR(15),           		-- Store proposed seat
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp of token creation
    FOREIGN KEY (uid) REFERENCES applicants(uid) ON DELETE CASCADE
)";

// Execute the query to create the approval_tokens table
if (mysqli_query($myconnect, $tbl_approval_tokens)) {
    echo "<p>Approval tokens table created successfully</p>";
} else {
    echo "<p>Error creating approval tokens table: " . mysqli_error($myconnect) . "</p>";
}

// Close the database connection
mysqli_close($myconnect);
?>
