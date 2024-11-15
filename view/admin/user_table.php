<div class="container mt-4">
    <h2>Approved Users</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="user-table-body">
            <!-- Rows will be dynamically inserted here by admin.js -->
        </tbody>
    </table>

    <!-- Pagination -->
    <div id="pagination" class="d-flex justify-content-center">
        <!-- Pagination buttons will be dynamically inserted here by admin.js -->
    </div>
</div>

<script>
    // Load the table with approved users when the page loads
    $(document).ready(function() {
        loadTable(1, 'approved'); // Load the approved users
    });
</script>
