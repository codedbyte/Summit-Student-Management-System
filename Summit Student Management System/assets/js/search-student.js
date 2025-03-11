document.getElementById('search-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting traditionally

    const formData = new FormData(this);

    fetch('assets/php/search-student.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('results').innerHTML = data;
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('results').innerHTML = "<div class='no-results'>An error occurred while searching. Please try again later.</div>";
    });
});
