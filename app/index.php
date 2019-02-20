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
    }else if($game["sport"] == "basketball"){
        displayBasketball();
    }
}

function displayFootball(){
global $game;

?>

<link href="assets.css" type="text/css" rel="stylesheet"/>
<div id="endFw"></div>
<br>
<br>
<div class="logo-container">
        <img class="app-logo" src="/kcrop.png" style="float:left;">
        <div style="display: inline-block;">
            <span class="app-logo-text">Gametime</span><br>
            <span class="app-logo-text-sub">viewer</span>
        </div>
    </div>
<br>
<br>
<br>
<div class="scoreDisplay">
        <div class="kenston-card">
            <p class="tscore" id="kscore">0</p>
            <p class="tname"> <span id="kball"><img style="width: 17px; height: 17px;" src="ballPosessIcon.png"/></span> Kenston</p>
        </div>
        <div class="down" id="down">
            <p class="dtxt"><span id="dNum">1</span><span id="dt2" style="font-size:17pt"><span id="numSuffix">st</span><br>Down</span></p>
        </div>
        <div class="guest-card">
            <p class="tscore" id="gscore">0</p>
            <p class="tname"><span id="gball"><img style="width: 17px; height: 17px;" src="ballPosessIcon.png"/></span> <?=$game["opposing"]?></p>
        </div><br>
        <div class="misc">
                    <div class="quarter">
                        <h5 style="margin: 4px;">Quarter</h5>
                        <span class="qInd" id="q1">1</span>
                        <span class="qInd" id="q2">2</span>
                        <span class="qInd" id="q3">3</span>
                        <span class="qInd" id="q4">4</span>
                    </div>
                    <div class="togo">
                        <div style="display: inline-block">
                            <h5 style="margin: 4px;">YDS. TO GO</h5>
                            <span class="numbers" id="ydsToGo">--</span>
                        </div>
                    </div>
                    <div class="togo">
                        <div style="display: inline-block">
                            <h5 style="margin: 4px;">BALL ON:</h5>
                            <span class="numbers" id="ydsBallOn">--</span>
                        </div>
                    </div>
        </div>
    </div>
    <script src="core.js" type="text/javascript"></script>
    <script src="fireworks.js" type="text/javascript"></script>
    <script>
    var gid = <?=$game["id"];?>;
    </script>


<?php

}

function displaySoccer(){
echo "soccer ui WIP";
}


function displayBasketball(){
    global $game;
    ?>
<link href="assets-bb.css" type="text/css" rel="stylesheet" />
<div id="endFw"></div>
<br>
<br>
<div class="logo-container">
        <img class="app-logo" src="/kcrop.png" style="float:left;">
        <div style="display: inline-block;">
            <span class="app-logo-text">Gametime</span><br>
            <span class="app-logo-text-sub">viewer</span>
        </div>
    </div>
<br>
<br>
<br>

<script src="fireworks.js" type="text/javascript"></script>




<div class="scoreDisplay">
    <div class="kenston-card">
        <p class="tscore" id="kscore">0</p>
        <p class="tname"> <span id="kball"><img style="width: 17px; height: 17px;" src="basketball.png" /></span>
            Kenston</p>
    </div>
    <div class="tcard" id="down">
        <p id="tdisplay" class="dtxt">00:00</p>
        <p class="dtxt" id="tstate" style="font-size:13pt">-------</p>
    </div>
    <div class="guest-card">
        <p class="tscore" id="gscore">0</p>
        <p class="tname"><span id="gball"><img style="width: 17px; height: 17px;" src="basketball.png" /></span>
            Test</p>
    </div><br>
    <div class="misc">
        <div class="misc-sect">
            <h5 style="margin: 4px;">Period</h5>
            <span class="pInd" id="p1">1</span>
            <span class="pInd" id="p2">2</span>
            <span class="pInd" id="p3">3</span>
            <span class="pInd" id="p4">4</span>
        </div>
        <div class="misc-sect">
            <div style="display: inline-block">
                <h5 style="margin: 4px;">Bonus</h5>
                <div style="float:left;">
                        <h5 class="BonusTN" style="display: inline-block">Kenston</h5>
                        <p style="display: inline-block; margin-left: 9px; margin-top: 7px;margin-bottom: 0px;margin-right: 7px; cursor:default;">
                            <span id="kbx2" style="color: #a7a7a7; cursor:default;">&#x25C4;</span>
                            <span id="kbx1" style="color: #a7a7a7; cursor:default;">&#x25C4;</span>
                        </p>
                    </div>
                    <div style="float:right;">
                        <p style="display: inline-block; margin-left: 9px; margin-top: 7px;margin-bottom: 0px;margin-right: 7px; cursor:default;">
                            <span id="gbx1" style="color: #a7a7a7; cursor:default;">&#9658;</span>
                            <span id="gbx2" style="color: #a7a7a7; cursor:default;">&#9658;</span>
                        </p>
                        <h5 class="BonusTN" style="display: inline-block">Guest</h5>
                    </div>
            </div>
        </div>
        
    </div>
</div>












</script>
<script src="bb-core.js" type="text/javascript"></script>
<script>

    var gid = <?=$game["id"];?>;
</script>


    <?php
}

?>