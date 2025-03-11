document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("attendance-date-form");
    const reportContainer = document.getElementById("attendance-report");

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        const date = document.getElementById("attendance-date").value;

        if (date) {
            fetch(`assets/php/view-attendance.php?date=${date}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        let groupedData = groupByForm(data.attendance);
                        let reportHTML = "";

                        for (let form in groupedData) {
                            reportHTML += `
                                <div class="form-section">
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
                                                    <td>${student.status}</td>
                                                    <td>${student.comments}</td>
                                                </tr>
                                            `).join('')}
                                        </tbody>
                                    </table>
                                </div>
                            `;
                        }
                        reportContainer.innerHTML = reportHTML;
                    } else {
                        reportContainer.innerHTML = `<p>${data.message}</p>`;
                    }
                })
                .catch(error => {
                    console.error("Error fetching attendance data:", error);
                    reportContainer.innerHTML = `<p>An error occurred. Please try again later.</p>`;
                });
        } else {
            reportContainer.innerHTML = `<p>Please select a date.</p>`;
        }
    });

    function groupByForm(attendance) {
        return attendance.reduce((acc, student) => {
            let form = student.form;
            if (!acc[form]) {
                acc[form] = [];
            }
            acc[form].push(student);
            return acc;
        }, {});
    }
});
