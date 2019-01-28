<?php
require "globalassets/dbinit.php";
$sql = "SELECT misc from events where id = ". $_GET["id"];
$result = $conn->query($sql);
$rootobj = $result->fetch_assoc();
$rootobj = json_decode($rootobj["misc"], true);
echo json_encode($rootobj["timer"], true);
?>