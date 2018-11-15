<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = NULL;
$dbname = "scoreboard";
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}
?>