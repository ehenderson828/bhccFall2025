function showHint(str) {
    // Get the span element
    let span = document.getElementById("txtHint");

    // Check to see is the lenth of the str variable is 0
    if (str.length == 0) {
        // If true, clear the text hint span element
        span.innerHTML = "";
        // Remove the visible class and add hidden class
        span.classList.remove("visible");
        span.classList.add("hidden");
        return;
    }
    else {
        // Declare a new XHR object
        var xmlhttp = new XMLHttpRequest();
        // Run this callback
        xmlhttp.onreadystatechange = function() {
            // Check to see if Ajax request is complete, and response is good
            if (this.readyState == 4 && this.status == 200) {
                // Assign the value of the text hint span to the ajax response from gethint.php
                span.innerHTML = this.responseText;
                // Remove hidden class and add the visible class once content is present
                span.classList.remove("hidden");
                span.classList.add("visible");
            }
        };
        // Open new asynchonous Ajax request - where q = str;
        xmlhttp.open("GET", "scripts/gethint.php?q=" + str, true);
        // Send the request
        xmlhttp.send();
    }
}