<?php

// debug mode
error_reporting(0);
////////////////////
session_start();
// Konfigruacja DB

     $serverName = "localhost";
     $userName = "root";
     $pass = "";
     $dbName = "we";

// Połączenie z DB
require_once ("functions\DbConnect.php");


?>