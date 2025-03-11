document.addEventListener('DOMContentLoaded', function() {
    const confirmLogoutButton = document.getElementById('confirmLogout');

    // When the "Yes" button is clicked
    confirmLogoutButton.addEventListener('click', function() {
        // Clear the browser history to disable forward/backward navigation
        window.location.replace('index.html');
    });

    // When the "No" button is clicked
    const cancelButton = document.querySelector('.btn-secondary');
    cancelButton.addEventListener('click', function() {
        // Go back to the previous page
        window.history.back();
    });
});
