<?php
//pull game details from URL
$gameID = $_GET["id"];
require "globalassets/dbinit.php";
$sql = "select * from events where id=". $gameID;
$game = "";
$result = $conn->query($sql);
if(isset($result)){
    $game = $result->fetch_array();
    if($game["sport"] == "football"){
        displayFootball();
    }else if($game["sport"] == "soccer"){
        displaySoccer();
    }
}

function displayFootball(){
global $game;

?>

<script>
document.location.href = "ui.html";
</script>


<?php

}

function displaySoccer(){
echo "soccer ui WIP";
}


?>