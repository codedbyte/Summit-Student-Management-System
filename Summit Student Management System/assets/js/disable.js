document.addEventListener('DOMContentLoaded', function() {
    // Redirect to index.html when back or forward button is pressed
    window.addEventListener('popstate', function(event) {
        window.location.href = 'index.html';
    });

    // Handle hash changes to also redirect to index.html
    window.addEventListener('hashchange', function() {
        window.location.href = 'index.html';
    });

    // Optionally push a custom state to prevent immediate back navigation
    history.pushState(null, null, window.location.href);
});
