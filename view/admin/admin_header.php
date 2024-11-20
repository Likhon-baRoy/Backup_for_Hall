<div class="brand"> <i class="fas fa-university"></i> University Hall Management System </div>
<nav>
    <ul class="nav-links">
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropbtn">
                <i class="fas fa-bell"></i> <!-- Golden Bell Icon -->
            </a>
            <div class="dropdown-content">
                <a href="#">Notifications</a>
                <a href="#">View All</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropbtn">
                <i class="fas fa-user"></i> Profile
            </a>
            <div class="dropdown-content">
                <a href="../../public/index.php">Homepage</a>
                <a href="#">Settings</a>
                <a href="#">Logout</a>
            </div>
        </li>
    </ul>
</nav>

<style>
/* Header Styling */
.floating-header {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: #1a1a2e; /* Dark background to match sidebar */
    color: #ffffff; /* White text for contrast */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    padding: 15px 30px 20px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.floating-header .logo {
    font-size: 1.5rem;
    font-weight: bold;
    color: #ffffff;
}

.floating-header .nav-links {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 20px;
}

.floating-header .nav-links li {
    display: inline;
    position: relative;
}

.floating-header .nav-links a {
    text-decoration: none;
    color: #00d4ff; /* Bright accent color for links */
    font-weight: 500;
    transition: color 0.3s ease;
}

.floating-header .nav-links a:hover {
    color: #00aaff;
}

.floating-header .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.floating-header .dropdown:hover .dropdown-content {
    display: block;
}

.floating-header .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.floating-header .dropdown-content a:hover {
    background-color: #ddd;
}

.floating-header .fa-bell {
    color: gold; /* Golden bell icon */
}

/* Main Content Adjustment */
.main-content {
    margin-left: 250px; /* Matches sidebar width */
    padding: 20px;
}

/* Avoid overlapping with header */
body {
    margin-top: 80px; /* Header height */
}
/* Brand Section */
.brand {
    font-size: 24px;
    font-weight: bold;
    font-family: 'Times New Roman', serif;
    display: flex;
    align-items: center;
}

.brand i {
    margin-right: 10px;
    font-size: 26px;
}
</style>
