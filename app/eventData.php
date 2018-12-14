<?php
require "globalassets/dbinit.php";
$sql = "SELECT homeScore, oppScore, misc from events where id = ". $_GET["id"];
$result = $conn->query($sql);
$rootobj = $result->fetch_assoc();
$rootobj["misc"] = json_decode($rootobj["misc"], true);
echo json_encode($rootobj);
?>