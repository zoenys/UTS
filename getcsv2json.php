<?php

function csvToJson($csvUrl) {
    $csvData = [];
    
    if (($handle = fopen($csvUrl, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            $csvData[] = $row;
        }
        fclose($handle);
    }

    // Assuming the first row of the CSV contains the column headers
    $headers = array_shift($csvData);

    $jsonArray = [];

    foreach ($csvData as $row) {
        $jsonArrayItem = array();
        $i = 0;
        for ($i = 0; $i < count($headers); $i++) {
            $jsonArrayItem[$headers[$i]] = $row[$i];
        }
        $jsonArray[] = $jsonArrayItem;
    }

    return json_encode($jsonArray);
}

$csvUrl = 'https://testingalpro.alwaysdata.net/api/coffee.csv';
$jsonData = csvToJson($csvUrl);

// Set the content type to JSON
header('Content-Type: application/json');

// Output the JSON data
echo $jsonData;
?>
