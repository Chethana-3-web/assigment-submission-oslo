<?php
// load_submissions.php
header('Content-Type: application/json');

// Path to the CSV file
$csvFile = 'submissions.csv';
$data = [];

// Open the file in read mode
if (($handle = fopen($csvFile, "r")) !== false) {
    // Skip the header row
    fgetcsv($handle, 1000, ",");

    // Read each row in the CSV
    while (($row = fgetcsv($handle, 1000, ",")) !== false) {
        $data[] = [
            'group' => $row[0],
            'start_date' => $row[1],
            'end_date' => $row[2],
            'link' => $row[3]
        ];
    }
    fclose($handle);
}

// Output the data as JSON
echo json_encode($data);
