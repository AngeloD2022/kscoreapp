<?php
require "globalassets/dbinit.php";
require "globalassets/authentication.php";
$authBack = authenticate();
$gameId = $_GET["id"];

$sql = "UPDATE `events` SET `finished` = 1, `active` = 0 WHERE `events`.`id` = ".$gameId." and `events`.`usrID` = ".$authBack["id"]."";
if(isset($authBack)){
    $result = $conn->query($sql);
    
    echo "success";
}
?>