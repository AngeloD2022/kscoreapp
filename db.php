<?php
$hostname = "localhost";
$dbuname = "root";
$dbpw = NULL;
$database = "scoreboard";
$conn = new mysqli($hostname, $dbuname, $dbpw, $database);
if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}

?>