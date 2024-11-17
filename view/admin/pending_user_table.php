<!-- pending_user_table.php follows the same structure but with "Applied Time" instead -->
<div class="container mt-4">
    <h2>Pending Users</h2>
    <div class="mb-3">
        <button id="sortToggle" class="btn btn-outline-secondary">
            Sort by Application Time ↓
        </button>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Applied Time</th>
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
