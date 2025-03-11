document.addEventListener('DOMContentLoaded', function () {
    const tableSelect = document.getElementById('tableSelect');
    const formFilter = document.getElementById('formFilter');
    const applyFilterBtn = document.getElementById('applyFilter');
    const downloadBtn = document.getElementById('downloadPDF');

    tableSelect.addEventListener('change', function () {
        const selectedCategory = tableSelect.value;

        document.querySelectorAll('#formFilter input[type="checkbox"]').forEach(function (checkbox) {
            checkbox.checked = false;
        });

        if (['students', 'academics', 'attendance'].includes(selectedCategory)) {
            formFilter.style.display = 'block';
        } else {
            formFilter.style.display = 'none';
        }
    });

    applyFilterBtn.addEventListener('click', function () {
        const selectedCategory = tableSelect.value;
        const selectedForms = Array.from(document.querySelectorAll('#formFilter input[type="checkbox"]:checked')).map(cb => cb.value);
        const queryString = `category=${selectedCategory}&forms=${selectedForms.join(',')}`;
        
        fetch(`assets/php/view-report.php?${queryString}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('reportContent').innerHTML = data;
            });
    });

    downloadBtn.addEventListener('click', function () {
        const selectedCategory = tableSelect.value;
        const selectedForms = Array.from(document.querySelectorAll('#formFilter input[type="checkbox"]:checked')).map(cb => cb.value);
        const queryString = `category=${selectedCategory}&forms=${selectedForms.join(',')}`;
        
        window.location.href = `assets/php/download-pdf.php?${queryString}`;
    });
});
