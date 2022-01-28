<?php

require_once('config\config.php');

/// Pobieranie i zapisywanie danych z BD do pliku.

$sql = "SELECT * FROM data";
$stmt = $conn->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();

if ($row_cnt = $result->num_rows > 0) {

    $f = fopen('export\dane.csv', 'w');

    while ($row = $result->fetch_assoc()) {
       
        fputcsv($f, $row, ";");
    }

    fclose($f);

    $download_button = "<a class='btn-download' href='export\dane.csv'>Pobierz</a>";
}
?>