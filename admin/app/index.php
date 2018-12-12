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
    global $authBack;
    $sql = "SELECT * from events where id=".$event;
    $result = $conn->query($sql);
    $game = $result->fetch_array();

    ?>
<!--KENSTON GT-ADMIN FOOTBALL UI-->
<!--Designed by Angelo DeLuca-->

<head>
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" type="text/css" href="assets.css" />
    <link rel="stylesheet" type="text/css" href="buttonMaterial.css" />
</head>

<body>

    <div class="logo-container">
        <img class="app-logo" src="/kcrop.png" style="float:left;" />
        <div style="display: inline-block;">
            <span class="app-logo-text">Gametime</span><br>
            <span class="app-logo-text-sub">admin</span>
        </div>
    </div>

    <div style="text-align:center;">
        <div class="gamedetails">
            <p>Logged in as: <?=$authBack["rname"]?></p>
            <p>Game Identifier: <?=$game["id"]?></p>
            <p>Sport: <?=$game["sport"]?></p>
            <p>ELAPSED ACTIVE (WIP)</p>
        </div>
    </div>
    <span id="loader" class="loaderHidden">
        <svg id="determinateSVG" class="determinateLoad" viewBox="0 0 133 133" xmlns="http://www.w3.org/2000/svg">
              <circle id="dLoad" class="dC" r="50"/>
            </svg>
    </span>
    <span id="closeBtn" class="closeBtn">&times;</span>

    <div class="app-main">
        <table style="margin: 0 auto;">
            <tr>
                <td class="tblCell">
                    <div class="app-ctrls">
                        <button class="upBtn" onclick="incrementScore(1, 'k')" id="increaseHomeScore"><svg version="1.1" viewBox="0.0 0.0 100.0 100.0"
                                fill="none" stroke="none" stroke-linecap="square" stroke-miterlimit="10" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns="http://www.w3.org/2000/svg">
                                <clipPath id="p.0">
                                    <path d="m0 0l100.0 0l0 100.0l-100.0 0l0 -100.0z" clip-rule="nonzero" />
                                </clipPath>
                                <g clip-path="url(#p.0)">
                                    <path fill="#000000" fill-opacity="0.0" d="m0 0l100.0 0l0 100.0l-100.0 0z"
                                        fill-rule="evenodd" />
                                    <path fill="#ffffff" d="m50.0 30.658804l32.09449 32.09449l-21.396114 0l-10.698376 -10.698376l-10.698376 10.698376l-21.396112 0z"
                                        fill-rule="evenodd" />
                                </g>
                            </svg></button><br>
                        <button class="purpleBtn" onclick="incrementScore(6, 'k')" id="homePlusSix">+6 Touchdown</button><br>
                        <button class="purpleBtn" onclick="incrementScore(3, 'k')" style="width: 100px;" id="homePlusThree">+3 Field Goal</button><br>
                        <button class="dnBtn" onclick="decrementScore(1, 'k')" id="decreaseHomeScore"><svg version="1.1" viewBox="0.0 0.0 100.0 100.0"
                                fill="none" stroke="none" stroke-linecap="square" stroke-miterlimit="10" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns="http://www.w3.org/2000/svg">
                                <clipPath id="p.0">
                                    <path d="m0 0l100.0 0l0 100.0l-100.0 0l0 -100.0z" clip-rule="nonzero" />
                                </clipPath>
                                <g clip-path="url(#p.0)">
                                    <path fill="#000000" fill-opacity="0.0" d="m0 0l100.0 0l0 100.0l-100.0 0z"
                                        fill-rule="evenodd" />
                                    <path fill="#ffffff" d="m50.0 73.593185l-32.09449 -32.094486l21.396112 0l10.698376 10.698376l10.698376 -10.698376l21.396114 0z"
                                        fill-rule="evenodd" />
                                </g>
                            </svg></button>
                    </div>
                </td>
                <td class="tblCell">
                    <div style="text-align: center;">
                        <div class="scoreDisplay">
                            <div class="kenston-card">
                                <p class="tscore" id="kscore">00</p>
                                <p class="tname">Kenston</p>
                            </div>
                            <div class="down">
                                <p class="dtxt"><span id="dNum">1</span><span id="dt2" style="font-size:17pt"><span id="numSuffix">st</span><br>Down</span></p>
                            </div>
                            <div class="guest-card">
                                <p class="tscore" id="gscore">00</p>
                                <p class="tname"><?=$game["opposing"]?></p>
                            </div><br>
                            <div class="misc">
                                <div class="ball">
                                    <h5 style="margin: 4px;">Ball Possession:</h5>
                                    <div style="text-align:left;">
                                        <label for="homeHasBall">Kenston</label>
                                        <input onclick="teamHasBall('home')" name="hB" type="radio" id="homeHasBall"/><br>
                                        <label for="guestHasBall">OPPOSING</label>
                                        <input onclick="teamHasBall('guest')" name="hB" type="radio" id="guestHasBall"/>
                                    </div>
                                </div>
                                <div class="quarter">
                                    <h5 style="margin: 4px;">Quarter</h5>
                                    <button onclick="changeQuarter(1)" id="q1" class="qBtn">1</button>
                                    <button onclick="changeQuarter(2)" id="q2" class="qBtn">2</button>
                                    <button onclick="changeQuarter(3)" id="q3" class="qBtn">3</button>
                                    <button onclick="changeQuarter(4)" id="q4" class="qBtn">4</button>
                                    <h5 style="margin: 4px;">Down</h5>
                                    <button onclick="changeDown(1)" id="d1" class="qBtn">1</button>
                                    <button onclick="changeDown(2)" id="d2" class="qBtn">2</button>
                                    <button onclick="changeDown(3)" id="d3" class="qBtn">3</button>
                                    <button onclick="changeDown(4)" id="d4" class="qBtn">4</button>
                                </div>
                                <div class="togo">
                                        <h5 style="margin: 4px;">YDS. TO GO</h5>
                                        <button onclick="changeToGo('sub')" class="subButton">-</button>
                                        <input class="numberInput" id="ydsToGo" type="number" pattern="[0-9]*" min="0" max="99">
                                        <button onclick="changeToGo('add')" class="addButton">+</button>
                                        <h5 style="margin: 4px;">BALL ON:</h5>
                                        <button onclick="changeBallOn('sub')" class="subButton">-</button>
                                        <input class="numberInput" id="ydsBallOn" type="number" pattern="[0-9]*" min="0" max="99">
                                        <button onclick="changeBallOn('add')" class="addButton">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="tblCell">
                    <div class="app-ctrls">
                        <button class="upBtn" onclick="incrementScore(1, 'g')" id="increaseGuestScore"><svg version="1.1" viewBox="0.0 0.0 100.0 100.0" fill="none"
                                stroke="none" stroke-linecap="square" stroke-miterlimit="10" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns="http://www.w3.org/2000/svg">
                                <clipPath id="p.0">
                                    <path d="m0 0l100.0 0l0 100.0l-100.0 0l0 -100.0z" clip-rule="nonzero" />
                                </clipPath>
                                <g clip-path="url(#p.0)">
                                    <path fill="#000000" fill-opacity="0.0" d="m0 0l100.0 0l0 100.0l-100.0 0z" fill-rule="evenodd" />
                                    <path fill="#ffffff" d="m50.0 30.658804l32.09449 32.09449l-21.396114 0l-10.698376 -10.698376l-10.698376 10.698376l-21.396112 0z"
                                        fill-rule="evenodd" />
                                </g>
                            </svg></button><br>
                        <button class="purpleBtn" onclick="incrementScore(6, 'g')" id="guestPlusSix">+6 Touchdown</button><br>
                        <button class="purpleBtn" onclick="incrementScore(3, 'g')" style="width: 100px;" id="guestPlusThree">+3 Field Goal</button><br>
                        <button class="dnBtn" onclick="decrementScore(1, 'g')" id="decreaseGuestScore"><svg version="1.1" viewBox="0.0 0.0 100.0 100.0" fill="none"
                                stroke="none" stroke-linecap="square" stroke-miterlimit="10" xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns="http://www.w3.org/2000/svg">
                                <clipPath id="p.0">
                                    <path d="m0 0l100.0 0l0 100.0l-100.0 0l0 -100.0z" clip-rule="nonzero" />
                                </clipPath>
                                <g clip-path="url(#p.0)">
                                    <path fill="#000000" fill-opacity="0.0" d="m0 0l100.0 0l0 100.0l-100.0 0z" fill-rule="evenodd" />
                                    <path fill="#ffffff" d="m50.0 73.593185l-32.09449 -32.094486l21.396112 0l10.698376 10.698376l10.698376 -10.698376l21.396114 0z"
                                        fill-rule="evenodd" />
                                </g>
                            </svg></button>
                    </div>
                </td>
            </tr>
        </table>
    </div>

</body>

<script src="pageEvents.js" type="text/javascript"></script>
<script src="fb-core.js" type="text/javascript"></script>
<script>
var gameId = <?=$game["id"]?>; // ID HERE
var kScore = <?=$game["homeScore"]?>;//initial value
var gScore = <?=$game["oppScore"]?>;//initial value
</script>

    <?php
}


?>