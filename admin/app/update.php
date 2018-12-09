<?php
    
    $jdata = file_get_contents("php://input");
    $content = json_decode($jdata, true);
    $gameId = $content["id"];
    require "globalassets/dbinit.php";
    require "globalassets/authentication.php";
    $authBack = authenticate();
    if(!isset($authBack)){
        $authBack = "x";
    }else
    {
        echo "\nuid:".$authBack["id"];
        echo "\ngid:".$content["id"];
        foreach($content as $key => $val){
            if($key != "id" && $key != "uid" && $key != "misc"){
                echo $key."::".$val."";
                // $sql = "SELECT * from events where usrID=".$authBack["id"]." and id=".$event;
                if(gettype($val) == "string"){
                    $sql = "UPDATE `events` SET `".$key."` = '".$val."' WHERE `events`.`id` = ".$gameId." and `events`.`usrID` = ".$authBack["id"]."";
                }else{
                    $sql = "UPDATE `events` SET `".$key."` = ".$val." WHERE `events`.`id` = ".$gameId." and `events`.`usrID` = ".$authBack["id"]."";
                }
                $result = $conn->query($sql);
                if($key === "id" || $key === "uid"){
                    echo "I am an idiot and not supposed to be counting this as a change. I should stop\n";
                }
                
            }
        }
        if(isset($content["misc"])){
            $encoded = json_encode($content["misc"]);
            $sql = "UPDATE `events` SET `misc` = '". $encoded ."' WHERE `events`.`id` = ".$gameId." and `events`.`usrID` = ".$authBack["id"]."";
            $result = $conn->query($sql);
        }
    }

    
    
    

?>