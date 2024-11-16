<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        /* Header styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            background: linear-gradient(to right, #4CAF50, #2E7D32);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            color: white;
        }

        .header .menu-item {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header .menu-item i {
            font-size: 20px;
            cursor: pointer;
        }

        .header .profile-menu {
            position: relative;
        }

        .header .dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 60px;
            background: white;
            color: black;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
            z-index: 1001;
        }

        .header .dropdown a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: black;
        }

        .header .dropdown a:hover {
            background-color: #f1f1f1;
        }

        .header .profile-menu:hover .dropdown {
            display: block;
        }

        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 250px;
            height: calc(100vh - 60px);
            background: #333;
            color: white;
            overflow-y: auto;
            padding: 20px;
        }

        .sidebar a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px 15px;
            margin-bottom: 10px;
            background: #444;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #555;
        }

        /* Main content styles */
        .main-content {
            margin-left: 250px;
            margin-top: 60px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <div class="menu-item">
            <div class="notification">
                <i class="bell-icon">🔔</i>
            </div>
        </div>
        <div class="profile-menu">
            <i class="profile-icon">👤</i>
            <div class="dropdown">
                <a href="#settings">Settings</a>
                <a href="#logout">Logout</a>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="#dashboard">Dashboard</a>
        <a href="#users">Users</a>
        <a href="#settings">Settings</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Welcome to the Admin Panel</h1>
        <p>This is the main content area.</p>
    </div>

</body>
</html>
