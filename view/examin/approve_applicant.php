<?php
include '../../config/config.php'; // Include database connection
include 'PHPMailer.php'; // Include PHPMailer

$data = json_decode(file_get_contents("php://input"), true);
$uid = $data['uid'];
$room = $data['room'];
$hall = $data['hall'];
$seat = $data['seat'];

// Update application status and room assignment
$query = "UPDATE applicants SET application_status = 'approved', room = ?, hall = ?, seat = ? WHERE uid = ?";
$stmt = $myconnect->prepare($query);
$stmt->bind_param("sssi", $room, $hall, $seat, $uid);

if ($stmt->execute()) {
    // Send approval email to applicant
    $user = $stmt->get_result()->fetch_assoc();
    sendApprovalEmail($user['email'], $room, $hall, $seat);
    echo json_encode(["message" => "Applicant approved successfully."]);
} else {
    echo json_encode(["message" => "Error approving applicant: " . $myconnect->error]);
}
