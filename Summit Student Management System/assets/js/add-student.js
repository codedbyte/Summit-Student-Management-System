document.querySelector("form").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("assets/php/add-student.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response received:", data);  // Debugging line

        let statusMessage = document.getElementById("status-message");

        if (data.status === "success") {
            statusMessage.textContent = data.message;
            statusMessage.style.color = "green";
        } else {
            statusMessage.textContent = data.message;
            statusMessage.style.color = "red";
        }
    })
    .catch(error => {
        let statusMessage = document.getElementById("status-message");
        statusMessage.textContent = "An error occurred. Please try again.";
        statusMessage.style.color = "red";
        console.error("Error:", error);
    });
});
