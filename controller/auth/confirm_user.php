<?php
include '../../config/config.php';

// Sanitize token from the URL
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);

if (!$token) {
    logErrorAndRedirect("Invalid or missing token.");
}

// Check if the token exists, is valid, and has not expired
// Now also fetch room, hall, seat details from the token
$query = "SELECT uid, room, hall, seat FROM approval_tokens
          WHERE token = ? AND is_used = 0 AND token_expiry > NOW()";
$stmt = $myconnect->prepare($query);
$stmt->bind_param('s', $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Token is valid
    $tokenData = $result->fetch_assoc();

    // Begin a transaction for atomicity
    $myconnect->begin_transaction();
    try {
        // Update applicants table to 'approved' status
        // Use the room, hall, seat from the token
        $updateApplicant = "UPDATE applicants
                            SET application_status = 'approved',
                                approved_timestamp = NOW(),
                                room = ?,
                                hall = ?,
                                seat = ?
                            WHERE uid = ?";
        $stmt = $myconnect->prepare($updateApplicant);
        $stmt->bind_param('sssi',
            $tokenData['room'],
            $tokenData['hall'],
            $tokenData['seat'],
            $tokenData['uid']
        );
        $stmt->execute();

        // Mark token as used
        $updateToken = "UPDATE approval_tokens SET is_used = 1 WHERE token = ?";
        $stmt = $myconnect->prepare($updateToken);
        $stmt->bind_param('s', $token);
        $stmt->execute();

        // Commit the transaction
        $myconnect->commit();

        // Redirect to success page
        header("Location: approval_success.php");
        exit;
    } catch (Exception $e) {
        // Rollback on failure
        $myconnect->rollback();
        logErrorAndRedirect("An error occurred while confirming your approval. Please try again later.");
    }
} else {
    logErrorAndRedirect("Invalid or expired token.");
}

$stmt->close();
$myconnect->close();

/**
 * Logs an error and redirects to an error page
 *
 * @param string $message The error message to display/log
 */
function logErrorAndRedirect($message) {
    error_log($message);
    header("Location: error_page.php?message=" . urlencode($message));
    exit;
}
?>
