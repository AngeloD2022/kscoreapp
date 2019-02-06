//KENSTON BASKETBALL GT ADMIN PANEL - CORE FRAMEWORK
//CODED BY: ANGELO DELUCA
//Copyright (c) 2018 Kenston Local School District

var request = {};
var xhttp = new XMLHttpRequest();
var timerSTATUS;
var ms = 0;
var uid;
getUserID();
//elements
var kenstonScoreDisplay = document.getElementById("kscore");
var guestScoreDisplay = document.getElementById("gscore");
//stats
var KenstonScore = 0;
var GuestScore = 0;
var period = 1;
//misc
var period1Button = document.getElementById("p1");
var period2Button = document.getElementById("p2");
var period3Button = document.getElementById("p3");
var period4Button = document.getElementById("p4");

var ballPosession;
var ballPosessonElement = document.getElementsByName("hB");
var ydsBallOn = document.getElementById("ydsBallOn");
var ydsToGo = document.getElementById("ydsToGo");
//readServer();
window.onload = function () {
    console.log("GID: " + gameId);
    KenstonScore = kScore;
    GuestScore = gScore;
    kenstonScoreDisplay.innerHTML = kScore;
    guestScoreDisplay.innerHTML = gScore;
    loadInitial();
}



function incrementScore(amount, team) {
    if (team == "k") {
        if (request.homeScore == null) {
            request.homeScore = 0;
        }
        KenstonScore += amount;
        kenstonScoreDisplay.innerHTML = KenstonScore;
        request.homeScore = KenstonScore;
    } else {
        if (request.oppScore == null) {
            request.oppScore = 0;
        }
        GuestScore += amount;
        guestScoreDisplay.innerHTML = GuestScore;
        request.oppScore = GuestScore;
    }
    sendTimer();
}


function decrementScore(amount, team) {
    if (team == "k") {
        if (request.homeScore == null) {
            request.homeScore = 0;
        }
        KenstonScore -= amount;
        kenstonScoreDisplay.innerHTML = KenstonScore;
        request.homeScore = KenstonScore;
    } else {
        if (request.oppScore == null) {
            request.oppScore = 0;
        }
        GuestScore -= amount;
        guestScoreDisplay.innerHTML = GuestScore;
        request.oppScore = GuestScore;
    }
    sendTimer();
}



//MISC JSON
var miscReq = {};
var kbx1;
var kbx2;
var gbx1;
var gbx2;
document.onload = function () {
    console.log("DOC LOADED");
};
kbx1 = document.getElementById("kbx1");
kbx2 = document.getElementById("kbx2");
gbx1 = document.getElementById("gbx1");
gbx2 = document.getElementById("gbx2");

function bonusSelect(team, value) {

}



function teamHasBall(team) {
    if (team == "home") {
        miscReq.ballPosess = "home";
    } else {
        miscReq.ballPosess = "guest";
    }
    sendTimer();
}



function changePeriod(value) {
    pspb = document.getElementById("p" + period);
    miscReq.period = value;
    if (value == 1) {
        pspb.className = "pBtn";
        pspb.disabled = false;
        period1Button.className = "pBtnSelected";
        period1Button.disabled = true;
    } else if (value == 2) {
        pspb.className = "pBtn";
        pspb.disabled = false;
        period2Button.className = "pBtnSelected";
        period2Button.disabled = true;
    } else if (value == 3) {
        pspb.className = "pBtn";
        pspb.disabled = false;
        period3Button.className = "pBtnSelected";
        period3Button.disabled = true;
    } else if (value == 4) {
        pspb.className = "pBtn";
        pspb.disabled = false;
        period4Button.className = "pBtnSelected";
        period4Button.disabled = true;
    }
    period = value;
    sendTimer();
}

function changeHasBall(team) {
    miscReq.hasBall = team;
}


document.getElementById("endgamebtn").addEventListener("click", function(event){
    var endGame = confirm("Do you want to end this event?");
    if(endGame){
        endEvent();
    }
});


