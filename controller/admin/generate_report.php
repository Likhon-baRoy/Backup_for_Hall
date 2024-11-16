<?php
include("../../config/config.php");

// Set headers for CSV download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=dashboard_report.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Add column headers
fputcsv($output, ['Metric', 'Value']);

// Fetch total approved and pending users
$query = "
    SELECT
        COUNT(CASE WHEN application_status = 'approved' THEN 1 END) AS approved_count,
        COUNT(CASE WHEN application_status = 'pending' THEN 1 END) AS pending_count
    FROM applicants";
$result = mysqli_query($myconnect, $query);
$row = mysqli_fetch_assoc($result);

fputcsv($output, ['Total Approved Users', $row['approved_count']]);
fputcsv($output, ['Total Pending Users', $row['pending_count']]);

// Fetch count by roles for approved users
$roleQuery = "
    SELECT role, COUNT(*) AS role_count
    FROM applicants
    WHERE application_status = 'approved'
    GROUP BY role";
$roleResult = mysqli_query($myconnect, $roleQuery);

while ($roleRow = mysqli_fetch_assoc($roleResult)) {
    fputcsv($output, ['Approved ' . ucfirst($roleRow['role']), $roleRow['role_count']]);
}

// Close output stream
fclose($output);
exit;
?>
