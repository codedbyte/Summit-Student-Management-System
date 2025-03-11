$(document).ready(function() {
    $('#verifyCodeForm').submit(function(e) {
      e.preventDefault();
  
      const urlParams = new URLSearchParams(window.location.search);
      const email = urlParams.get('email');
  
      $.ajax({
        type: 'POST',
        url: 'assets/php/verify-code.php',
        data: {
          email: email,
          verification_code: $('#verification_code').val()
        },
        dataType: 'json',
        success: function(response) {
          $('#message').removeClass('text-success text-danger text-warning');
  
          if (response.status === 'success') {
            $('#message').text(response.message).addClass('text-success');
            // Redirect to reset-password.html with token
            setTimeout(function() {
              window.location.href = 'reset-password.html?token=' + encodeURIComponent(response.token);
            }, 2000);
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
  