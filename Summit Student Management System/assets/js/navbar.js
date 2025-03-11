document.getElementById('menu-toggle').addEventListener('click', function() {
    var topBarLinks = document.getElementById('top-bar-links');
    
    if (topBarLinks.classList.contains('show')) {
        // Slide out
        topBarLinks.classList.remove('show');
        topBarLinks.style.maxHeight = '0';
        topBarLinks.style.opacity = '0';
    } else {
        // Slide in
        topBarLinks.classList.add('show');
        topBarLinks.style.maxHeight = topBarLinks.scrollHeight + 'px';
        topBarLinks.style.opacity = '1';
    }
});

document.querySelectorAll('#top-bar-links .dropdown > a').forEach(function(dropdownToggle) {
    dropdownToggle.addEventListener('click', function(event) {
        event.preventDefault();
        
        var dropdownMenu = this.nextElementSibling;
        var topBarLinks = document.getElementById('top-bar-links');

        if (dropdownMenu.classList.contains('show')) {
            // Slide up
            dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + 'px'; // set to current height to start transition
            dropdownMenu.style.opacity = '0';
            
            setTimeout(function() {
                dropdownMenu.style.maxHeight = '0';
                dropdownMenu.classList.remove('show');
                topBarLinks.style.maxHeight = topBarLinks.scrollHeight + 'px';
            }, 300); // Timeout for smoother transition
        } else {
            // Slide down
            dropdownMenu.classList.add('show');
            dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + 'px';
            dropdownMenu.style.opacity = '1';
            
            setTimeout(function() {
                topBarLinks.style.maxHeight = topBarLinks.scrollHeight + 'px';
            }, 300); // Timeout for smoother transition
        }
    });
});
