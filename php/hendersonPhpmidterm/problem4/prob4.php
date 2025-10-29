<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- External CSS import -->
        <link rel="stylesheet" href="styles/main.css">
        <title>PHP Midterm - Problem 4</title>
    </head>
    <body>
        <div class="container">
            <h1>SQL Query Analysis - Problem 4</h1>
            <div class="sql-query">
                <h2>SQL Expression:</h2>
                <pre>
                    <code>
                        Select id, last, substr(first,1,1) as FI, street, zip
                        from tableA
                        where substr(first,1,1) >= 'h'
                        order by last;
                    </code>
                </pre>
            </div>
            <div class="explanation">
                <h2>Explanation:</h2>
                <p>This SQL query retrieves specific columns from a database table and filters the results based on the first letter of a person's first name, then sorts the output alphabetically by last name.</p>
                <h3>Breakdown by Clause:</h3>
                <div class="section">
                    <h4>1. SELECT Clause:</h4>
                    <ul>
                        <li><strong>id</strong> - Retrieves the ID column (likely a primary key or unique identifier)</li>
                        <li><strong>last</strong> - Retrieves the last name column</li>
                        <li><strong>substr(first,1,1) as FI</strong> - Extracts the first character from the 'first' name column using the SUBSTR() function and aliases it as "FI" (First Initial). The parameters (1,1) mean: start at position 1, extract 1 character</li>
                        <li><strong>street</strong> - Retrieves the street address column</li>
                        <li><strong>zip</strong> - Retrieves the zip code column</li>
                    </ul>
                </div>
                <div class="section">
                    <h4>2. FROM Clause:</h4>
                    <ul>
                        <li><strong>tableA</strong> - Specifies the source table from which data is being retrieved</li>
                    </ul>
                </div>
                <div class="section">
                    <h4>3. WHERE Clause:</h4>
                    <ul>
                        <li><strong>substr(first,1,1) >= 'h'</strong> - Filters the results to include only records where the first character of the first name is 'h' or later in the alphabet (h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z)</li>
                        <li>This condition excludes anyone whose first name starts with letters a through g</li>
                        <li>The comparison is case-sensitive depending on the database collation settings</li>
                    </ul>
                </div>
                <div class="section">
                    <h4>4. ORDER BY Clause:</h4>
                    <ul>
                        <li><strong>order by last</strong> - Sorts the results alphabetically by the last name column in ascending order (A to Z)</li>
                    </ul>
                </div>
                <h3>Summary:</h3>
                <p>This query is seeking to retrieve contact information (ID, last name, first initial, street address, and zip code) for all individuals in tableA whose first name begins with the letter 'h' or any letter that comes after 'h' in the alphabet, with results organized alphabetically by last name.</p>
            </div>
        </div>
    </body>
</html>