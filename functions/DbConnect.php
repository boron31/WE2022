<?php

/// Nawiązuję połaczenie z DB

     $conn = new mysqli($serverName, $userName, $pass, $dbName);
    
     if ($conn->connect_error) {
        die("Błąd przy połączeniu z bazą danych. " . $conn->connect_error);
       };

       $conn->query($sql);


?>