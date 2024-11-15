<?php
include '../../config/config.php'; // Include database connection

$data = json_decode(file_get_contents("php://input"), true);
$uid = $data['uid'];

// Update application status to rejected
$query = "UPDATE applicants SET application_status = 'rejected' WHERE uid = ?";
$stmt = $myconnect->prepare($query);
$stmt->bind_param("i", $uid);

if ($stmt->execute()) {
    // Send rejection email to applicant
    $user = $stmt->get_result()->fetch_assoc();
    sendRejectionEmail($user['email']);
    echo json_encode(["message" => "Applicant rejected successfully."]);
} else {
    echo json_encode(["message" => "Error rejecting applicant: " . $myconnect->error]);
}
?>
