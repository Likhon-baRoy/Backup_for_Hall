function loadTable(page = 1, status = 'approved') {
    // Get filter and search values, with null checks for elements
    const filter = $('#filter').length ? $('#filter').val() : '';
    const search = $('input[name="search"]').length ? $('input[name="search"]').val() : '';

    $.ajax({
        url: '../../controller/admin/fetch_user.php',
        method: 'GET',
        data: { filter, search, page, status },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            const userTableBody = $('#user-table-body');
            userTableBody.empty(); // Clear previous data

            if (response.users && response.users.length > 0) {
                // Populate table with user data
                response.users.forEach(user => {
                    const actionButtons = (status === 'pending')
                          ? `<button onclick="approveApplicant(${user.uid})" class="btn btn-success">Approve</button>
                           <button onclick="rejectApplicant(${user.uid})" class="btn btn-danger">Reject</button>`
                          : `<a href='edit.php?id=${user.uid}' class='btn btn-warning'>Edit</a>
                           <a href='delete.php?id=${user.uid}' class='btn btn-danger' onclick="return confirmAction('delete')">Delete</a>`;

                    userTableBody.append(`
                        <tr>
                            <td>${user.uid}</td>
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>${user.phone}</td>
                            <td>${user.role}</td>
                            <td>${actionButtons}</td>
                        </tr>
                    `);
                });
            } else {
                userTableBody.append(`
                    <tr>
                        <td colspan="6" class="text-center">No users found.</td>
                    </tr>
                `);
            }

            // Update pagination
            updatePagination(response.pagination.currentPage, response.pagination.totalPages, status);
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("An error occurred while loading data. Please try again.");
        }
    });
}

// Pagination function to dynamically create pagination buttons
function updatePagination(currentPage, totalPages, status) {
    const pagination = $('#pagination');
    pagination.empty();

    for (let i = 1; i <= totalPages; i++) {
        pagination.append(`
            <button class="btn ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'}"
                onclick="loadTable(${i}, '${status}')">${i}</button>
        `);
    }
}

// Initialize the table and set up event listeners
$(document).ready(function() {
    // Determine the status based on the header content
    const isPending = $('h2').text().includes('Pending');
    const status = isPending ? 'pending' : 'approved';

    // Load initial table data based on the page's purpose
    loadTable(1, status);

    // Event listeners for filter and search input
    $('#filter').on('change', function() {
        loadTable(1, status); // Reload table on filter change
    });

    $('input[name="search"]').on('keyup', function() {
        loadTable(1, status); // Reload table on search input
    });
});
