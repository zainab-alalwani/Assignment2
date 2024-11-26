<?php

// Save the URL for the API
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch the data from the API
$response = file_get_contents($url);

// Check for error
if ($response === false) {
    die('Error while fetching data'); 
}

// Decode the JSON response into an array
$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head>
<link
  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
    <h1>UOB Student Nationality Data</h1>

    <table>
        <thead>
            <tr>
                <th>Year</th> 
                <th>Semester</th> 
                <th>The Programs</th>
                <th>Nationality</th>
                <th>Colleges</th>
                <th>Number of Students</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through each record in the data array
            foreach ($data['results'] as $record) {
                
                echo "<tr>
                        <td>{$record['year']}</td>
                        <td>{$record['semester']}</td>
                        <td>{$record['the_programs']}</td>
                        <td>{$record['nationality']}</td>
                        <td>{$record['colleges']}</td>
                        <td>{$record['number_of_students']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>