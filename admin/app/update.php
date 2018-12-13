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
    }else
    {
        $read = "SELECT misc from events where id=". $gameId ." and usrID=".$authBack["id"];
        $readR = $conn->query($read);
        $readArr = $readR->fetch_array();
        $MiscArr = json_decode($readArr[0], true);
        echo "\nuid:".$authBack["id"];
        echo "\ngid:".$content["id"];

        foreach($content as $key => $val){
            echo $key."::".(is_array($val) ? print_r($val, true) : $val)."";

            if($key == "misc"){    
                //Create array of previous miscellaneous values
                foreach($content["misc"] as $mk => $mv){
                    $MiscArr[$mk] = $mv;
                }
            }
            if($key != "id" && $key != "uid" && $key != "misc"){
                $sql = "UPDATE `events` SET `".$key."` = '".$val."' WHERE `events`.`id` = ".$gameId." and `events`.`usrID` = ".$authBack["id"]."";
                $result = $conn->query($sql);
            }
        }
        if(isset($content["misc"])){
            $encoded = json_encode($MiscArr);
            $sql = "UPDATE `events` SET `misc` = '". $encoded ."' WHERE `events`.`id` = ".$gameId." and `events`.`usrID` = ".$authBack["id"]."";
            $result = $conn->query($sql);
        }
    }

    
    
    

?>