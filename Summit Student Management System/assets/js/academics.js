document.addEventListener('DOMContentLoaded', function() {
    fetch('assets/php/academics-chart.php') // Replace with the correct path to your PHP script
        .then(response => response.json())
        .then(data => {
            const formLabels = ['Form 1', 'Form 2', 'Form 3', 'Form 4'];

            // Prepare the data for the chart
            const averagePoints = [
                data.form1 || 0,
                data.form2 || 0,
                data.form3 || 0,
                data.form4 || 0
            ];

            // Render the chart
            const ctx = document.getElementById('performanceChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: formLabels,
                    datasets: [{
                        label: 'Average Points',
                        data: averagePoints,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Average Points'
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Average Academic Performance by Form'
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
