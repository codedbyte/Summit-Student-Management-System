document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-button');
    const modalBackground = document.querySelector('.modal-background');
    const modalContent = document.querySelector('.modal-content');
    let studentIdToDelete = null;
    let studentNameToDelete = '';

    // Open modal on delete button click
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            studentIdToDelete = this.dataset.studentId;
            studentNameToDelete = this.dataset.studentName;
            modalContent.querySelector('.modal-message').textContent = `Are you sure you want to remove ${studentNameToDelete} from the system?`;
            modalBackground.style.display = 'flex';
        });
    });

    // Close modal on 'No' button click
    document.querySelector('.modal-no').addEventListener('click', function() {
        modalBackground.style.display = 'none';
    });

    // Delete student on 'Yes' button click
    document.querySelector('.modal-yes').addEventListener('click', function() {
        // AJAX request to delete the student
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'assets/php/delete_student.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Remove the student's row from the table
                document.querySelector(`tr[data-student-id="${studentIdToDelete}"]`).remove();
            }
            modalBackground.style.display = 'none';
        };
        xhr.send(`student_id=${studentIdToDelete}`);
    });
});
