<?php
include '../../config/config.php';
require '/opt/lampp/htdocs/hall/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

function generateApprovalToken($uid, $room, $hall, $seat, $myconnect) {
    try {
        // Generate a cryptographically secure token
        $token = bin2hex(random_bytes(32));
        $token_expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));

        // Insert token into approval_tokens table with room, hall, seat details
        $query = "INSERT INTO approval_tokens
                  (uid, token, token_expiry, room, hall, seat)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $myconnect->prepare($query);
        $stmt->bind_param("isssss", $uid, $token, $token_expiry, $room, $hall, $seat);

        if ($stmt->execute()) {
            return $token;
        } else {
            error_log("Failed to insert token for UID: $uid. Error: " . $stmt->error);
            return false;
        }
    } catch (Exception $e) {
        error_log("Token generation error: " . $e->getMessage());
        return false;
    }
}

function sendApprovalEmail($email, $room, $hall, $seat, $approvalLink) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USERNAME'];
        $mail->Password   = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $_ENV['SMTP_PORT'];

        $mail->setFrom($_ENV['SMTP_FROM_EMAIL'], 'Hall Reservation Admin');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Hall Reservation Pending Confirmation';
        $mail->Body = "
            <h2>Hall Reservation Pending Confirmation</h2>
            <p>Your hall reservation is pending your confirmation:</p>
            <p>Proposed Room Details:</p>
            <ul>
                <li>Hall: {$hall}</li>
                <li>Room: {$room}</li>
                <li>Seat: {$seat}</li>
            </ul>
            <p>Click the link below to confirm your reservation:</p>
            <a href='{$approvalLink}'>Confirm Reservation</a>
            <p><strong>Note:</strong> This link will expire in 24 hours.</p>
        ";

        return $mail->send();
    } catch (Exception $e) {
        error_log("Email send error: " . $mail->ErrorInfo);
        return false;
    }
}

function requestApproval($uid, $room, $hall, $seat, $myconnect) {
    // Start transaction for data integrity
    $myconnect->begin_transaction();

    try {
        // DO NOT update applicants table to 'approved' status yet
        // Instead, just update it to show it's in a 'pending confirmation' state
        $updateQuery = "UPDATE applicants
                        SET application_status = 'pending_confirmation',
                            room = ?,
                            hall = ?,
                            seat = ?
                        WHERE uid = ?";
        $stmt = $myconnect->prepare($updateQuery);
        $stmt->bind_param("sssi", $room, $hall, $seat, $uid);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update applicant status: " . $stmt->error);
        }

        // Fetch user email
        $emailQuery = "SELECT email FROM applicants WHERE uid = ?";
        $stmt = $myconnect->prepare($emailQuery);
        $stmt->bind_param("i", $uid);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (!$user) {
            throw new Exception("User not found");
        }

        // Generate approval token
        $token = generateApprovalToken($uid, $room, $hall, $seat, $myconnect);
        if (!$token) {
            throw new Exception("Failed to generate approval token");
        }

        // Construct approval link
        $approvalLink = "http://localhost/hall/controller/auth/confirm_user.php?token=" . urlencode($token);

        // Send approval email
        if (!sendApprovalEmail($user['email'], $room, $hall, $seat, $approvalLink)) {
            throw new Exception("Failed to send approval email");
        }

        // Commit transaction
        $myconnect->commit();

        return [
            'status' => 'success',
            'message' => 'Approval request sent. User needs to confirm.'
        ];

    } catch (Exception $e) {
        // Rollback transaction on any error
        $myconnect->rollback();
        error_log("Approval Request Error: " . $e->getMessage());
        return [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
}

// AJAX handler
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = requestApproval(
        $data['uid'],
        $data['room'],
        $data['hall'],
        $data['seat'],
        $myconnect
    );

    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}
?>
