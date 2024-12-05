<?php
include("config.php");

// Cleanup query to remove expired or used tokens
$cleanupQuery = "DELETE FROM approval_tokens
                 WHERE token_expiry < NOW() OR is_used = 1";

if (mysqli_query($myconnect, $cleanupQuery)) {
    echo "Expired tokens cleaned up successfully.";
    error_log("Tokens cleanup performed at " . date('Y-m-d H:i:s'));
} else {
    error_log("Token cleanup failed: " . mysqli_error($myconnect));
}

mysqli_close($myconnect);
?>
