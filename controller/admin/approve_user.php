<?php
include("../../config/config.php");

if (isset($_POST['uid'])) {
    $uid = mysqli_real_escape_string($myconnect, $_POST['uid']);

    // Update user status and automatically set approved_timestamp
    $query = "UPDATE applicants
              SET application_status = 'approved',
                  approved_timestamp = CURRENT_TIMESTAMP
              WHERE uid = '$uid'";

    if (mysqli_query($myconnect, $query)) {
        echo json_encode(['success' => true, 'message' => 'User approved successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error approving user: ' . mysqli_error($myconnect)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No user ID provided']);
}
?>
