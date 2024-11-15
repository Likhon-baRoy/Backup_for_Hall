<?php
include '../../config/config.php';

// Initialize counts
$result = [
    "totalUsers" => 0,
    "pendingUsers" => 0,
    "students" => 0,
    "teachers" => 0,
    "staff" => 0,
    "admins" => 0,
];

// Query to count approved users grouped by role
$query = "SELECT application_status, role, COUNT(*) AS count FROM applicants WHERE application_status = 'approved' GROUP BY role";
$data = mysqli_query($myconnect, $query);

while ($row = mysqli_fetch_assoc($data)) {
    if ($row['application_status'] === 'approved') {
        $result['totalUsers'] += $row['count'];
    }

    switch ($row['role']) {
        case 'student':
            $result['students'] = $row['count'];
            break;
        case 'teacher':
            $result['teachers'] = $row['count'];
            break;
        case 'staff':
            $result['staff'] = $row['count'];
            break;
        case 'admin':
            $result['admins'] = $row['count'];
            break;
    }
}

// Query to count pending users
$pendingQuery = "SELECT COUNT(*) AS pendingCount FROM applicants WHERE application_status = 'pending'";
$pendingData = mysqli_query($myconnect, $pendingQuery);
if ($pendingRow = mysqli_fetch_assoc($pendingData)) {
    $result['pendingUsers'] = $pendingRow['pendingCount'];
}

header('Content-Type: application/json');
echo json_encode($result);
?>
