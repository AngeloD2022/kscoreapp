<?php
require "globalassets/dbinit.php";
require "globalassets/authentication.php";
$gameId = $_GET["id"];
$authBack = authenticate();

if(isset($authBack)){
    $sql = "UPDATE `events` SET `active` = '1' WHERE `events`.`id` = ".$gameId." and `events`.`usrID` = ".$authBack["id"]."";
    $conn->query($sql);
    echo("success");
}

?>