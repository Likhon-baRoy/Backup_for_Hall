<div class="sidebar">
  <h2>ADMIN</h2>
  <ul class="nav flex-column">
    <li><a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
    <li><a href="user_table.php"><i class="fas fa-users"></i> Approved Users</a></li>
    <li><a href="pending_user_table.php"><i class="fas fa-user-clock"></i> Waitlist Users</a></li>
    <li><a href="../../controller/admin/manage_university_info.php"><i class="fas fa-university"></i> University Info</a></li>
    <li><a href="../../controller/admin/manage_hall_rooms.php"><i class="fas fa-door-open"></i> Manage Halls</a></li>
    <li><a href="#"><i class="fas fa-utensils"></i> Dining</a></li>
    <li><a href="#"><i class="fas fa-exclamation-triangle"></i> Facilities Problem</a></li>
    <li><a href="#"><i class="fas fa-envelope"></i> Messages</a></li>
    <li><a href="../../controller/auth/logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
  </ul>
</div>
<style>
.sidebar {
    width: 250px;
    background: linear-gradient(to bottom, #006064, #26c6da);
    padding-top: 70px;         /* Accounts for the header height */
    padding-left: 15px;
    padding-right: 15px;
    position: fixed;          /* Fix it to the left side */
    top: 60px;
    left: 0;
    height: 100vh;            /* Full viewport height */
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    overflow-y: auto;         /* Enables scrolling for longer lists */
    z-index: 10;              /* Ensure it layers properly with other elements */
    transition: all 0.3s ease; /* Smooth transition for resizing */
}

.sidebar h2 {
    text-align: center;
    color: #ffffff;
    font-size: 24px;
    margin-bottom: 20px;
    font-weight: bold;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin: 15px 0;
}

.sidebar ul li a {
    text-decoration: none;
    color: #e0f7fa;
    font-size: 18px;
    display: flex;
    align-items: center;
    padding: 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.sidebar ul li a i {
    margin-right: 10px;
    font-size: 18px;
}

.sidebar ul li a:hover {
    background-color: #004d40;
    color: #ffffff;
}

.sidebar ul li a.active {
    background-color: #004d40;
    color: #ffffff;
    font-weight: bold;
}

.sidebar::-webkit-scrollbar {
    width: 8px;
}

.sidebar::-webkit-scrollbar-thumb {
    background: #004d40;
    border-radius: 10px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: #00251a;
}

/* For Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        position: fixed;
        width: 200px;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    .sidebar.open {
        transform: translateX(0);
    }

    .dashboard {
        margin-left: 200px;
    }

    .menu-toggle {
        display: block;
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 999;
        background: #004d40;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }
}
</style>
