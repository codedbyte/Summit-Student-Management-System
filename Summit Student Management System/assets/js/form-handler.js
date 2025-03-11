document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('academic-form');
    const messageDiv = document.getElementById('message');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch('assets/php/handle_form_submission.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            } else {
                messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => {
            messageDiv.innerHTML = `<div class="alert alert-danger">An unexpected error occurred. Please try again later.</div>`;
        });
    });
});
