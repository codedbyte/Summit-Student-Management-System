document.addEventListener('DOMContentLoaded', () => {
    fetchStudents();

    function fetchStudents() {
        fetch('assets/php/get-studen.php')
            .then(response => response.json())
            .then(data => {
                populateTablesByForm(data);
            })
            .catch(error => console.error('Error fetching students:', error));
    }

    function populateTablesByForm(students) {
        const form1TableBody = document.querySelector('#form1-table tbody');
        const form2TableBody = document.querySelector('#form2-table tbody');
        const form3TableBody = document.querySelector('#form3-table tbody');
        const form4TableBody = document.querySelector('#form4-table tbody');

        form1TableBody.innerHTML = '';
        form2TableBody.innerHTML = '';
        form3TableBody.innerHTML = '';
        form4TableBody.innerHTML = '';

        students.forEach(student => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${student.admission_number}</td>
                <td>${student.first_name}</td>
                <td>${student.last_name}</td>
                <td><button class="update-button" type="button" onclick="editStudent('${student.admission_number}')">Update Student</button></td>
            `;

            switch(student.form) {
                case 'form1':
                    form1TableBody.appendChild(row);
                    break;
                case 'form2':
                    form2TableBody.appendChild(row);
                    break;
                case 'form3':
                    form3TableBody.appendChild(row);
                    break;
                case 'form4':
                    form4TableBody.appendChild(row);
                    break;
            }
        });
    }

    window.editStudent = (admissionNumber) => {
        fetch(`assets/php/get-student.php?admission_number=${admissionNumber}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('popup-first-name').value = data.first_name || '';
                    document.getElementById('popup-last-name').value = data.last_name || '';
                    document.getElementById('popup-dob').value = data.dob || '';
                    document.getElementById('popup-gender').value = data.gender || '';
                    document.getElementById('popup-email').value = data.email || '';
                    document.getElementById('popup-phone').value = data.phone || '';
                    document.getElementById('popup-address').value = data.address || '';
                    document.getElementById('popup-admission-number').value = data.admission_number || '';
                    document.getElementById('popup-form').value = data.form || '';
                    document.getElementById('popup-comments').value = data.comments || '';

                    document.getElementById('update-student-popup').classList.add('active');
                }
            })
            .catch(error => console.error('Error fetching student data:', error));
    };

    document.getElementById('popup-close').addEventListener('click', () => {
        document.getElementById('update-student-popup').classList.remove('active');
    });

    document.getElementById('update-student-form').addEventListener('submit', (event) => {
        event.preventDefault();
        updateStudent();
    });

    function updateStudent() {
        const formData = new FormData(document.getElementById('update-student-form'));

        fetch('assets/php/update-student.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const statusMessageDiv = document.getElementById('status-message');
            if (data.status === 'success') {
                statusMessageDiv.textContent = 'Student updated successfully!';
                statusMessageDiv.style.color = 'green';
                fetchStudents(); // Reload students list
            } else {
                statusMessageDiv.textContent = `Error: ${data.message}`;
                statusMessageDiv.style.color = 'red';
            }
            setTimeout(() => {
                statusMessageDiv.textContent = '';
            }, 5000); // Clear message after 5 seconds
        })
        .catch(error => console.error('Error updating student:', error));
    }
});
