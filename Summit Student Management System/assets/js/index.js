// index.js

document.addEventListener('DOMContentLoaded', function() {
    const showPasswordCheckbox = document.getElementById('showPassword');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
        // Toggle the type of the password input
        if (showPasswordCheckbox.checked) {
            passwordInput.type = 'text'; // Show password
        } else {
            passwordInput.type = 'password'; // Hide password
        }
    });
});
$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'assets/php/index.php',
            data: {
                username: $('#username').val(),
                password: $('#password').val()
            },
            dataType: 'json',
            success: function(response) {
                // Clear previous message classes
                $('#message').removeClass('text-success text-danger text-warning');

                if (response.status === 'success') {
                    $('#message').text('Login successful! Redirecting...')
                                 .addClass('text-success');
                    setTimeout(function() {
                        window.location.href = 'dashboard.html?username=' + response.username;
                    }, 1000); // Wait for 1 second before redirecting
                } else {
                    $('#message').text(response.message)
                                 .addClass('text-danger');
                }
            },
            error: function() {
                $('#message').text('An error occurred. Please try again.')
                             .addClass('text-warning');
            }
        });
    });

    // Show password toggle
    $('#showPassword').click(function() {
        var passwordField = $('#password');
        var passwordFieldType = passwordField.attr('type');
        if (passwordFieldType === 'password') {
            passwordField.attr('type', 'text');
        } else {
            passwordField.attr('type', 'password');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const showPasswordCheckbox = document.getElementById('showPassword');
    const passwordInput = document.getElementById('password');

    showPasswordCheckbox.addEventListener('change', function() {
        // Toggle the type of the password input
        if (showPasswordCheckbox.checked) {
            passwordInput.type = 'text'; // Show password
        } else {
            passwordInput.type = 'password'; // Hide password
        }
    });
});
