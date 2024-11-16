<?php
include("../../config/config.php");

$response = [
    'approved_count' => 0,
    'pending_count' => 0,
    'roles' => [],
    'halls' => [],
    'error' => ''
];

try {
    $query = "
        SELECT
            SUM(CASE WHEN application_status = 'approved' THEN 1 ELSE 0 END) AS approved_count,
            SUM(CASE WHEN application_status = 'pending' THEN 1 ELSE 0 END) AS pending_count
        FROM applicants";
    $result = mysqli_query($myconnect, $query);
    $row = mysqli_fetch_assoc($result);

    $response['approved_count'] = $row['approved_count'] ?? 0;
    $response['pending_count'] = $row['pending_count'] ?? 0;

    $roleQuery = "
        SELECT role, COUNT(*) AS count
        FROM applicants
        WHERE application_status = 'approved'
        GROUP BY role";
    $roleResult = mysqli_query($myconnect, $roleQuery);

    while ($roleRow = mysqli_fetch_assoc($roleResult)) {
        $response['roles'][] = [
            'role' => $roleRow['role'],
            'count' => $roleRow['count']
        ];
    }

    $hallQuery = "
        SELECT
            ui.name AS hall_name,
            COUNT(hr.id) AS total_rooms,
            SUM(hr.total_seats) AS total_seats,
            SUM(hr.total_seats - hr.occupied_seats) AS available_seats
        FROM hall_rooms hr
        JOIN university_info ui ON hr.hall_id = ui.id
        GROUP BY hr.hall_id";
    $hallResult = mysqli_query($myconnect, $hallQuery);

    while ($hallRow = mysqli_fetch_assoc($hallResult)) {
    $response['halls'][] = [
        'hall_name' => $hallRow['hall_name'],
        'total_rooms' => $hallRow['total_rooms'],
        'total_seats' => $hallRow['total_seats'],
        'available_seats' => $hallRow['available_seats']
    ];
}

// Debug output to ensure the halls data is being populated
error_log(print_r($response['halls'], true));  // This will log the halls array to the PHP error log

} catch (Exception $e) {
    $response['error'] = $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
