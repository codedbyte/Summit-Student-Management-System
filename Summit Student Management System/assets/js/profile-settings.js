document.addEventListener('DOMContentLoaded', function() {
    fetch('assets/php/get-user-data.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('firstname').value = data.firstname;
                document.getElementById('lastname').value = data.lastname;
                document.getElementById('email').value = data.email;
                document.getElementById('phone_number').value = data.phone_number;
            } else {
                console.error('Failed to load user data.');
            }
        })
        .catch(error => console.error('Error:', error));
});

document.getElementById('profileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('assets/php/update-profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const messageElement = document.getElementById('message');
        if (data.success) {
            messageElement.innerHTML = '<div class="alert alert-success">Profile updated successfully!</div>';
            // Optionally reload user data after update
            loadUserData();
        } else {
            messageElement.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    })
    .catch(error => console.error('Error:', error));
});

function loadUserData() {
    fetch('assets/php/get-user-data.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('firstname').value = data.firstname;
                document.getElementById('lastname').value = data.lastname;
                document.getElementById('email').value = data.email;
                document.getElementById('phone_number').value = data.phone_number;
            } else {
                console.error('Failed to load user data.');
            }
        })
        .catch(error => console.error('Error:', error));
}