function endEvent(){
xhttp.onreadystatechange = function(){
    if(this.readyState == 4 && this.status == 200){
        if(this.responseText.includes("error")){
            alert("Server error: "+ this.responseText);
        }else if(this.responseText.includes("error") && this.responseText.includes("auth")){
            alert("Authentication error");
            document.location.reload();
        }else if(this.responseText.includes("success")){
            alert("Event marked as finished");
            window.close();
        }
    }
};
xhttp.open("GET", "setFinished.php?id="+gameId, true);
xhttp.send();

}




var dLoad = document.getElementById("dLoad");
var dLsvg = document.getElementById("determinateSVG");
var lDiv = document.getElementById("loader");
var running = false;
var loadlbl = document.getElementById("loadlbl");

function sendTimer() {
    if (!running) {
        running = true;
        loadlbl.className = "";
        dLsvg.style.stroke = "rgb(0, 195, 255)";
        dLoad.style.strokeDashoffset = -313;
        lDiv.className = "loaderShown";
        loadlbl.innerHTML = "<strong>Waiting...</strong>";
        loadlbl.style.color = "rgb(0, 195, 255)";
        console.log("start");
        var timer = setInterval(function () {
            ms++;
            dLoad.style.strokeDashoffset = parseInt(-313 + ((ms / 200) * 313));
            if (ms == 200) {
                postServer();
                console.log("Done");
                //clear timer icon
                ms = 0;
                clearInterval(timer);
            }
        }, 10);
    } else {
        ms = 0;
    }

}




function postServer() {
    console.log(kScore);
    request.id = gameId;
    request.uid = uid;
    if (JSON.stringify(miscReq) != "{}") {
        request.misc = miscReq;
    }
    var rawData = JSON.stringify(request);
    console.log(rawData);
    xhttp.open("POST", "update.php", true);
    xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.includes("error")) {
                alert("there was an error contacting the server");
            }
            console.log(this.responseText);
        }
    }
    xhttp.onloadstart = function () { //starts the request
        //show indeterminite
        loadlbl.innerHTML = "<strong>Syncing...</strong>";
        loadlbl.style.color = "rgb(255, 196, 87)";
        dLoad.style.strokeDashoffset = "";
        dLsvg.style.stroke = "rgb(255, 196, 87)";
        dLoad.className.baseVal = "indeterminateLoad";

    }
    xhttp.onload = function () {
        loadlbl.innerHTML = "<strong>Synchronized</strong>";
        loadlbl.style.color = "rgb(0, 216, 11)";
        dLoad.style.strokeDashoffset = 0;
        dLsvg.style.stroke = "rgb(0, 216, 11)";
        dLoad.className.baseVal = "dC";
        request = {};
        miscReq = {};
        setTimeout(function () {
            lDiv.className = "loaderHidden";
            loadlbl.className = "loaderHidden";
        }, 1000);
        running = false;
    }
    xhttp.onerror = function () {
        loadlbl.innerHTML = "<strong>Error</strong>";
        loadlbl.style.color = "rgb(255, 73, 73)";
        dLoad.style.strokeDashoffset = 0;
        dLsvg.style.stroke = "rgb(255, 73, 73)";
        setTimeout(function () {
            alert("A network error occurred.");
            document.location.reload();
        }, 1000);
        running = false;
    }
    xhttp.send(rawData);

}

function getUserID() {
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == "not found" || this.responseText == "disabled") {
                console.log("not found or disabled");

                window.close();
            } else {
                var acc = JSON.parse(this.responseText);
                var acct = acc[0];
                uid = acct.id;

            }

        }
    }
    xhttp.open("GET", "/admin/script.php", true);
    xhttp.send();
}

