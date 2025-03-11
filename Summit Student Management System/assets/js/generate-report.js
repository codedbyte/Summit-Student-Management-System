document.addEventListener('DOMContentLoaded', function () {
    const reportTypeSelect = document.getElementById('report-type');
    const reportContent = document.getElementById('report-content');
    const reportTitle = document.getElementById('report-title');
    const generateReportButton = document.getElementById('generate-report');
    const downloadPdfButton = document.getElementById('download-pdf');

    generateReportButton.addEventListener('click', function () {
        const reportType = reportTypeSelect.value;
        generateReport(reportType);
    });

    downloadPdfButton.addEventListener('click', function () {
        downloadPDF();
    });

    function generateReport(type) {
        let tableHtml = '';
        if (type === 'students') {
            reportTitle.innerText = 'All Students Report';
            tableHtml = generateStudentsTable();
        } else if (type === 'form2') {
            reportTitle.innerText = 'Form 2 Students Report';
            tableHtml = generateForm2Table();
        }
        reportContent.innerHTML = tableHtml;
    }

    function generateStudentsTable() {
        return `
            <table>
                <tr><th>ID</th><th>Name</th><th>Class</th></tr>
                <tr><td>1</td><td>John Doe</td><td>Form 1</td></tr>
                <tr><td>2</td><td>Jane Doe</td><td>Form 2</td></tr>
                <!-- Add more rows as needed -->
            </table>
        `;
    }

    function generateForm2Table() {
        return `
            <table>
                <tr><th>ID</th><th>Name</th><th>Age</th></tr>
                <tr><td>1</td><td>John Doe</td><td>16</td></tr>
                <tr><td>2</td><td>Jane Smith</td><td>17</td></tr>
                <!-- Add more rows as needed -->
            </table>
        `;
    }

    function downloadPDF() {
        const docDefinition = {
            content: [
                { text: reportTitle.innerText, style: 'header' },
                { text: reportContent.innerHTML, style: 'table' }
            ],
            styles: {
                header: {
                    fontSize: 22,
                    bold: true,
                    alignment: 'center'
                },
                table: {
                    margin: [0, 20, 0, 20]
                }
            }
        };
        pdfMake.createPdf(docDefinition).download(reportTitle.innerText + '.pdf');
    }
});
