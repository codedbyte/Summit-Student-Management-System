// Function to fetch and update notifications count
function updateNotificationsCount() {
    fetch('assets/php/get_notifications_count.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('notifications-count').textContent = data;
        })
        .catch(error => console.error('Error fetching notifications count:', error));
}

// Auto-update the notifications count every 10 seconds
setInterval(updateNotificationsCount, 10000);

// Initial load of the notifications count
updateNotificationsCount();

// Redirect to send-notifications.html when the card is clicked
document.getElementById('notification-card').addEventListener('click', function() {
    window.location.href = 'send-notifications.html';
});
