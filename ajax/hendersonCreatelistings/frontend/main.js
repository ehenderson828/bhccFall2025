// Global variables to store CSV data for each table
let baltimoreCSVData = [];
let ageCSVData = [];
let genderCSVData = [];

// Get and read XML doc method:
const getXML = (filterType) => {
    // New xhr object declaration
    const xhr = new XMLHttpRequest();   
    // Event listener for Ajax request
    xhr.onreadystatechange = () => {
        // Check to see if request was successful
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Filter response by filterType and call corresponding method
            try {
                // Store response in a variable
                const xmlFile = xhr.responseXML;
                // Get all customersOutXml tags
                const customers = xmlFile.getElementsByTagName('customersOutXml');
                // Call corresponding method
                switch (filterType) {
                    case 'baltimore':
                        createBaltimoretable(customers);
                        break;
                    case 'age':
                        createAgetable(customers);
                        break;
                    case 'gender':
                        createGendertable(customers);
                        break;
                }
            }
            // Catch errors and alert the user
            catch (error) {
                alert('Error: ' + error.message);
            }
        }
    }
    // GET request
    xhr.open('GET', 'input-data/customers.xml', true);
    // Send request
    xhr.send();
}

// Create North Baltimore Table method:
const createBaltimoretable = (customers) => {
    // Select table body to populate
    const tbody = document.querySelector('.baltimore-body');
    // Clear the content of this tbody
    tbody.innerHTML = '';
    // Reset global CSV data array
    baltimoreCSVData = [];
    // Loop over all of the elements from the xhr repsonse
    for (let i = 0; i < customers.length; i++) {
        // Loop over each city to later filter
        const city = customers[i].getElementsByTagName('City')[0].textContent;
        // Process only if city is 'North Baltimore'
        if (city === 'North Baltimore') {
            const custID = customers[i].getElementsByTagName('CustID')[0].textContent;
            const lastName = customers[i].getElementsByTagName('LastName')[0].textContent;
            const firstName = customers[i].getElementsByTagName('FirstName')[0].textContent;
            const state = customers[i].getElementsByTagName('State')[0].textContent;
            const gender = customers[i].getElementsByTagName('gender')[0].textContent;
            const dob = customers[i].getElementsByTagName('dob')[0]?.textContent || 'N/A'; // Optional chaining if value isn't there
            // Split the ISO date to remove the time:
            const dobDate = dob !== 'N/A' ? dob.split('T')[0] : 'N/A';
            const years = customers[i].getElementsByTagName('Yrs')[0]?.textContent || 'N/A'; // Optional chaining if value isn't there
            const age = customers[i].getElementsByTagName('Age')[0].textContent;
            // Push this looped data to the global CSV array
            baltimoreCSVData.push([custID, lastName, firstName, city, state, gender, dobDate, years, age]);
            // Create a new table row element
            const row = document.createElement('tr');
            // Create new data with the collected values
            row.innerHTML = `
                <td>${custID}</td>
                <td>${lastName}</td>
                <td>${firstName}</td>
                <td>${city}</td>
                <td>${state}</td>
                <td>${gender}</td>
                <td>${dobDate}</td>
                <td>${years}</td>
                <td>${age}</td>
            `;
            // Append these rows to the table body
            tbody.appendChild(row);
        }
    }
}

// Create age Table method:
const createAgetable = (customers) => {
    // Select table body to populate
    const tbody = document.querySelector('.age-body');
    // Clear the content of this tbody
    tbody.innerHTML = '';
    // Reset global CSV data array
    ageCSVData = [];
    // Loop over all of the elements from the xhr repsonse
    for (let i = 0; i < customers.length; i++) {
        // Loop over each age to later filter - while parsing age as an int & not a string
        const age = parseInt(customers[i].getElementsByTagName('Age')[0].textContent);
        // Process only if age is 'between 25 - 28'
        if (age >= 25 && age <= 28) {
            const custID = customers[i].getElementsByTagName('CustID')[0].textContent;
            const lastName = customers[i].getElementsByTagName('LastName')[0].textContent;
            const firstName = customers[i].getElementsByTagName('FirstName')[0].textContent;
            const city = customers[i].getElementsByTagName('City')[0].textContent;
            const state = customers[i].getElementsByTagName('State')[0].textContent;
            const gender = customers[i].getElementsByTagName('gender')[0].textContent;
            const dob = customers[i].getElementsByTagName('dob')[0]?.textContent || 'N/A'; // Optional chaining if value isn't there
            // Split the ISO date to remove the time:
            const dobDate = dob !== 'N/A' ? dob.split('T')[0] : 'N/A';
            const years = customers[i].getElementsByTagName('Yrs')[0]?.textContent || 'N/A'; // Optional chaining if value isn't there
            // Push this looped data to the global CSV array
            ageCSVData.push([custID, lastName, firstName, city, state, gender, dobDate, years, age]);
            // Create a new table row element
            const row = document.createElement('tr');
            // Create new data with the collected values
            row.innerHTML = `
                <td>${custID}</td>
                <td>${lastName}</td>
                <td>${firstName}</td>
                <td>${city}</td>
                <td>${state}</td>
                <td>${gender}</td>
                <td>${dobDate}</td>
                <td>${years}</td>
                <td>${age}</td>
            `;
            // Append these rows to the table body
            tbody.appendChild(row);
        }
    }
}

