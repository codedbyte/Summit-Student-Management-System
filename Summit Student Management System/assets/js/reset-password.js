$(document).ready(function() {
    $('#resetPasswordForm').submit(function(e) {
        e.preventDefault();

        const username = $('#username').val().trim();
        const email = $('#email').val().trim();
        const newPassword = $('#newPassword').val().trim();
        const confirmPassword = $('#confirmPassword').val().trim();

        if (username === '' || email === '' || newPassword === '' || confirmPassword === '') {
            $('#message').text('All fields are required.').addClass('text-danger');
            return;
        }

        if (newPassword !== confirmPassword) {
            $('#message').text('Passwords do not match.').addClass('text-danger');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'assets/php/reset_password.php',
            data: {
                username: username,
                email: email,
                newPassword: newPassword
            },
            dataType: 'json',
            success: function(response) {
                $('#message').removeClass('text-success text-danger text-warning');

                if (response.status === 'success') {
                    $('#message').text('Password reset successful! Redirecting to login...')
                                 .addClass('text-success');
                    setTimeout(function() {
                        window.location.href = 'index.html';
                    }, 1000);
                } else {
                    $('#message').text(response.message).addClass('text-danger');
                }
            },
            error: function() {
                $('#message').text('An error occurred. Please try again.').addClass('text-warning');
            }
        });
    });
});
