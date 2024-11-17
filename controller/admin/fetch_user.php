<?php
include("../../config/config.php");

$status = isset($_GET['status']) ? $_GET['status'] : 'approved';
$status = ($status === 'pending') ? 'pending' : 'approved';

// Get sort direction from query parameters
$sortDir = isset($_GET['sortDir']) ? $_GET['sortDir'] : 'DESC';
$sortDir = strtoupper($sortDir) === 'ASC' ? 'ASC' : 'DESC';

$filter = isset($_GET['filter']) ? mysqli_real_escape_string($myconnect, $_GET['filter']) : '';
$search = isset($_GET['search']) ? mysqli_real_escape_string($myconnect, $_GET['search']) : '';

// Select appropriate timestamp based on status
$timestampField = ($status === 'pending') ? 'applied_timestamp' : 'approved_timestamp';

// Modify the main query to include timestamp and sorting
$query = "SELECT uid, username, email, phone, role, $timestampField FROM applicants
          WHERE application_status = '$status'";

if (!empty($search)) {
    $query .= " AND (username LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR uid LIKE '%$search%')";
}

if ($filter !== 'all' && !empty($filter)) {
    $query .= " AND role = '$filter'";
}

// Add timestamp sorting
$query .= " ORDER BY $timestampField $sortDir";

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// First get total filtered results
$countQuery = "SELECT COUNT(*) AS total FROM applicants WHERE application_status = '$status'";

if (!empty($search)) {
    $countQuery .= " AND (username LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR uid LIKE '%$search%')";
}

if ($filter !== 'all' && !empty($filter)) {
    $countQuery .= " AND role = '$filter'";
}

$countResult = mysqli_query($myconnect, $countQuery);
$totalRecords = mysqli_fetch_assoc($countResult)['total'];

// Add limit and offset to main query
$query .= " LIMIT $offset, $limit";

$result = mysqli_query($myconnect, $query);
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    // Format timestamp for display
    $timestamp = new DateTime($row[$timestampField]);
    $row['formatted_timestamp'] = $timestamp->format('Y-m-d H:i:s');
    $users[] = $row;
}

$currentResults = count($users);
$totalPages = $totalRecords > 0 ? ceil($totalRecords / $limit) : 1;

header('Content-Type: application/json');
echo json_encode([
    "users" => $users,
    "pagination" => [
        "currentPage" => $page,
        "totalPages" => $totalPages,
        "currentResults" => $currentResults,
        "totalResults" => $totalRecords
    ]
]);
?>
