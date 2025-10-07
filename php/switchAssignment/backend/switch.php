<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Recommendation</title>
    <!-- External CSS import -->
    <link rel="stylesheet" href="../styles/main.css">
</head>
<body>
    <header>
        <h1>Weather-Based Activity Planner</h1>
    </header>

    <div class="weather-card">
        <!-- Switch statement -->
        <?php
            // Get the temperature response from the user - if no selection, use default
            $temp = $_GET['temps'] ?? 'default';
            // Switch start
            switch ($temp) {
                case 'below0':
                    $activity = "❄️🥶 Far too cold! Bundle up with hot cocoa and a nice blanket. Outdoor activities are not advised";
                    break;
                case '0-20':
                    $activity = "🧊☃️ Very cold - limit your time outdoors. If you must go outside, bundle up with several layers";
                    break;
                case '20-32':
                    $activity = "⛷️🎿 Cold weather fun! Perfect for skiing, snowboarding, or sledding. Don't forget your winter gear!";
                    break;

                case '32-45':
                    $activity = "🧥🍂 Chilly but manageable. Great for a brisk walk, jogging, or visiting outdoor markets with a warm jacket.";
                    break;

                case '45-60':
                    $activity = "🚴📸 Comfortable weather! Ideal for hiking, biking, or outdoor photography. Light jacket recommended.";
                    break;

                case '60-70':
                    $activity = "🌤️🧺 Perfect conditions! Enjoy picnics, outdoor sports, gardening, or just relaxing in the park.";
                    break;

                case '70-80':
                    $activity = "☀️🏖️ Beautiful weather! Swimming, beach trips, barbecues, and outdoor concerts are all great options.";
                    break;

                case '80-90':
                    $activity = "🏊💦 Hot! Head to the pool, beach, or water park. Stay hydrated and seek shade during peak hours.";
                    break;

                case '90-100':
                    $activity = "🔥😓 Very hot - plan activities for early morning or evening. Indoor activities with AC might be better!";
                    break;

                case 'above100':
                    $activity = "🌡️🚨 Dangerously hot! Stay indoors with air conditioning. If you must go out, it should be brief and with plenty of water.";
                    break;

                default:
                    $activity = "🤔 Please select a temperature range to get activity recommendations.";
                    break;
            }
            // Switch end

            // Echo the chosen activity that aligns with the chosen option
            echo "<h2>Recommended Activity</h2>";
            echo "<p>$activity</p>";
        ?>
        <!-- Button to return to the prior form -->
        <a href="../index.html">
            <button type="button" class="back-button">Choose Different Temperature</button>
        </a>
    </div>
</body>
</html>
