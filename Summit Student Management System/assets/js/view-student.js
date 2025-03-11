document.addEventListener("DOMContentLoaded", function() {
    fetch("assets/php/view-student.php")
        .then(response => response.json())
        .then(data => {
            let reportContainer = document.getElementById("students-report");

            if (data.status === "success") {
                let groupedData = groupByForm(data.students);
                
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
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${groupedData[form].map(student => `
                                    <tr>
                                        <td>${student.admission_number}</td>
                                        <td>${student.first_name} ${student.last_name}</td>
                                        <td>${student.dob}</td>
                                        <td>${student.gender}</td>
                                        <td>${student.email}</td>
                                        <td>${student.phone}</td>
                                        <td>${student.address}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    `;
                    reportContainer.appendChild(formSection);
                }
            } else {
                reportContainer.innerHTML = `<p>${data.message}</p>`;
            }
        })
        .catch(error => {
            console.error("Error fetching student data:", error);
            document.getElementById("students-report").innerHTML = `<p>An error occurred. Please try again later.</p>`;
        });

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
});
