// Get and read XML doc:
const getXML = () => {
    // New xhr object declaration
    const xhr = new XMLHttpRequest();
    // Event listener for Ajax request
    xhr.onreadystatechange = () => {
        // Check to see if request was successful
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // Check to see iof request was successful
            if (xhr.status === 200) {
                // Format response and create table
                try {
                    // Store XML response in a variable
                    xmlFile = xhr.responseXML;
                    // Get all CD elements, and their child elements
                    const cds = xmlFile.getElementsByTagName('CD');
                    // Count all cds, used for footer
                    const cdCount = cds.length;
                    // Call createTable method
                    createTable(cds, cdCount);
                }
                // If error while making connection
                catch (error) {
                    alert('Error: ' + xhr.status);
                }
            }
            // If request is not finished, alert user
            else {
                alert('Error: ' + xhr.status + ' - ' + xhr.statusText);
            }
        }
    }
    // GET request
    xhr.open('GET', 'data/cd_catalog.xml', true);
    // Send request
    xhr.send();
}

// Create table method
const createTable = (cds, cdCount) => {
    // Select table body to append to
    const tbody = document.querySelector('.table-body');
    // Clear the contents of this container
    tbody.innerHTML = '';
    // Loop over all elements from the xhr response
    for (let i = 0; i < cds.length; i++) {
        // Loop over each element, and assign their text content to variables
        const title = cds[i].getElementsByTagName('TITLE')[0].textContent;
        const artist = cds[i].getElementsByTagName('ARTIST')[0].textContent;
        const country = cds[i].getElementsByTagName('COUNTRY')[0].textContent;
        const company = cds[i].getElementsByTagName('COMPANY')[0].textContent;
        const price = cds[i].getElementsByTagName('PRICE')[0].textContent;
        const year = cds[i].getElementsByTagName('YEAR')[0].textContent;
        // Create a new row for each loop
        const row = document.createElement('tr');
        // Create new table data with collected values
        row.innerHTML = `
            <td>${title}</td>
            <td>${artist}</td>
            <td>${country}</td>
            <td>${company}</td>
            <td class="price-cell">${price}</td>
            <td>${year}</td>
        `;
        // Append these rows to the table body
        tbody.appendChild(row);
    }
    // Select the table footer
    const footer = document.querySelector('.table-footer');
    // Clear footer content
    footer.innerHTML = '';
    // Create new table row and data
    const footerRow = document.createElement('tr');
    const footerCell = document.createElement('td');
    // Have newly created cell span entire table
    footerCell.colSpan = 6;
    // Set the text content inside the cell
    footerCell.textContent = `Total CDs in Collection: ${cdCount}`;
    // Add styling class
    footerCell.classList.add('footer-total');
    // Append the new cell to the new row
    footerRow.appendChild(footerCell);
    // Append this row to the table footer
    footer.appendChild(footerRow);
}

// Wait for the DOM to load before adding event listener
window.addEventListener('DOMContentLoaded', () => {
    // Listen for the click before calling getXML
    document.querySelector('.render-button').addEventListener('click', getXML);
});