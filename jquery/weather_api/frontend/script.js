// Function to fetch weather data
function fetchWeatherData() {
    // Fetch data from the OpenWeather API
    $.getJSON("http://api.openweathermap.org/data/2.5/forecast?q=Boston&units=imperial&appid=b09ddd21de304bbacbbaf4315b5d2e99", (data) => {
        // Log the response object
        console.log(data);
        // Access the city property from said response
        var city = data.city.name;
        // Access the current weather icon
        var icon = "http://openweathermap.org/img/w/" + data.list[0].weather[0].icon + ".png";
        // Access the current temperature property
        var temp = Math.floor(data.list[0].main.temp);
        // Access the current weather conditions property
        var weather = data.list[0].weather[0].main;

        // Clear and append the selected city property to the DOM
        $('.city').empty().append(city);
        // Append the icon to the DOM by adding an src attribute
        $('.icon').attr("src", icon);
        // Clear and append the current conditions to the DOM
        $('.weather').empty().append('Local Conditions: ', weather);
        // Clear and append the current temperature to the DOM
        $('.temp').empty().append('Temperature: ', temp);

        // Remove previous temperature classes
        $('.temp').removeClass('temp_warm temp_hot');

        // Check for temp range:
        if (temp >= 80) {
            // If temp is 80° or over, render red text
            $('.temp').addClass('temp_hot');
        }
        else if (temp >= 60) {
            // If temp is 60° or over, render yellow text
            $('.temp').addClass('temp_warm');
        }
    });
}

// Call immediately on page load
fetchWeatherData();

// Call every 2 minutes (120000 milliseconds)
setInterval(fetchWeatherData, 120000, () => {
    console.log('Page refreshed');
});