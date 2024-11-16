<?php
include("../../config/config.php");

// Fetch data from hall_rooms
$query = "SELECT hr.id, ui.name AS hall_name, hr.room_number, hr.total_seats, hr.occupied_seats, hr.status
          FROM hall_rooms hr
          JOIN university_info ui ON hr.hall_id = ui.id";
$result = mysqli_query($myconnect, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hall Rooms</title>
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
</head>
<body>
    <div class="both">
        <!-- Include Sidebar -->
        <div class="sidebar">
            <?php include("sidebar.php"); ?>
        </div>

        <!-- Main Content -->
        <div class="dashboard">
            <h1>Manage Hall Rooms</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hall Name</th>
                        <th>Room Number</th>
                        <th>Total Seats</th>
                        <th>Occupied Seats</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['hall_name']; ?></td>
                            <td><?php echo $row['room_number']; ?></td>
                            <td><?php echo $row['total_seats']; ?></td>
                            <td><?php echo $row['occupied_seats']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <a href="edit_hall_rooms.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete_hall_rooms.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
