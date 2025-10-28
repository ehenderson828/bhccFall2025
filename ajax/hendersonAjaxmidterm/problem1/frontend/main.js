// Read CSV function
const readCSV = () => {
    // New xhr object declaration
    const xhr = new XMLHttpRequest();
    // Event listener for Ajax request
    xhr.onreadystatechange = () => {
        // Check to see if request is complete
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // Check to see if request was successful
            if (xhr.status === 200) {
                // Format response and create table
                try {
                    // Collect resonse
                    const csvText = xhr.responseText;
                    // Trim and split resonse between commas
                    const values = csvText.trim().split(',');
                    // Map said values as numbers
                    const [start, end, increment] = values.map(Number);
                    // Callback to create table
                    createTable(start, end, increment);
                }
                // If error while status is successful, alert user
                catch (error) {
                    alert('Error: ' + xhr.status + ' - ' + xhr.statusText);
                }
            }
            // If request is not finished, alert user
            else {
                alert('Error creating table: ' + xhr.status + ' - ' + xhr.statusText);
            }
        }
    }
    // Get request
    xhr.open('GET', 'data/temps.csv', true);
    // Send request
    xhr.send();
}

// Table creation
const createTable = (start, end, increment) => {
    // Select table body
    const tbody = document.querySelector('.tbody');
    // Clear contents
    tbody.innerHTML = '';
    // Loop over starting values and calculate ending values
    for (let celsius = start; celsius <= end; celsius +=increment) {
        // Farenheit to Celsius conversion
        const farenheit = (celsius * 9/5) + 32;
        // Create a new row for each loop
        const row = document.createElement('tr');
        // Create new <td>'s with values - one significant figure
        row.innerHTML = `
            <td>${celsius}</td>
            <td>${farenheit.toFixed(1)}</td> 
        `;
        // Append these rows to the tbody
        tbody.appendChild(row);
    }
}

// Wait for DOM to load before adding event listener
window.addEventListener('DOMContentLoaded', () => {
    // Listen for the click event before calling readCSV()
    document.getElementById('render-button').addEventListener('click', readCSV);
});