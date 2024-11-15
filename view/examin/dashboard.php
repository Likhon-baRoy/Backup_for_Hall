<?php
include '../../config/config.php';

// Ensure database config is included
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch the required data
$totalResidents = mysqli_fetch_assoc(mysqli_query($myconnect, "SELECT COUNT(*) AS total FROM c_info"));
$totalStudents = mysqli_fetch_assoc(mysqli_query($myconnect, "SELECT COUNT(*) AS total FROM c_info WHERE role = 'Student'"));
$totalStaff = mysqli_fetch_assoc(mysqli_query($myconnect, "SELECT COUNT(*) AS total FROM c_info WHERE role = 'Staff'"));
$totalAdmin = mysqli_fetch_assoc(mysqli_query($myconnect, "SELECT COUNT(*) AS total FROM c_info WHERE role = 'Administrator'"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Hall Management</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex both">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Dashboard Content -->
        <div class="dashboard container mt-4">
            <h1 class="text-center">Hall Management Dashboard</h1>

            <!-- Flash Cards Section -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-3">
                <!-- Total Hall Residents Card -->
                <div class="col">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <h5 class="card-title">Total Hall Residents</h5>
                            <p class="card-text"><?= $totalResidents['total'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Total Students Card -->
                <div class="col">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <h5 class="card-title">Students</h5>
                            <p class="card-text"><?= $totalStudents['total'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Total Staff Card -->
                <div class="col">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <h5 class="card-title">Staff</h5>
                            <p class="card-text"><?= $totalStaff['total'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Total Admin Card -->
                <div class="col">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-body">
                            <h5 class="card-title">Admin</h5>
                            <p class="card-text"><?= $totalAdmin['total'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // You can add any JavaScript if needed for interactivity or dynamic updates
    </script>
</body>
</html>