// Create gender Table method:
const createGendertable = (customers) => {
    // Select and clear table body to populate
    const tbody = document.querySelector('.gender-body');
    tbody.innerHTML = '';
    // Select and clear the table footer to populate with gender count
    const tfoot = document.querySelector('.gender-count');
    tfoot.innerHTML = '';
    // Reset global CSV data array
    genderCSVData = [];
    // Declare arrays to house both genders
    const femaleCustomers = [];
    const maleCustomers = [];
    // Loop over all of the elements from the xhr repsonse
    for (let i = 0; i < customers.length; i++) {
        // Loop over all customers by gender
        const gender = customers[i].getElementsByTagName('gender')[0].textContent;
        // Push female customers to their array
        if (gender === 'F') {
            femaleCustomers.push(customers[i]);
        }
        // Push male customers to their array
        else if (gender === 'M') {
            maleCustomers.push(customers[i]);
        }
    }
    // Render female customers first
    femaleCustomers.forEach((customer) => {
        const custID = customer.getElementsByTagName('CustID')[0].textContent;
        const lastName = customer.getElementsByTagName('LastName')[0].textContent;
        const firstName = customer.getElementsByTagName('FirstName')[0].textContent;
        const city = customer.getElementsByTagName('City')[0].textContent;
        const state = customer.getElementsByTagName('State')[0].textContent;
        const gender = customer.getElementsByTagName('gender')[0].textContent;
        const dob = customer.getElementsByTagName('dob')[0]?.textContent || 'N/A'; // Optional chaining if value isn't there
        // Split the ISO date to remove the time:
        const dobDate = dob !== 'N/A' ? dob.split('T')[0] : 'N/A';
        const years = customer.getElementsByTagName('Yrs')[0]?.textContent || 'N/A'; // Optional chaining if value isn't there
        const age = customer.getElementsByTagName('Age')[0].textContent;
        // Push this customer data to the global CSV array
        genderCSVData.push([custID, lastName, firstName, city, state, gender, dobDate, years, age]);
        // Create new row
        const row = document.createElement('tr');
        // Append data to that row
        row.innerHTML = `
            <td>${custID}</td>
            <td>${lastName}</td>
            <td>${firstName}</td>
            <td>${city}</td>
            <td>${state}</td>
            <td>${gender}</td>
            <td>${dobDate}</td>
            <td>${years}</td>
            <td>${age}</td>
        `;
        // Append this row to the gender tbody
        tbody.appendChild(row);
    });
    // Render male customers second
    maleCustomers.forEach((customer) => {
        const custID = customer.getElementsByTagName('CustID')[0].textContent;
        const lastName = customer.getElementsByTagName('LastName')[0].textContent;
        const firstName = customer.getElementsByTagName('FirstName')[0].textContent;
        const city = customer.getElementsByTagName('City')[0].textContent;
        const state = customer.getElementsByTagName('State')[0].textContent;
        const gender = customer.getElementsByTagName('gender')[0].textContent;
        const dob = customer.getElementsByTagName('dob')[0]?.textContent || 'N/A'; // Optional chaining if value isn't there
        // Split the ISO date to remove the time:
        const dobDate = dob !== 'N/A' ? dob.split('T')[0] : 'N/A';
        const years = customer.getElementsByTagName('Yrs')[0]?.textContent || 'N/A'; // Optional chaining if value isn't there
        const age = customer.getElementsByTagName('Age')[0].textContent;
        // Push this customer data to the global CSV array
        genderCSVData.push([custID, lastName, firstName, city, state, gender, dobDate, years, age]);
        // Create new row
        const row = document.createElement('tr');
        // Append data to that row
        row.innerHTML = `
            <td>${custID}</td>
            <td>${lastName}</td>
            <td>${firstName}</td>
            <td>${city}</td>
            <td>${state}</td>
            <td>${gender}</td>
            <td>${dobDate}</td>
            <td>${years}</td>
            <td>${age}</td>
        `;
        // Append this row to the gender tbody
        tbody.appendChild(row);
    });
    // Append the table footer with female and male counts
    tfoot.innerHTML = `
        <td colspan="3">Genders Counted:</td>
        <td colspan="3">Female: <span class="gender-count-value">${femaleCustomers.length}</span></td>
        <td colspan="3">Male: <span class="gender-count-value">${maleCustomers.length}</span></td>
    `;
}

