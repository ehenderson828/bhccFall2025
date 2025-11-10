// Run the following script once the document has loaded:
$(document).ready( () => {
    // Variable assignment for my Open Weather api key
	const apiKey = '0b29a16d36052f3475dc127e3cd533aa';

    // Set focus on city input when page loads
    $('#cityInput').focus();

    // Get weather function declaration
    const getWeather = (event) => {
        // Prevent form from submitting and reloading the page
        event.preventDefault();
        // Assign the value of the city input to a variable
        let city = $('#cityInput').val();
        // Interpolate the city and apiKey variables into the Open Weather url
        const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=imperial&appid=${apiKey}`;
        // Test to see if the user has provided a city name
        if (city) {
            // Fetch the Open Weather data as a JSON object
            $.getJSON(url, (data) => {
                // Log this object in the console
                console.log(data);
                // Selected city and country
                $('.selected-city').text(`${data.name}, ${data.sys.country}`);
                // Render current conditions
                $('.weather').text(data.weather[0].description);
                // Render current temp 
                $('.temp').html(`<span class='temp-label'>Temperature: </span> ${data.main.temp}°F`);
                // Render the feels-like temperature
                $('.feels-like').html(`<span class='feels-like-label'>Feels like: </span> ${data.main.feels_like}°F`);
                // Render current condition icon
                $('.icon').attr('src', `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`);
                // Hide the input from the user post submission
                $('#weatherForm').hide();
                // Show the Go Back button
                $('#goBackButton').show();
            })
            // Error handling
            .fail((jqXHR, textStatus, errorThrown) => {
                // If an error is encountered, alert the user
                alert('Error fetching weather data. Please check the city name and try again.');
                console.error('Error:', jqXHR, textStatus, errorThrown);
            });
        }
        // If a city name has not been provided, alert the user
        else {
            alert('Please enter a city name before submitting');
        }
    }
    // Have the form listen for a submit event and call getWeather()
    $('#weatherForm').on('submit', getWeather);

    // Go Back button click event
    $('#goBackButton').on('click', () => {
        // Show the form again
        $('#weatherForm').show();
        // Hide the Go Back button
        $('#goBackButton').hide();
        // Clear weather data
        $('.selected-city').text('');
        $('.weather').text('');
        $('.temp').html('');
        $('.feels-like').html('');
        $('.icon').attr('src', '');
        // Clear the input field
        $('#cityInput').val('');
        // Set focus back to city input
        $('#cityInput').focus();
    });
});
