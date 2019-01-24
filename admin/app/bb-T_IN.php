<?php
$jdata = file_get_contents("php://input");
$content = json_decode($jdata, true);
$gameId = $content["id"];
require "globalassets/dbinit.php";
require "globalassets/authentication.php";
$authBack = authenticate();
$MiscArr;
if(!isset($authBack)){
    $authBack = "x";
}else{
    $read = "SELECT misc from events where id=". $gameId ." and usrID=".$authBack["id"];
    $readR = $conn->query($read);
    $readArr = $readR->fetch_array();
    $MiscArr = json_decode($readArr[0], true);

    //MISC->TIMER -- VALUES
    $timer["startedat"] = time();
    $timer["startValue"] = $content["startValue"];
    $timer["currentState"] = $content["currentState"];


    $MiscArr["timer"] = $timer;
    $encoded = json_encode($MiscArr, true);

    $sql = "UPDATE `events` SET `misc` = '". $encoded ."' WHERE `events`.`id` = ".$gameId." and `events`.`usrID` = ".$authBack["id"]."";
    $conn->query($sql);

    echo("Success");
}



?>