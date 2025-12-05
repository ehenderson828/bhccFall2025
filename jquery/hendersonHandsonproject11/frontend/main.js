// Once document has loaded:
$(document).ready(function() {
    // Loading text::
        // Start by selecting the load text button
        $('#loadText').click(function() {
            // Append the response from this request to the #output container
            $('#output').load('jQuery_Ajax/text.txt');
        });

    // Loading HTML::
        // Start by selecting the load html button
        $('#loadHtml').click(function() {
            // Load and append result to the #output container
            $('#output').load('jQuery_Ajax/snippet.html');
        });

    // Loading XML::
        // Start by selecting the load XML button
        $('#loadXml').click(function() {
            // Load and append resulkt to the #output container
            $('#output').load('jQuery_Ajax/portfolio.xml');
        });
});