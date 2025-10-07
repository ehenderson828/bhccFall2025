// Function declaration
const sendData = () => {    
    // Variable declaration that targets the text area
    var data = document.getElementById("inputData");
    // Declare a second variable as a new FormData object
    var formData = new FormData(data);
    // CSV row construction - CSV row #1
    var player1 = formData.get("first_name1") + ',' 
        + formData.get("last_name1") + ',' 
        + formData.get("dob1") + ','
        + formData.get("major1") + ','
        + formData.get("gradyear1");
    // CSV row construction - CSV row #2
    var player2 = formData.get("first_name2") + ','
        + formData.get("last_name2") + ',' 
        + formData.get("dob2") + ','
        + formData.get("major2") + ','
        + formData.get("gradyear2");
    // Concatenate both players - with a new line for player2
    var csvData = player1 + '\n' + player2;
    // Create new HTTP request
    var xhr = new XMLHttpRequest();    
    // Configure said request as POST, asynchonously to our PHP handler
    xhr.open("POST", "/cmt228/henderson/addDataassignment/backend/update_file.php", true);    
    // Set the content type header to tell the server we're sending URL-encoded form data
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");   
    // Callback function - runs when request status changes
    xhr.onreadystatechange = () => {
        // Check to ensure request is complete
        if (xhr.readyState == 4) {
            // Check if successful
            if (xhr.status == 200) {
                // Alert the user that their request was successful
                alert("Data added successfully!");
                // Clear the form for next submission
                data.reset();
            }
            // If request is bad
            else {
                // Alert the user with the error
                alert("Error: " + xhr.status + " - " + xhr.statusText);
            }
        }    
    };    
    // Send the request, while encoding it properly to handle special characters
    xhr.send("data=" + encodeURIComponent(csvData)); 
}