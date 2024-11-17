<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Homepage</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <header class="floating-header admin-header">
        <?php include 'admin_header.php'; ?>
    </header>

    <div class="both">
        <!-- Sidebar -->
        <?php include 'sidebar.php'; ?>

        <!-- Main content with header -->
        <div class="main-content">
            <!-- Dashboard Content -->
            <div class="dashboard">
                <h1 class="text-center my-4">Admin Dashboard</h1>

                <!-- Loading Spinner -->
                <div id="loading-spinner" class="text-center my-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <!-- Dashboard Cards -->
                <div id="stats-cards" class="row d-none">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-warning text-white shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Pending Users</h5>
                                <p id="pending-count" class="card-text text-center display-4">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-success text-white shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Approved Users</h5>
                                <p id="approved-count" class="card-text text-center display-4">0</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-danger text-white shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Rejected Users</h5>
                                <p id="rejected-count" class="card-text text-center display-4">0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Role Chart -->
                <div class="row mt-4">
                    <div class="col-md-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center">Approved Users by Role</h5>
                                <canvas id="roleChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hall Information Section -->
                <div class="row mt-4" id="hall-info">
                    <h3 class="text-center mb-4">Hall Information</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Hall Name</th>
                                <th scope="col">Total Rooms</th>
                                <th scope="col">Total Seats</th>
                                <th scope="col">Available Seats</th>
                            </tr>
                        </thead>
                        <tbody id="hall-info-body">
                            <!-- Dynamic rows will be added here by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Hall Seats Pie Chart -->
                <div class="row mt-4">
                    <div class="col-md-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-center">Available Seats by Hall</h5>
                                <canvas id="hallChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Export Button -->
                <div class="text-end mb-4">
                    <a href="../../controller/admin/generate_report.php" class="btn btn-outline-success btn-lg">
                        <i class="fas fa-file-download"></i> Export Dashboard Data
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="../../assets/js/dashboard.js"></script>
</body>
</html>
