<?php
include("../../config/config.php");

// Fetch data from university_info
$query = "SELECT * FROM university_info";
$result = mysqli_query($myconnect, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage University Info</title>
    <link rel="stylesheet" href="../../assets/css/sidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

td[colspan="7"] {
    font-style: italic;
    color: gray;
}
    </style>
</head>
<body>
    <div class="both">
        <!-- Include Sidebar -->
        <div class="sidebar">
            <?php include("../../view/admin/sidebar.php"); // Your sidebar file ?>
        </div>

        <!-- Main Content -->
        <div class="dashboard">
            <h1>Manage University Info</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['location']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <a href="edit_university_info.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a href="delete_university_info.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
