<?php
//authentication
$eUsr = $_COOKIE["ksb_usr"];
$ePswd = $_COOKIE["ksb_pswd"];
$conn = new mysqli("localhost", "root", null, "scoreboard");
if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}




if(isset($eUsr) && isset($ePswd)){
    
    $sql = "SELECT * from users WHERE name=".$eUsr." and passwordSHA256=".$ePswd;
    
    $result = $conn->query($sql);
    
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["disabled"] == 1) {
                echo "error_auth";
            } else {
                $resultArray[] = $row;
                echo json_encode($resultArray);
                createEvent();
            }
        }
    } else {
        echo "error_auth";
    }
    $conn->close();
    
    
}else{
    echo "not authenticated";
    
    
}

function createEvent(){
    $name = $_GET["name"];
    $opposing = $_GET["opposing"];
    $startTimestamp = $_GET["starttime"];
    $ = $_GET["name"];
    $name = $_GET["name"];
    $name = $_GET["name"];


}


?>