<?php
require "globalassets/dbinit.php";
$sql = "SELECT homeScore, oppScore, misc from events where id = ". $_GET["id"];
$result = $conn->query($sql);
echo json_encode($result->fetch_assoc(), true);
?>