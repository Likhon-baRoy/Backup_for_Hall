<?php
include '../../config/config.php';

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize status variable here
$status = isset($_GET['status']) ? $_GET['status'] : 'approved';
$status = ($status === 'pending') ? 'pending' : 'approved';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Homepage</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <header class="floating-header admin-header">
        <?php include 'admin_header.php'; ?>
    </header>

    <!-- Sidebar -->
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <!-- Filter Selection and Search Bar -->
        <?php include 'search_filter_form.php'; ?>

        <!-- Loading Spinner -->
        <div id="loading-spinner" style="display:none;">
            <img src="../../assets/img/spinner.gif" alt="Loading..." />
        </div>

        <!-- Load User Table -->
        <?php include 'user_table.php'; ?>
        </div>
    </div>

    <!-- Pass status to JavaScript -->
    <script>
        const currentStatus = '<?php echo $status; ?>';
    </script>

    <!-- JavaScript to load data dynamically with AJAX -->
    <script src="../../assets/js/admin.js"></script>
</body>
</html>
