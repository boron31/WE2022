

<?php

require_once('config\config.php');

////// Sprawdzam czy tabele w DB są utworzone //////

$exist = "SELECT * FROM Config";

if ($result = $conn->query($exist)) {
    while ($row = $result->fetch_assoc()) {
        if ($row['exist'] == 1) {
            $_SESSION['exist'] = $row['exist'];
        }
    }
}


//// Jeżeli nie, to tworzę tabele w DB

if (!isset($_SESSION['exist'])) {

    /// Tworzenie tabel przechowywującej dane z formularza


    $dbCreateTabData = "CREATE TABLE data( `ID` INT NOT NULL AUTO_INCREMENT , `imie` VARCHAR(30) NOT NULL , `nazwisko` VARCHAR(30) NOT NULL , `telefon` VARCHAR(30) NOT NULL , `email` VARCHAR(30) NOT NULL , `tresc` VARCHAR(100) NOT NULL , `data_utworzenia` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`ID`))";
    $conn->query($dbCreateTabData);

    ///Utworzenie tabeli pomocniczej

    $dbCreateTabConfig = "CREATE TABLE Config ( `exist` INT NOT NULL DEFAULT '1' , `utworzony` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
    $conn->query($dbCreateTabConfig);

    $dbSetVarToConf = "INSERT INTO Config (`exist`, `utworzony`) VALUES ('1', current_timestamp())";
    $conn->query($dbSetVarToConf);

    $_SESSION['exist'] = 1;
}


?>