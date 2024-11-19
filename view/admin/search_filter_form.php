<div class="container mt-4">
    <h2 class="mb-4"><?php echo ($status === 'pending') ? 'Pending Users' : 'Approved Users'; ?></h2>

    <!-- Controls Container -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-end">
                <!-- Search Box -->
                <div class="col-md-4 mb-3 mb-md-0">
                    <label for="search" class="form-label">Search Users</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input
                            type="text"
                            name="search"
                            id="search"
                            class="form-control"
                            placeholder="Search by ID, name, email, phone..."
                        >
                    </div>
                </div>

                <!-- Role Filter -->
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="filter" class="form-label">Filter by Role</label>
                    <select id="filter" class="form-select">
                        <option value="all">All Roles</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                        <option value="instructor">Instructor</option>
                    </select>
                </div>

                <!-- Sort Controls -->
                <div class="col-md-3 mb-3 mb-md-0">
                    <label for="sortToggle" class="form-label">Sort by Time</label>
                    <button id="sortToggle" class="form-control btn btn-outline-primary">
                        <i class="fas fa-clock me-2"></i>
                        <span class="sort-text">
                            <?php echo ($status === 'pending') ? 'Application' : 'Approval'; ?> Time ↓
                        </span>
                    </button>
                </div>

                <!-- Clear Filters -->
                <div class="col-md-2 mb-3 mb-md-0">
                    <button id="clearFilters" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-undo me-2"></i>Clear Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Info -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="results-info">
            Showing <span id="currentResults">0</span> of <span id="totalResults">0</span> users
        </div>
        <div class="table-controls">
            <select id="pageSize" class="form-select form-select-sm d-inline-block w-auto">
                <option value="3">3 per page</option>
                <option value="5">5 per page</option>
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
            </select>
        </div>
    </div>
</div>