function loadInitial() {
    /*
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == "not found" || this.responseText == "disabled") {
                console.log("not found or disabled");

                window.close();
            } else {
                var data = JSON.parse(this.responseText);
                ballonteam = data["misc"].ballOnTeam;
                changeDownInit(data["misc"].down);
                changeQuarterInit(data["misc"].quarter);
                changeBallOnInit(data["misc"].ydsBallOn);
                changeToGoInit(data["misc"].ydsToGo);
                changeBallPosessInit(data["misc"].ballPosess);
                if (data["misc"].ballOnTeam != null) {
                    ballOnSideInit(data["misc"].ballOnTeam);
                }
            }

        }
    }
    xhttp.open("GET", "/app/eventData.php?id=" + gameId, true);
    xhttp.send();
    */
}

function changeQuarterInit(value) {
    if (value == null) {
        qua = 0;
        return;
    }
    psqb = document.getElementById("q" + period);
    if (value == 1) {
        psqb.className = "qBtn";
        psqb.disabled = false;
        quarter1Button.className = "qBtnSelected";
        quarter1Button.disabled = true;
    } else if (value == 2) {
        psqb.className = "qBtn";
        psqb.disabled = false;
        quarter2Button.className = "qBtnSelected";
        quarter2Button.disabled = true;
    } else if (value == 3) {
        psqb.className = "qBtn";
        psqb.disabled = false;
        quarter3Button.className = "qBtnSelected";
        quarter3Button.disabled = true;
    } else if (value == 4) {
        psqb.className = "qBtn";
        psqb.disabled = false;
        quarter4Button.className = "qBtnSelected";
        quarter4Button.disabled = true;
    }
    period = value;
}

function changeDownInit(value) {
    if (value == null) {
        down = 0;
        return;
    }
    psdb.className = "qBtn";
    psdb.disabled = false;
    psdb = document.getElementById("d" + value);
    down = value;
    downNo.innerHTML = value;
    if (value == 1) {
        down1Button.className = "qBtnSelected";
        down1Button.disabled = true;
        downAfter.innerHTML = "st";
    } else if (value == 2) {
        down2Button.className = "qBtnSelected";
        down2Button.disabled = true;
        downAfter.innerHTML = "nd";
    } else if (value == 3) {
        down3Button.className = "qBtnSelected";
        down3Button.disabled = true;
        downAfter.innerHTML = "rd";
    } else if (value == 4) {
        down4Button.className = "qBtnSelected";
        down4Button.disabled = true;
        downAfter.innerHTML = "th";
    }

}

function changeBallOnInit(value) {
    if (value == null) {
        ballOnRaw = 0;
        return;
    }

    ydsBallOn.value = value
    if (ballonteam == "home") {
        ballOnRaw = value - 50;
    } else if (ballonteam == "guest") {
        ballOnRaw = 50 - value;
    }
}

function changeToGoInit(value) {
    if (value == null) {
        togo = 50;
        return;
    }

    ydsToGo.value = value
    toGo = ydsToGo.value;
}

function changeBallPosessInit(value) {
    if (value == null) {
        ballPosession = "x";
        return;
    }

    if (value == "home") {
        document.getElementById("homeHasBall").checked = true;
    } else if (value == "guest") {
        document.getElementById("guestHasBall").checked = true;
    }
}

function ballOnSideInit(team) {
    if (team == null) {
        ballonteam = "x";
    }
    if (team == "home") {
        document.getElementById("teambh").className = "ballOnTeamBtnSelected";
        document.getElementById("teambh").disabled = true;
        pstb = document.getElementById("teambh");
        ballonteam = "home";
    } else if (team = "guest") {
        document.getElementById("teambg").className = "ballOnTeamBtnSelected";
        document.getElementById("teambg").disabled = true;
        pstb = document.getElementById("teambg");
        ballonteam = "guest";
    }
}

//Bonus CTRL mouseover handlers

document.getElementById("kbx1").addEventListener("mouseover", function (event) {
    this.style.color = "orange";
})
document.getElementById("kbx2").addEventListener("mouseover", function (event) {
    document.getElementById("kbx1").style.color = "orange";
    this.style.color = "orange";
})

//-------------------------------------------------------------------------------------------
//TIMER CORE

