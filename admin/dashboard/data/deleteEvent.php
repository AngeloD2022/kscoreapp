<?php
require "globalassets/dbInit.php";
require "globalassets/authentication.php";

$id = isset($_GET["id"])? $_GET["id"]:"x";
$authBack = authenticate();
if(isset($authBack)){
    if($id == "x"){
        echo "error_invQuery";
    }else{
        $sql = "UPDATE `events` SET `deleted` = '1' WHERE `events`.`id` = ". $id .";";
        $conn->query($sql);
        if($conn->error == ""){
            echo "success";
        }else{
            echo "error_". $conn->error;
        }
    }
}else{
    echo "auth_error";
}
?>