<?php
include 'PHPMailer.php';

function sendApprovalEmail($email, $room, $hall, $seat) {
    $mail = new PHPMailer();
    $mail->addAddress($email);
    $mail->Subject = "Hall Seat Approval Notification";
    $mail->Body = "Congratulations! You have been approved for a hall seat assignment.
                    Your assigned room is: $room, in $hall hall, seat number: $seat.
                    Please confirm within 3 days to finalize your spot.";
    $mail->send();
}

function sendRejectionEmail($email) {
    $mail = new PHPMailer();
    $mail->addAddress($email);
    $mail->Subject = "Hall Seat Application Status";
    $mail->Body = "We regret to inform you that your application for a hall seat has been rejected. Thank you for your understanding.";
    $mail->send();
}
?>
