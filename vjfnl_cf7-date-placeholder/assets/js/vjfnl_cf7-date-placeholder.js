/* ========================================================================================================================== */
/* All the Javascripts and jayquerries be here 
/* ========================================================================================================================== */



document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("input[type='date']").forEach(function(dateField) {
        let placeholderText = dateField.getAttribute("placeholder") || "Geboortedatum";

        console.log("Found date field:", dateField); // Debug log
        console.log("Setting type to text");

        setTimeout(() => { 
            dateField.setAttribute("type", "text");
            dateField.placeholder = placeholderText;
        }, 500); // Delay to let CF7 finish processing

        dateField.addEventListener("focus", function() {
            console.log("Clicked on date field, switching to date type");
            this.setAttribute("type", "date"); 
        });

        dateField.addEventListener("blur", function() {
            if (!this.value) {
                console.log("Field is empty, switching back to text");
                this.setAttribute("type", "text"); 
                this.placeholder = placeholderText;
            }
        });
    });
});