var timerbutton = document.getElementById("tbtn");
var timerdisplay = document.getElementById("tdisplay");
var timersetbutton = document.getElementById("tsetbtn");
var txhttp = new XMLHttpRequest();
var timerSeconds = 0;
var timerc;
var timerIsRunning = false;
var timerms;
//10:50

/*
TIMERSTATUS KEY
---------------
E - ended
R - running


*/

function toggleTimer() {
    if (timerIsRunning) { //timer paused
        clearInterval(timerc);
        timerToSrv(new Date().getTime(), timerSeconds, "P");
        timerbutton.style.background = "rgb(16, 220, 14)";
        timerbutton.innerHTML = "PLAY";
        timerIsRunning = false;
    } else { //timer play
        if (timerSeconds > 0) {
            runTimer(timerSeconds);
            timerToSrv(new Date().getTime(), timerSeconds, "R");
            timerbutton.style.background = "rgb(253, 81, 81)";
            timerbutton.innerHTML = "PAUSE";
            timerIsRunning = true;
        } else {
            alert("You must set a value for the timer before it can count down.");
        }

    }
}


function runTimer(seconds) { //timer counter;
    var m;
    //    m = s/60;
    //    s = s%60;
    var now = new Date().getTime();
    var future = now + 1000 * seconds;
    timerms = future - now;
    timerc = setInterval(function () {
        timerIsRunning = true;
        now = new Date().getTime();
        timerms = future - now;
        timerSeconds = Math.floor(timerms / 1000);
        m = Math.floor(timerSeconds / 60);
        console.log(Math.floor(timerSeconds / 60) + ":" + timerSeconds % 60);
        timerdisplay.innerHTML = (m < 10 ? "0" + m : m) + ":" + (timerSeconds % 60 < 10 ? "0" + timerSeconds % 60 : timerSeconds % 60);
        if (m == 0 && timerSeconds % 60 == 0) {
            clearInterval(timerc);
            timerToSrv(now, 0, "E"); // sends XHR to server
            timerIsRunning = false;
            timerbutton.style.background = "rgb(16, 220, 14)";
            timerbutton.innerHTML = "PLAY";
        }
    }, 200);
}

function timerSetPrompt() {
    while (true) {
        var time = prompt("How much time? Formatted like: \"MM/SS\"");
        //Parse Input
        time = time.split(/\D+/);
        minutes = time[0];
        seconds = time[1];
        if (minutes != "" || seconds != "") {
            minutes = minutes == "" ? 0 : parseInt(minutes);
            seconds = seconds == "" ? 0 : parseInt(seconds);
            if (confirm("The timer will be set to " + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds))) {
                setTimer((minutes * 60) + seconds);
                break;
            } else {
                if (!confirm("Would you like to set the timer again?")) {
                    break;
                }
            }
        } else {
            break;
        }
    }
}

function setTimer(seconds) {
    timerdisplay.innerHTML = (Math.floor(seconds / 60) < 10 ? "0" + Math.floor(seconds / 60) : Math.floor(seconds / 60)) + ":" + (seconds % 60 < 10? "0"+seconds%60:seconds%60);
    timerSeconds = seconds;
    if (timerIsRunning) {
        timerbutton.style.background = "rgb(16, 220, 14)";
        timerbutton.innerHTML = "PLAY";
        clearInterval(timerc);
        timerIsRunning = false;
    }
    timerToSrv(new Date().getTime(), seconds, "S");
}

//timerSTATUS = timerSTATUS == "P"? "R" : "P";
function timerToSrv(unix, secondsvalue, state) {
    //get current timestamp down to ms
    var treq = {};
    treq.id = gameId;
    treq.uid = uid;
    treq.unix = unix;
    treq.startValue = secondsvalue;
    treq.currentState = state;
    var tRaw = JSON.stringify(treq);
    console.log(tRaw);
    txhttp.open("POST", "bb-T_IN.php", true);
    txhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
    txhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText.includes("error")) {
                alert("there was an error contacting the server");
            }
            console.log(this.responseText);
        }
    }
    txhttp.send(tRaw);

    //get status of timer

    //build request
}