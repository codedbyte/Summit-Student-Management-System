// Function to fetch and update the attendance rate
function updateAttendanceRate() {
    fetch('assets/php/get_attendance_rate.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('attendance-rate').textContent = data.rate;
        })
        .catch(error => console.error('Error fetching attendance rate:', error));
}

// Auto-update the attendance rate every 10 seconds
setInterval(updateAttendanceRate, 10000);

// Initial load of the attendance rate
updateAttendanceRate();
