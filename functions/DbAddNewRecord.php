

<?php

require_once('config\config.php');

//ochrona przed zdublowaniem wysłania polecenia
$_SESSION['postdata'] = $_POST;
unset($_POST);

//// Dodawanie rekordu do DB
$stmt = $conn->prepare("INSERT INTO `data` (`ID`, `imie`, `nazwisko`, `telefon`, `email`, `tresc`, `data_utworzenia`) VALUES (NULL, ? , ? , ? , ? , ? , current_timestamp());");
$stmt->bind_param("sssss", $_SESSION['postdata']['imie'], $_SESSION['postdata']['nazwisko'], $_SESSION['postdata']['telefon'], $_SESSION['postdata']['email'], $_SESSION['postdata']['tresc']);

if($stmt->execute()) $_SESSION['sent'] = 1;

header('location: index.php');



?>