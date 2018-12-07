<?php
    
    $jdata = file_get_contents("php://input");
    $content[] = json_decode($jdata, true);
    $gameId = $content[0]["id"];
    require "globalassets/dbinit.php";
    require "globalassets/authentication.php";
    $authBack = authenticate();
    if(!isset($authBack)){
        $authBack = "x";
    }
    
    else
    {
        foreach($content as $root){
            echo $key."::".$val."";
            if($key != "id" && $key != "uid"){
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
                if(isset($content[0]["misc"])){
                    foreach($content[0]["misc"] as $key => $value){
                        
                    }
                }
                //if(!isset($result->num_rows)){
                    //    echo "error_$key:". $key;
                    //}
            }else{}
        }
    }
    
    
    

?>