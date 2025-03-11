// Function to fetch and render the attendance chart by form
function renderAttendanceByFormChart() {
    fetch('assets/php/get_attendance_by_form.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('attendanceChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Form 1', 'Form 2', 'Form 3', 'Form 4'],
                    datasets: [
                        {
                            label: 'Present',
                            data: [
                                data.form1.present_count,
                                data.form2.present_count,
                                data.form3.present_count,
                                data.form4.present_count
                            ],
                            backgroundColor: '#4a90e2', // Light Blue for Present
                        },
                        {
                            label: 'Absent',
                            data: [
                                data.form1.absent_count,
                                data.form2.absent_count,
                                data.form3.absent_count,
                                data.form4.absent_count
                            ],
                            backgroundColor: '#8ebbf7', // Lighter Blue for Absent
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            beginAtZero: true,
                            stacked: true,
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching attendance data by form:', error));
}

// Initial rendering of the chart
renderAttendanceByFormChart();
