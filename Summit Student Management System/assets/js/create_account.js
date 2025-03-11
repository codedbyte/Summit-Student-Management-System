
$(document).ready(function() {
    $('#createAccountForm').submit(function(e) {
        e.preventDefault();

        // Check if passwords match
        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();

        if (password !== confirmPassword) {
            $('#message').text('Passwords do not match!').addClass('text-danger');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'assets/php/create_account.php',
            data: {
                firstname: $('#firstname').val(),
                lastname: $('#lastname').val(),
                username: $('#username').val(),
                email: $('#email').val(),
                phone_number: $('#phone_number').val(),
                password: password
            },
            dataType: 'json',
            success: function(response) {
                $('#message').removeClass('text-success text-danger');
                if (response.status === 'success') {
                    $('#message').text('Account created successfully! Redirecting to login...')
                                 .addClass('text-success');
                    setTimeout(function() {
                        window.location.href = 'index.html';
                    }, 1000);
                } else {
                    $('#message').text(response.message).addClass('text-danger');
                }
            },
            error: function() {
                $('#message').text('An error occurred. Please try again.').addClass('text-danger');
            }
        });
    });
});
