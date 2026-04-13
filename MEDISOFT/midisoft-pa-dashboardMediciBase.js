const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", function() {
    let filter = searchInput.value.toLowerCase();
    let rows = document.querySelectorAll("table tr");

    rows.forEach((row, index) => {
        // salta l'intestazione
        if (index === 0) return;

        let text = row.textContent.toLowerCase();

        if (text.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});