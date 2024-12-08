<?php
include '../../config/config.php';
require '/opt/lampp/htdocs/hall/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

function rejectApplicant($uid, $reason = '') {
    global $myconnect;  // Use global to access the database connection

    // Start transaction for data integrity
    mysqli_begin_transaction($myconnect);

    try {
        // Update applicant status to 'rejected'
        $updateQuery = "UPDATE applicants
                        SET application_status = 'rejected',
                            rejected_timestamp = NOW(),
                            rejection_reason = ?
                        WHERE uid = ?";
        $stmt = mysqli_prepare($myconnect, $updateQuery);
        mysqli_stmt_bind_param($stmt, 'si', $reason, $uid);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Failed to update applicant status");
        }

        // Fetch user email and details
        $emailQuery = "SELECT email, first_name, last_name FROM applicants WHERE uid = ?";
        $stmt = mysqli_prepare($myconnect, $emailQuery);
        mysqli_stmt_bind_param($stmt, 'i', $uid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if (!$user) {
            throw new Exception("User not found");
        }

        // Send rejection email
        if (!sendRejectionEmail($user['email'], $user['first_name'], $user['last_name'], $reason)) {
            throw new Exception("Failed to send rejection email");
        }

        // Commit transaction
        mysqli_commit($myconnect);

        return [
            'status' => 'success',
            'message' => 'Applicant rejected successfully'
        ];

    } catch (Exception $e) {
        // Rollback transaction on any error
        mysqli_rollback($myconnect);
        error_log("Rejection Error: " . $e->getMessage());
        return [
            'status' => 'error',
            'message' => $e->getMessage()
        ];
    }
}

function sendRejectionEmail($email, $firstName, $lastName, $reason) {
    $mail = new PHPMailer(true);
    try {
        // SMTP configuration (similar to approval email)
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
        $mail->Subject = 'Hall Reservation Application - Rejected';

        $mail->Body = "
            <h2>Dear {$firstName} {$lastName},</h2>
            <p>We regret to inform you that your hall reservation application has been rejected.</p>

            " . ($reason ? "<p><strong>Reason for Rejection:</strong> " . htmlspecialchars($reason) . "</p>" : "") . "

            <p>Please consider given reason try to apply again.</p>
            <p>If you have any questions or would like to discuss this further,
            please contact the Hall Reservation Office.</p>

            <p>Best regards,<br>Hall Reservation Team</p>
        ";

        return $mail->send();
    } catch (Exception $e) {
        error_log("Rejection Email Error: " . $e->getMessage());
        return false;
    }
}

// AJAX handler in reject_applicant.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $result = rejectApplicant(
        $data['uid'],
        $data['reason'] ?? '' // Optional rejection reason
    );

    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}
?>
