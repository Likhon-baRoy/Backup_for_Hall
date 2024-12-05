<?php
$message = htmlspecialchars($_GET['message'] ?? "An error occurred. Please try again.");
?>
<!DOCTYPE html>
<html>
<head><title>Error</title></head>
<body>
    <h1>Error</h1>
    <p><?php echo $message; ?></p>
    <a href="/contact_support.php">Contact Support</a>
</body>
</html>
