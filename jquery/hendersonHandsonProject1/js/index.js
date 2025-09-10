// Using jQuery to change the color of the h1 tag from black to green:
$("h1").css("color", "green");

// Make the width of the <h1> smaller, as to not trigger the next event too easily:
$("h1").addClass("heading");

// Using jQuery to warn the user after they have hovered over the heading:
$("h1").hover(function () {
    alert("This is my first jQuery project");
    // I've learned that hover() takes two arguments:
    }, function() {
        console.warn("You are no longer hovering over the heading");
    } 
);