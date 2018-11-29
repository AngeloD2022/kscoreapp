<?php
require "globalassets/dbinit.php";
require "globalassets/authentication.php";
$authBack = authenticate();
if(!isset($authBack)){
    $authBack = "x";
}
else
{
    $event = isset($_GET["id"])? $_GET["id"]: "x";
    $sql = "SELECT * from events where usrID=".$authBack["id"]." and id=".$event;
    $result = $conn->query($sql);
    if($result->num_rows < 1)
        $authBack = "x";
}

if($authBack == "x"){
    ?>
<p id="s">You are not authorized to control this event.</p>
<script>
var secs = 10;
var timer = setInterval(function(){
    secs--;
    countdown(secs);

}, 1000)

function countdown(s){
if(secs < 6){
    document.getElementById("s").innerHTML = "Closing in "+s+" seconds.";
    if(secs == 0){
        window.close();
    }
}
}
</script>
    
    
    <?php
}else{
    showUi();
}
function showUi(){
    //gData
    global $event;
    global $conn;
    $sql = "SELECT * from events where id=".$event;
    $result = $conn->query($sql);
    $game = $result->fetch_array();

    ?>
<script>
    window.location.href = "ui.html";
</script>

    <?php
}


?>