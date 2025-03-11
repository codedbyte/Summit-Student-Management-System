document.addEventListener('DOMContentLoaded', function() {
    const formSelect = document.getElementById('form-select');
    const studentSelect = document.getElementById('student-select');
    const viewProfileButton = document.getElementById('view-profile');
    const profileCard = document.getElementById('student-profile-card');

    let groupedData = {};

    // Fetch and populate forms and students data
    fetch('assets/php/view-student.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                groupedData = groupByForm(data.students);

                // Populate form options
                formSelect.innerHTML = '<option selected disabled>Select Form</option>';
                Object.keys(groupedData).forEach(form => {
                    const option = document.createElement('option');
                    option.value = form;
                    option.textContent = form;
                    formSelect.appendChild(option);
                });
                formSelect.disabled = false;
            } else {
                alert("Failed to load student data.");
            }
        })
        .catch(error => {
            console.error("Error fetching student data:", error);
        });

    // Populate student options based on selected form
    formSelect.addEventListener('change', function() {
        const selectedForm = formSelect.value;
        const students = groupedData[selectedForm];

        studentSelect.innerHTML = '<option selected disabled>Select Student</option>';
        students.forEach(student => {
            const option = document.createElement('option');
            option.value = student.admission_number;
            option.textContent = `${student.first_name} ${student.last_name}`;
            studentSelect.appendChild(option);
        });
        studentSelect.disabled = false;
        viewProfileButton.disabled = true;
    });

    // Enable "View Profile" button when a student is selected
    studentSelect.addEventListener('change', function() {
        viewProfileButton.disabled = false;
    });

    // Display the student's profile when "View Profile" button is clicked
    viewProfileButton.addEventListener('click', function() {
        const selectedForm = formSelect.value;
        const selectedStudent = studentSelect.value;
        const student = groupedData[selectedForm].find(student => student.admission_number === selectedStudent);
        displayStudentProfile(student);
    });

    function groupByForm(students) {
        return students.reduce((acc, student) => {
            const form = student.form;
            if (!acc[form]) {
                acc[form] = [];
            }
            acc[form].push(student);
            return acc;
        }, {});
    }

    function displayStudentProfile(student) {
        document.getElementById("student-name").textContent = `${student.first_name} ${student.last_name}`;
        document.getElementById("admission-number").textContent = student.admission_number;
        document.getElementById("dob").textContent = student.dob;
        document.getElementById("gender").textContent = student.gender;
        document.getElementById("email").textContent = student.email;
        document.getElementById("phone").textContent = student.phone;
        document.getElementById("address").textContent = student.address;
        profileCard.style.display = 'block';
    }
});
