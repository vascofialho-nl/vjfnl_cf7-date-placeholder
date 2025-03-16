/* ========================================================================================================================== */
/* All the Javascripts and jayquerries be here 
/* ========================================================================================================================== */

document.addEventListener("DOMContentLoaded", function() {
    function applyPlaceholderFix(targetNode) {
        let dateFields = (targetNode || document).querySelectorAll("input[type='date']");
        dateFields.forEach(function(dateField) {
            if (!dateField.dataset.vjfnlProcessed) { // Avoid re-processing the same field
                let placeholderText = dateField.getAttribute("placeholder") || "Geboortedatum";
                console.log("Applying placeholder fix to:", dateField);

                dateField.setAttribute("type", "text");
                dateField.placeholder = placeholderText;

                dateField.addEventListener("focus", function() {
                    this.setAttribute("type", "date");
                });

                dateField.addEventListener("blur", function() {
                    if (!this.value) {
                        this.setAttribute("type", "text");
                        this.placeholder = placeholderText;
                    }
                });

                dateField.dataset.vjfnlProcessed = "true"; // Mark as processed
            }
        });
    }

    // Run on page load
    applyPlaceholderFix();

    // Watch for dynamic changes in the form
    let observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) { // Ensure it's an element
                    applyPlaceholderFix(node);
                }
            });
        });
    });

    observer.observe(document.body, { childList: true, subtree: true });
});
 
console.log("CF7 Date Placeholder script loaded!");