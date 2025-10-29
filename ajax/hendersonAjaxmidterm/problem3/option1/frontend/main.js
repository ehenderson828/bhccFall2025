// Function to fetch quote for a specific author
const getQuoteByAuthor = (authorSlug, authorName) => {
    // Create new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    // Event listener for Ajax request
    xhr.onreadystatechange = () => {
        // Check if request is complete
        if (xhr.readyState === XMLHttpRequest.DONE) {
            // Check if request was successful
            if (xhr.status === 200) {
                try {
                    // Parse JSON response
                    const data = JSON.parse(xhr.responseText);
                    // Check if quotes (and multiple) exist for this author
                    if (data[authorSlug] && data[authorSlug].length > 0) {
                        // Get a random quote from the array
                        const quotes = data[authorSlug];
                        const randomIndex = Math.floor(Math.random() * quotes.length);
                        const quoteText = quotes[randomIndex];
                        // Call displayQuote
                        displayQuote(authorSlug, quoteText, authorName);
                    } 
                    else {
                        alert('No quotes found for this author.');
                    }
                } 
                catch (error) {
                    alert('Error parsing response: ' + error.message);
                }
            } 
            else {
                alert('Error: ' + xhr.status + xhr.statusText);
            }
        }
    }
    // Open GET request to local quotes JSON file
    xhr.open('GET', 'data/quotes.json', true);
    // Send request
    xhr.send();
}

// Render author, quote and image
const displayQuote = (authorSlug, quoteText, authorName) => {
    // Get elements where we're rendering our data
    const authorInfo = document.getElementById('author-info');
    const authorImage = document.getElementById('author-image');
    const quoteTextElement = document.getElementById('quote-text');
    // Set image source (using local images from assets folder)
    authorImage.src = `assets/${authorSlug}.jpg`;
    authorImage.alt = `${authorName} portrait`;
    // Set quote text
    quoteTextElement.textContent = `"${quoteText}"`;
    // Show the quote display section
    authorInfo.classList.remove('hidden');
}

// Add event listeners to each author name - collect selection attributes
const setupAuthorClickHandlers = () => {
    // Get all author elements
    const authorElements = document.querySelectorAll('.author');
    // Add click event listener to each author
    authorElements.forEach((authorElement) => {
        authorElement.addEventListener('click', () => {
            const authorSlug = authorElement.getAttribute('data-author');
            const authorName = authorElement.textContent;
            // Make GET request for each quote for clicked author
            getQuoteByAuthor(authorSlug, authorName);
        });
        // Add hover effect (make cursor pointer)
        authorElement.style.cursor = 'pointer';
    });
};

// Add close button logic for rendered quote card
const setupCloseButton = () => {
    // Get close button element
    const closeBtn = document.getElementById('close-btn');
    // Add click event listener to hide author info
    closeBtn.addEventListener('click', () => {
        const authorInfo = document.getElementById('author-info');
        authorInfo.classList.add('hidden');
    });
};

// Wait for DOM to load before setting up event listeners
window.addEventListener('DOMContentLoaded', () => {
    setupAuthorClickHandlers();
    setupCloseButton();
});