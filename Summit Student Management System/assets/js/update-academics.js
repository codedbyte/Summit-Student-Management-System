document.addEventListener('DOMContentLoaded', function() {
    const formSelect = document.getElementById('form-select');
    const studentSelect = document.getElementById('student-select');

    // Fetch and populate forms
    fetch('assets/php/fetch_forms.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(form => {
                const option = document.createElement('option');
                option.value = form;
                option.textContent = form;
                formSelect.appendChild(option);
            });
        });

    // Fetch and populate students based on form selection
    formSelect.addEventListener('change', function() {
        const form = formSelect.value;
        fetch(`assets/php/fetch_students.php?form=${form}`)
            .then(response => response.json())
            .then(data => {
                studentSelect.innerHTML = '<option value="" disabled selected>Select Student</option>';
                data.forEach(student => {
                    const option = document.createElement('option');
                    option.value = student.admission_number;
                    option.textContent = student.name;
                    studentSelect.appendChild(option);
                });
            });
    });
});
