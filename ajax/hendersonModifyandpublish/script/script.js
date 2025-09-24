// Load Amendments once DOM loads
document.addEventListener('DOMContentLoaded', () => {
    loadAmendments();
});

// Make Ajax request for json data
const loadAmendments = () => {
    // New xhr object declaration
    const xhr = new XMLHttpRequest();
    // Event listener for Ajax request
    xhr.onreadystatechange = () => {
        // Check to see if request is complete
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // Check to see if request was successful
            if (xhr.status === 200) {
                try {
                    // Try to parse the response
                    const data = JSON.parse(xhr.responseText);
                    // Render this data on the site
                    displayAmendments(data.amendments);
                } 
                
                catch (error) {
                    // If error while parsing, handle error
                    console.warn('Error parsing amendment data');
                }
            } 
            // If request is not sucessful, handle HTTP error
            else {
                console.warn('Error loading amendments');
            }
        }
    };

    // Organize GET request to amendments.json
    xhr.open('GET', 'data/amendments.json', true);
    // Send the organized request
    xhr.send();
}

// Create and append collected data in HTML elements
function displayAmendments(amendments) {
    // Select the amendments container (append here)
    const container = document.getElementById('amendments-container');
    // Remove current child elements
    container.innerHTML = '';
    // Loop over all objects inside parsed amendments.json - Each object will get it's own element
    amendments.forEach((amendment, index) => {
        // Create new section element
        const amendmentSection = document.createElement('section');
        // Add .amendment class to our new element
        amendmentSection.className = 'amendment';
        // Assign amendmentSection innerHTML with amendment data
        amendmentSection.innerHTML = `
            <h2>Amendment ${amendment.number}</h2>
            <h3>${amendment.title}</h3>
            <p class="amendment-text">${amendment.text}</p>
            <p class="ratified-date">Ratified: ${amendment.ratified}</p>
        `;
        // Append completed element to selected container
        container.appendChild(amendmentSection);
    });
}

// Render error message if needed
function displayError(message) {
    // Select the amendments container
    const container = document.getElementById('amendments-container');
    // Replace any child elements with an error handling section
    container.innerHTML = `<section class="error">${message}</section>`;
}