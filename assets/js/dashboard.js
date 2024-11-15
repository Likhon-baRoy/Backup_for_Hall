$(document).ready(function () {
    loadDashboard();

    function loadDashboard() {
        $.ajax({
            url: '../../controller/admin/fetch_dashboard_data.php', // Backend to fetch dashboard data
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#total-users').text(response.totalUsers);
                $('#pending-users').text(response.pendingUsers);
                // Add other metric updates
            },
            error: function () {
                alert('Failed to load dashboard data.');
            }
        });
    }
});
