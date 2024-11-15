<?php
include("../../config/config.php");

$status = isset($_GET['status']) ? $_GET['status'] : 'approved';
$status = ($status === 'pending') ? 'pending' : 'approved';

// Retrieve filter and search parameters
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($myconnect, $_GET['filter']) : '';
$search = isset($_GET['search']) ? mysqli_real_escape_string($myconnect, $_GET['search']) : '';

// Construct the base query
$query = "SELECT uid, username, email, phone, role FROM applicants WHERE application_status = '$status'";

// Apply search criteria if provided
if (!empty($search)) {
    $query .= " AND (username LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR uid LIKE '%$search%')";
}

// Apply filtering criteria if provided
if ($filter !== 'all' && !empty($filter)) {
    $query .= " AND role = '$filter'";
}

// Pagination setup
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$query .= " LIMIT $offset, $limit";
$result = mysqli_query($myconnect, $query);

$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Count total records for pagination
$countQuery = "SELECT COUNT(*) AS total FROM applicants WHERE application_status = '$status'";
if (!empty($search)) {
    $countQuery .= " AND (username LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR uid LIKE '%$search%')";
}
if (!empty($filter)) {
    $countQuery .= " AND role = '$filter'";
}

$countResult = mysqli_query($myconnect, $countQuery);
$totalRecords = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalRecords / $limit);

header('Content-Type: application/json');
echo json_encode([
    "users" => $users,
    "pagination" => [
        "currentPage" => $page,
        "totalPages" => $totalPages
    ]
]);
?>
