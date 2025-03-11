document.querySelectorAll('.view-report').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const url = this.getAttribute('href');
        
        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('reportContent').innerHTML = data;
                document.getElementById('reportModal').style.display = 'block';
            });
    });
});

document.querySelector('.modal .close').addEventListener('click', function() {
    document.getElementById('reportModal').style.display = 'none';
});

window.onclick = function(event) {
    if (event.target == document.getElementById('reportModal')) {
        document.getElementById('reportModal').style.display = 'none';
    }
};
