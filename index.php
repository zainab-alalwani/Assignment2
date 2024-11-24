<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define the URL for the API to fetch student nationality data
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch the data from the API
$response = file_get_contents($url);

// Check if the response is false, indicating an error
if ($response === FALSE) {
    die('Error occurred while fetching data.'); // Stop execution if there's an error
}

// Decode the JSON response into a PHP associative array
$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://unpkg.com/pico.css"> <!-- Link to external CSS for styling -->
    <style>
        /* Custom styles for the table */
        table {
            width: 100%; /* Make the table full width */
            margin-top: 20px; /* Add margin above the table */
        }
        th, td {
            padding: 10px; /* Add padding for table cells */
            text-align: left; /* Align text to the left */
        }
    </style>
</head>
<body>
    <h1>UOB Student Nationality Data</h1> <!-- Main heading for the page -->

    <!-- HTML Table to Display Data -->
    <table>
        <thead>
            <tr>
                <th>Year</th> <!-- Column header for Year -->
                <th>Semester</th> <!-- Column header for Semester -->
                <th>Nationality</th> <!-- Column header for Nationality -->
                <th>Number of Students</th> <!-- Column header for Number of Students -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each record in the data array
            foreach ($data['results'] as $record) {
                // Output a table row for each record
                echo "<tr>
                        <td>{$record['year']}</td>
                        <td>{$record['semester']}</td>
                        <td>{$record['nationality']}</td>
                        <td>{$record['number_of_students']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>