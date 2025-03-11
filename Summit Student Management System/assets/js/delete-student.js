document.addEventListener("DOMContentLoaded", function() {
    const studentsTable = document.getElementById("students-table").getElementsByTagName("tbody")[0];

    function loadStudents() {
        fetch('assets/php/delete-student.php')
            .then(response => response.json())
            .then(students => {
                studentsTable.innerHTML = ''; // Clear existing rows
                students.forEach(student => {
                    const newRow = studentsTable.insertRow();
                    newRow.innerHTML = `
                        <td>${student.admission_number}</td>
                        <td>${student.first_name}</td>
                        <td>${student.last_name}</td>
                        <td>${student.form}</td>
                        <td><button class="delete-btn" data-admission-number="${student.admission_number}" data-name="${student.first_name} ${student.last_name}">Delete</button></td>
                    `;
                });

                // Sort table rows by admission number
                sortTableByAdmissionNumber();

                // Add event listeners to delete buttons
                document.querySelectorAll(".delete-btn").forEach(btn => {
                    btn.addEventListener("click", function() {
                        const admissionNumber = this.dataset.admissionNumber;
                        const name = this.dataset.name;

                        document.getElementById("popup-admission-number").value = admissionNumber;
                        document.getElementById("student-name").textContent = name;

                        document.getElementById("delete-student-popup").style.display = "block";
                    });
                });
            })
            .catch(error => console.error('Error fetching student data:', error));
    }

    // Function to sort table rows by admission number
    function sortTableByAdmissionNumber() {
        const rows = Array.from(studentsTable.getElementsByTagName("tr"));

        rows.sort((a, b) => {
            const admissionNumberA = a.cells[0].textContent.trim();
            const admissionNumberB = b.cells[0].textContent.trim();
            return admissionNumberA.localeCompare(admissionNumberB, undefined, { numeric: true });
        });

        // Reattach sorted rows to the table body
        rows.forEach(row => studentsTable.appendChild(row));
    }

    // Initial load of student data
    loadStudents();

    // Handle form submission
    document.getElementById("delete-student-form").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);

        fetch('assets/php/delete-student-action.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("status-message").textContent = data.message;
            if (data.status === 'success') {
                document.getElementById("status-message").style.color = 'green';
                loadStudents(); // Reload student data
                document.getElementById("delete-student-popup").style.display = "none";
            } else {
                document.getElementById("status-message").style.color = 'red';
            }
        })
        .catch(error => console.error('Error deleting student:', error));
    });

    // Close popup
    document.getElementById("popup-close").addEventListener("click", function() {
        document.getElementById("delete-student-popup").style.display = "none";
    });
});
