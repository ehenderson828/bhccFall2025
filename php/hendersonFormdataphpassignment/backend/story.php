<!-- Capture all input responses -->
<?php
    // htmlspecialchars() call to prevent unwanted characters
    $firstName1 = htmlspecialchars($_POST['firstName1']);
    $firstName2 = htmlspecialchars($_POST['firstName2']);
    $firstName3 = htmlspecialchars($_POST['firstName3']);
    $location1 = htmlspecialchars($_POST['location1']);
    $location2 = htmlspecialchars($_POST['location2']);
    $adjective1 = htmlspecialchars($_POST['adjective1']);
    $adjective2 = htmlspecialchars($_POST['adjective2']);
    $object1 = htmlspecialchars($_POST['object1']);
    $object2 = htmlspecialchars($_POST['object2']);
    $object3 = htmlspecialchars($_POST['object3']);
    $verb1 = htmlspecialchars($_POST['verb1']);
    $verb2 = htmlspecialchars($_POST['verb2']);
    $verb3 = htmlspecialchars($_POST['verb3']);
    $adverb = htmlspecialchars($_POST['adverb']);
    $professor = htmlspecialchars($_POST['professor']);
?>

<!-- Story to render -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Fonts Import -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- External CSS import -->
    <link rel="stylesheet" href="../styles/main.css?v=2">
    <!-- Favicon -->
    <link rel="icon" href="../assets/favicon.png" type="image/png">
    <title>Your BHCC Story</title>
</head>
<body>
    <h1>My First Day at BHCC</h1>
    <section class="story">
        <p>
            On my first day at BHCC, I woke up feeling <span class="user-input"><?php echo $adjective1; ?></span>.
            I grabbed my <span class="user-input"><?php echo $object1; ?></span> and headed to <span class="user-input"><?php echo $location1; ?></span>
            to meet my friend <span class="user-input proper-noun"><?php echo $firstName1; ?></span>.
        </p>
        <p>
            When I arrived at campus, the building looked <span class="user-input"><?php echo $adjective2; ?></span>.
            I had to <span class="user-input"><?php echo $verb1; ?></span> <span class="user-input"><?php echo $adverb; ?></span> to find my classroom.
            Along the way, I bumped into <span class="user-input proper-noun"><?php echo $firstName2; ?></span> who was carrying
            a <span class="user-input"><?php echo $object2; ?></span>.
        </p>
        <p>
            Finally, I found my class at <span class="user-input"><?php echo $location2; ?></span>. Professor <span class="user-input proper-noun"><?php echo $professor; ?></span>
            greeted us warmly. During the lesson, we learned how to <span class="user-input"><?php echo $verb2; ?></span>
            using a <span class="user-input"><?php echo $object3; ?></span>. My classmate <span class="user-input proper-noun"><?php echo $firstName3; ?></span>
            helped me <span class="user-input"><?php echo $verb3; ?></span> the assignment.
        </p>
        <p>
            It was definitely a memorable first day at BHCC!
        </p>
        <!-- Link to input page -->
        <a href="../index.html" class="reset-button">Create Another Story</a>
</section>
</body>
</html>
