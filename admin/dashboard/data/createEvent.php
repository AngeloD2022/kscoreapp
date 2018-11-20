<?php
//authentication
$eUsr = isset($_COOKIE["ksb_usr"]) ? $_COOKIE["ksb_usr"] : "x";
$ePswd = isset($_COOKIE["ksb_pswd"]) ? $_COOKIE["ksb_pswd"] : "x";
$conn = new mysqli("localhost", "root", null, "scoreboard");


if ($conn->connect_error) {
    die("Failed: " . $conn->connect_error);
}

$sql = "SELECT * from users WHERE name='" . $eUsr . "' and passwordSHA256='" . $ePswd ."'";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if ($row["disabled"] == 1) {
            echo "error_auth";
        } else {
            $resultArray = $row;
            
            createEvent($resultArray);
        }
    }
} else {
    echo "error_auth";
}
$conn->close();



function createEvent($auth)
{
    $name = isset($_GET["gname"])? addslashes($_GET["gname"]):"x";
    $opposing = isset($_GET["gopposing"])? addslashes($_GET["gopposing"]):"x";
    $startTimestamp = isset($_GET["timeStart"])? $_GET["timeStart"]:"x";
    $teamClass = isset($_GET["tclass"])?addslashes( $_GET["tclass"]):"x";
    $school = isset($_GET["school"])? addslashes($_GET["school"]):"x";
    $location = isset($_GET["gloc"])? addslashes($_GET["gloc"]):"x";
    $oppLogoUrl = isset($_GET["opplogo"])? addslashes($_GET["opplogo"]):"x";
    $sport = isset($_GET["sport"])? addslashes($_GET["sport"]):"x";
    
    if($name == "x" ||$opposing == "x" ||$startTimestamp == "x" ||$teamClass == "x" ||$school == "x" ||$location == "x" ||$oppLogoUrl == "x" ||$sport == "x"){
        echo "error_invparams";
    }else{
        $conn = new mysqli("localhost", "root", null, "scoreboard");
        $tsFormatted = date("Y-m-d H:i:s", strtotime($startTimestamp));
        if ($conn->connect_error) {
            die("Failed: " . $conn->connect_error);
        }
        $creatorID = $auth["id"];
        $creatorName = $auth["rname"];


        $sql = "INSERT INTO `events` (`id`, `name`, `opposing`, `createdTS`, `startingTS`, `usrCreated`, `usrID`, `teamClass`, `school`, `location`, `oppLogoUrl`, `sport`, `cancelled`, `homeScore`, `oppScore`)
         VALUES (NULL, '".$name."', '".$opposing."', CURRENT_TIMESTAMP, '".$tsFormatted."', '".$creatorName."', '".$creatorID."', '".$teamClass."', '".$school."', '".$location."', '".$oppLogoUrl."', '".$sport."', '0', '0', '0')";
        
        $res = $conn->query($sql);
        //print "last sql error: " . $conn->error() . "<br>\r\n";
        
        if($conn->error == ""){
            echo "success";
        }else{
            echo "error_". $conn->error;
            
        }
    }

    //Test URL: http://localhost/admin/dashboard/data/createEvent.php?gname=TestEvent&gopposing=Chardon&timeStart=2018-06-07T00:00&tclass=v&grade=8&gloc=Home&opplogo=https://example.com&sport=Football

}


?>