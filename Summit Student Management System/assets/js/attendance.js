document.addEventListener("DOMContentLoaded", function () {
    fetch("assets/php/view-student.php")
        .then(response => response.json())
        .then(data => {
            let formContainer = document.getElementById("attendance-form-container");

            if (data.status === "success") {
                let groupedData = groupByForm(data.students);
                let formElement = document.createElement("form");
                formElement.setAttribute("id", "attendance-form");

                // Add a date input field
                let dateField = document.createElement("div");
                dateField.className = "date-field mb-4";
                dateField.innerHTML = `
                    <label for="attendance-date">Select Date:</label>
                    <input type="date" id="attendance-date" name="attendance_date" class="form-control" required>
                `;
                formElement.appendChild(dateField);

                for (let form in groupedData) {
                    let formSection = document.createElement("div");
                    formSection.className = "form-section";
                    formSection.innerHTML = `
                        <h3>${form}</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Admission Number</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${groupedData[form].map(student => `
                                    <tr>
                                        <td>${student.admission_number}</td>
                                        <td>${student.first_name} ${student.last_name}</td>
                                        <td>
                                            <select name="status" data-admission-number="${student.admission_number}" data-form="${student.form}" class="form-select">
                                                <option value="Present">Present</option>
                                                <option value="Absent">Absent</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="comments" data-admission-number="${student.admission_number}" placeholder="Optional comments" class="form-control">
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    `;
                    formElement.appendChild(formSection);
                }

                formContainer.innerHTML = ""; // Clear the loading text
                formContainer.appendChild(formElement);

                // Add a submit button
                let submitButton = document.createElement("button");
                submitButton.textContent = "Submit Attendance";
                submitButton.className = "btn btn-primary mt-4";
                submitButton.setAttribute("type", "submit");
                formElement.appendChild(submitButton);

                // Handle form submission
                formElement.addEventListener("submit", function (e) {
                    e.preventDefault();

                    let attendanceDate = document.getElementById("attendance-date").value;
                    if (!attendanceDate) {
                        displayMessage("Please select a date.", "danger");
                        return;
                    }

                    // Check if attendance for the selected date has already been submitted
                    fetch("assets/php/check-attendance.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ date: attendanceDate })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "exists") {
                            displayMessage(data.message, "danger");
                        } else if (data.status === "not_exists") {
                            submitAttendance(attendanceDate);
                        } else {
                            displayMessage("An error occurred while checking attendance.", "danger");
                        }
                    })
                    .catch(error => {
                        console.error("Error checking attendance:", error);
                        displayMessage("An error occurred while checking attendance. Please try again later.", "danger");
                    });
                });

                function submitAttendance(attendanceDate) {
                    let students = [];
                    let admissionNumbers = new Set();
                    let hasDuplicates = false;

                    formElement.querySelectorAll("select[name='status']").forEach(selectElement => {
                        let admissionNumber = selectElement.getAttribute("data-admission-number");
                        let form = selectElement.getAttribute("data-form");
                        let status = selectElement.value;
                        let comments = formElement.querySelector(`input[name='comments'][data-admission-number='${admissionNumber}']`).value;

                        if (admissionNumbers.has(admissionNumber)) {
                            hasDuplicates = true;
                        } else {
                            admissionNumbers.add(admissionNumber);
                            students.push({ admission_number: admissionNumber, form: form, status: status, comments: comments });
                        }
                    });

                    if (hasDuplicates) {
                        displayMessage("Duplicate entries detected. Each student's attendance should only be marked once per date.", "danger");
                        return;
                    }

                    fetch("assets/php/mark-attendance.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ date: attendanceDate, students: students })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === "success") {
                            displayMessage("Attendance successfully marked.", "success");
                        } else {
                            displayMessage("Failed to mark attendance. Please try again.", "danger");
                        }
                    })
                    .catch(error => {
                        console.error("Error marking attendance:", error);
                        displayMessage("An error occurred while marking attendance. Please try again later.", "danger");
                    });
                }

                function displayMessage(message, type) {
                    let messageContainer = document.getElementById("message-container");
                    if (messageContainer) {
                        messageContainer.style.display = "block";
                        messageContainer.className = `alert alert-${type}`;
                        messageContainer.textContent = message;
                    } else {
                        console.error("Message container not found.");
                    }
                }
                
                function groupByForm(students) {
                    return students.reduce((acc, student) => {
                        let form = student.form;
                        if (!acc[form]) {
                            acc[form] = [];
                        }
                        acc[form].push(student);
                        return acc;
                    }, {});
                }
            } else {
                formContainer.innerHTML = `<p>${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error("Error fetching student data:", error);
            document.getElementById("attendance-form-container").innerHTML = `<p>An error occurred. Please try again later.</p>`;
        });
});
