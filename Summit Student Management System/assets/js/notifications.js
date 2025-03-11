document.addEventListener('DOMContentLoaded', function() {
    fetch('assets/php/fetch-notifications.php')
        .then(response => response.json())
        .then(data => {
            const today = new Date().toISOString().split('T')[0];
            const notificationsList = document.getElementById('notifications-list');
            notificationsList.innerHTML = '';

            data.forEach(notification => {
                if (notification.notify_date >= today) {
                    const notificationElement = document.createElement('div');

                    // Generate a random color for the notification
                    const r = Math.floor(Math.random() * 200);
                    const g = Math.floor(Math.random() * 200);
                    const b = Math.floor(Math.random() * 200);
                    const bgColor = `rgb(${r}, ${g}, ${b})`;

                    notificationElement.classList.add('alert');
                    notificationElement.style.backgroundColor = bgColor;
                    notificationElement.innerHTML = `
                        <strong>${notification.title}</strong> <br>
                        ${notification.description} <br>
                        <small>Notify Date: ${notification.notify_date}</small>
                    `;
                    notificationsList.appendChild(notificationElement);
                }
            });
        });

    // Handle form submission
    const form = document.getElementById('notification-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(form);

        fetch('assets/php/send-notification.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            const statusMessage = document.getElementById('status-message');
            statusMessage.innerHTML = `<div class="alert alert-info">${data}</div>`;

            // Refresh the notifications list after submission
            fetch('assets/php/fetch-notifications.php')
                .then(response => response.json())
                .then(data => {
                    const today = new Date().toISOString().split('T')[0];
                    const notificationsList = document.getElementById('notifications-list');
                    notificationsList.innerHTML = '';

                    data.forEach(notification => {
                        if (notification.notify_date >= today) {
                            const notificationElement = document.createElement('div');

                            // Generate a random color for the notification
                            const r = Math.floor(Math.random() * 200);
                            const g = Math.floor(Math.random() * 200);
                            const b = Math.floor(Math.random() * 200);
                            const bgColor = `rgb(${r}, ${g}, ${b})`;

                            notificationElement.classList.add('alert');
                            notificationElement.style.backgroundColor = bgColor;
                            notificationElement.innerHTML = `
                                <strong>${notification.title}</strong> <br>
                                ${notification.description} <br>
                                <small>Notify Date: ${notification.notify_date}</small>
                            `;
                            notificationsList.appendChild(notificationElement);
                        }
                    });
                });
        })
        .catch(error => {
            const statusMessage = document.getElementById('status-message');
            statusMessage.innerHTML = `<div class="alert alert-danger">Error: ${error}</div>`;
        });
    });
});
