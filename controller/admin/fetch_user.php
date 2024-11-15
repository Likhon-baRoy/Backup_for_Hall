<?php
include("../../config/config.php");

// Get the status (approved or pending) from the query parameter, default to 'approved'
$status = isset($_GET['status']) ? $_GET['status'] : 'approved';
$status = ($status === 'pending') ? 'pending' : 'approved';

// Retrieve filter (role) and search query from query parameters, sanitize the inputs
$filter = isset($_GET['filter']) ? mysqli_real_escape_string($myconnect, $_GET['filter']) : '';
$search = isset($_GET['search']) ? mysqli_real_escape_string($myconnect, $_GET['search']) : '';

// Start constructing the main query to fetch user data
$query = "SELECT uid, username, email, phone, role FROM applicants WHERE application_status = '$status'";

// Apply search conditions if a search term is provided
if (!empty($search)) {
    $query .= " AND (username LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR uid LIKE '%$search%')";
}

// Apply filtering by role only if the filter is not 'all' and is not empty
if ($filter !== 'all' && !empty($filter)) {
    $query .= " AND role = '$filter'";
}

// Add pagination settings
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Get current page, default to 1
$limit = 3; // Number of results per page
$offset = ($page - 1) * $limit; // Calculate the offset for the query

$query .= " LIMIT $offset, $limit"; // Add pagination limits to the query

// Execute the main query and fetch the results
$result = mysqli_query($myconnect, $query);
$users = [];
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row; // Add each user to the array
}

// Construct the count query to calculate the total number of records for pagination
$countQuery = "SELECT COUNT(*) AS total FROM applicants WHERE application_status = '$status'";

// Apply search conditions to the count query if a search term is provided
if (!empty($search)) {
    $countQuery .= " AND (username LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%' OR uid LIKE '%$search%')";
}

// Apply role-based filtering to the count query if the filter is not 'all' and not empty
if ($filter !== 'all' && !empty($filter)) {
    $countQuery .= " AND role = '$filter'";
}

// Execute the count query and calculate the total pages
$countResult = mysqli_query($myconnect, $countQuery);
$totalRecords = mysqli_fetch_assoc($countResult)['total']; // Get the total number of matching records
$totalPages = $totalRecords > 0 ? ceil($totalRecords / $limit) : 1; // Calculate total pages, ensure at least 1 page

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode([
    "users" => $users, // User data for the current page
    "pagination" => [
        "currentPage" => $page, // Current page number
        "totalPages" => $totalPages // Total number of pages
    ]
]);
?>