// Send data to PHP to create CSV file
const createCSVFile = async (headers, rows, filename) => {
    try {
        // Make a post request to csvWriter.php
        const response = await fetch('backend/csvWriter.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' 
            },
            body: JSON.stringify({
                headers: headers,
                rows: rows,
                filename: filename
            })
        });
        // Convert response to json
        const result = await response.json();
        // Check to see if response is successful
        if (result.success) {
            // Log the result to the console
            console.log('CSV created', result.filename);
            // Reference the path to the created file for download
            window.location.href = `backend/csvDownload.php?file=${result.filename}`;
            return result;
        }
        // Else if there is an issue
        else {
            // Alert the user
            alert('Error created CSV file: ' + result.error);
            return null;
        }
    }
    // Catch error if issue contacting csvWriter.php
    catch (error) {
        // Alert the user
        alert('Error ' + error.message);
        console.error('CSV creation error:', error);
        return null;
    }
}

// Add event listeners to the filter button once document has loaded:
window.addEventListener('DOMContentLoaded', () => {
    // Listen and record the filterType that aligns with the button clicked
    document.querySelectorAll('button[data-filter]').forEach((button) => {
        button.addEventListener('click', (e) => {
            const filterType = e.target.dataset.filter;

            // Get the corresponding table section
            let targetSection;
            if (filterType === 'baltimore') {
                targetSection = document.querySelector('.baltimore-container');
            } else if (filterType === 'age') {
                targetSection = document.querySelector('.age-container');
            } else if (filterType === 'gender') {
                targetSection = document.querySelector('.gender-container');
            }

            // Check if the target section is currently visible
            const isCurrentlyVisible = targetSection.classList.contains('visible');

            // Hide all table sections
            document.querySelectorAll('.baltimore-container, .age-container, .gender-container').forEach((section) => {
                section.classList.remove('visible');
            });

            // Update all button texts to "Show..."
            document.querySelectorAll('button[data-filter]').forEach((btn) => {
                const type = btn.dataset.filter;
                if (type === 'baltimore') {
                    btn.textContent = 'Show North Baltimore Customers';
                } else if (type === 'age') {
                    btn.textContent = 'Show Customers Between the ages of 25 & 28';
                } else if (type === 'gender') {
                    btn.textContent = 'Show Customers Listed by Gender';
                }
            });

            // If the clicked section was not visible, show it and load data
            if (!isCurrentlyVisible) {
                targetSection.classList.add('visible');
                e.target.textContent = e.target.textContent.replace('Show', 'Hide');
                getXML(filterType);
            }
            // If it was visible, we already hid it above (toggle off)
        });
    });

    // Add event listeners for CSV download buttons
    document.querySelectorAll('.download-csv').forEach((button) => {
        button.addEventListener('click', async (e) => {
            const filename = e.target.dataset.csv;
            const headers = ['Customer ID', 'Last Name', 'First Name', 'City', 'State', 'Gender', 'DOB', 'Years', 'Age'];

            let data;
            // Determine which data to use based on filename
            if (filename.includes('baltimore')) {
                data = baltimoreCSVData;
                if (data.length === 0) {
                    alert('Please load the North Baltimore customers table first!');
                    return;
                }
            } else if (filename.includes('age')) {
                data = ageCSVData;
                if (data.length === 0) {
                    alert('Please load the Age 25-28 customers table first!');
                    return;
                }
            } else if (filename.includes('gender')) {
                data = genderCSVData;
                if (data.length === 0) {
                    alert('Please load the Gender customers table first!');
                    return;
                }
            }

            // Create and download the CSV file
            await createCSVFile(headers, data, filename);
        });
    });
});