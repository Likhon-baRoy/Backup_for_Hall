function loadTable(page = 1, status = 'approved') {
    const filter = document.getElementById('filter') ? document.getElementById('filter').value : '';
    const search = document.querySelector('input[name="search"]') ? document.querySelector('input[name="search"]').value : '';

    $.ajax({
        url: '../../controller/admin/fetch_user.php',
        method: 'GET',
        data: { filter: filter, search: search, page: page, status: status },
        dataType: 'json',
        success: function(response) {
            if (response.error) {
                alert(response.error);
                return;
            }

            const userTableBody = $('#user-table-body');
            userTableBody.empty();
            response.users.forEach(user => {
                userTableBody.append(`
                    <tr>
                        <td>${user.uid}</td>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>${user.phone}</td>
                        <td>${user.role}</td>
                        <td>
                            ${status === 'pending' ? `
                                     <button onclick="approveApplicant(${user.uid})">Approve</button>
                                     <button onclick="rejectApplicant(${user.uid})">Reject</button>
                                     ` : `
                                     <a href='edit.php?id=${user.uid}' class='btn btn-warning'>Edit</a>
                                     <a href='delete.php?id=${user.uid}' class='btn btn-danger' onclick="return confirmAction('delete')">Delete</a>
                                     `}
                        </td>
                    </tr>
                `);
            });

            paginationInfo(response.pagination.currentPage, response.pagination.totalPages, status);
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("An error occurred while loading data.");
        }
    });
}

// Trigger loadTable on filter and search input change
$(document).ready(function() {
    const isPending = $('h2').text().includes('Pending');
    const status = isPending ? 'pending' : 'approved';
    loadTable(1, status);

    // Event listeners for filter and search
    $('#filter').on('change', function() {
        loadTable(1, status);
    });

    $('input[name="search"]').on('keyup', function() {
        loadTable(1, status);
    });
});
