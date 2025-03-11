document.addEventListener("DOMContentLoaded", function() {
    fetch("assets/php/view-academic-records.php")
        .then(response => response.json())
        .then(data => {
            let reportContainer = document.getElementById("academic-report");

            if (data.status === "success") {
                let groupedData = groupByForm(data.records);

                for (let form in groupedData) {
                    let formSection = document.createElement("div");
                    formSection.className = "form-section";
                    formSection.innerHTML = `
                        <h3>${form}</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Admission Number</th>
                                     <th>Term</th>                                    
                                    <th>Year</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${groupedData[form].map(record => `
                                    <tr>
                                        <td>${record.admission_number}</td>
                                        <td>${record.term}</td>
                                        <td>${record.year}</td>
                                        <td>${record.grade}</td>
                                        
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
            console.error("Error fetching academic records:", error);
            document.getElementById("academic-report").innerHTML = `<p>An error occurred. Please try again later.</p>`;
        });

    function groupByForm(records) {
        return records.reduce((acc, record) => {
            let form = record.form;
            if (!acc[form]) {
                acc[form] = [];
            }
            acc[form].push(record);
            return acc;
        }, {});
    }
});
