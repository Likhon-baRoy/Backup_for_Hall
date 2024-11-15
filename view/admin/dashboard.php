<?php
include '../../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="d-flex both">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Dashboard Content -->
        <div class="dashboard container">
            <h1 class="text-center">Admin Dashboard</h1>
            <div class="row" id="dashboard-metrics">
                <!-- Metrics Flash Cards -->
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text" id="total-users">0</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Pending Users</h5>
                            <p class="card-text" id="pending-users">0</p>
                        </div>
                    </div>
                </div>
                <!-- Add more cards for Students, Teachers, etc. -->
            </div>
        </div>
    </div>

    <script src="../../assets/js/dashboard.js"></script>
</body>
</html>
