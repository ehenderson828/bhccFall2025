<?php 
    // Array with names
    $a[] = "Anna";
    $a[] = "Brittany";
    $a[] = "Cinderella";
    $a[] = "Diana";
    $a[] = "Eva";
    $a[] = "Fiona";
    $a[] = "Gunda";
    $a[] = "Hege";
    $a[] = "Inga";
    $a[] = "Johanna";
    $a[] = "Kitty";
    $a[] = "Linda";
    $a[] = "Nina";
    $a[] = "Ophelia";
    $a[] = "Petunia";
    $a[] = "Amanda";
    $a[] = "Raquel";
    $a[] = "Cindy";
    $a[] = "Doris";
    $a[] = "Eve";
    $a[] = "Evita";
    $a[] = "Sunniva";
    $a[] = "Tove";
    $a[] = "Unni";
    $a[] = "Violet";
    $a[] = "Liza";
    $a[] = "Elizabeth";
    $a[] = "Ellen";
    $a[] = "Wenche";
    $a[] = "Vicky";
    // Get the q parameter from URL
    $q = $_REQUEST["q"];
    // Declaration of hint string to store matching response(s)
    $hint = "";
    // Check to see if the query is not empty
    if ($q !== "") {
        // Convert $q to lowercase - case-insensitive matching
        $q = strtolower($q);
        // Calculate the length of $q
        $len = strlen($q);
        // Loop through the $a array
        foreach ($a as $name) {
            // Check if query matches the beginning of the name
            if (stristr($q, substr($name, 0, $len))) {
                // If hint is empty
                if ($hint === "") {
                    // Add first match without a comma
                    $hint = $name;
                } 
                // Otherwise
                else {
                    // Append names with comma separator
                    $hint .= ", $name";
                }
            }
        }
    }
    // Output "no suggestion" if no hint was found or output correct values
    echo $hint === "" ? "no suggestion" : $hint;
?>