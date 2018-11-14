<?php
function authenticate(){

    global $conn;

    $eUsr = isset($_COOKIE["ksb_usr"]) ? $_COOKIE["ksb_usr"] : "x";
    $ePswd = isset($_COOKIE["ksb_pswd"]) ? $_COOKIE["ksb_pswd"] : "x";

    $sql = "SELECT * from users WHERE name='" . $eUsr . "' and passwordSHA256='" . $ePswd ."'";

    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row["disabled"] == 1) {
                echo "error_auth";
            } else {
                $resultArray = $row;
                //EXECUTE FUNCTION HERE 
            }
        }
    } else {
        echo "error_auth";
    }
    
    if(isset($resultArray)){
        return $resultArray;
    }else{
        return false;
    }
}
?>