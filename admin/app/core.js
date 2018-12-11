//KENSTON GT ADMIN PANEL - CORE FRAMEWORK
//CODED BY: ANGELO DELUCA
//Copyright (c) 2018 Kenston Local School District
var request = {};
var xhttp = new XMLHttpRequest();
var ms = 0;
var uid;
getUserID();
//elements
var kenstonScoreDisplay = document.getElementById("kscore");
var guestScoreDisplay = document.getElementById("gscore");
//stats
var KenstonScore = 0;
var GuestScore = 0;
var quarter = 1;
var toGo = 0;
var ballOn;
var down;
//misc
var quarter1Button = document.getElementById("q1");
var quarter2Button = document.getElementById("q2");
var quarter3Button = document.getElementById("q3");
var quarter4Button = document.getElementById("q4");

var ydsToGo = document.getElementById("ydsToGo");
//readServer();
window.onload = function () {
    console.log("GID: " + gameId);
    KenstonScore = kScore;
    GuestScore = gScore;
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
var psqb;

function changeToGo(action){
    if(action == "add"){
        ydsToGo.value++;
    }else{
        ydsToGo.value--;
    }
    toGo = ydsToGo.value;
    miscReq.ydsToGo = ydsToGo.value;
    sendTimer();
}

ydsToGo.addEventListener("change", function(event) {
    miscReq.ydsToGo = event.target.value;
    sendTimer();
});

function changeQuarter(value) {
    psqb = document.getElementById("q" + quarter);
    miscReq.quarter = value;
    if (value == 1) {
        psqb.className = "qBtn";
        quarter1Button.className = "qBtnSelected";
    } else if (value == 2) {
        psqb.className = "qBtn";
        quarter2Button.className = "qBtnSelected";
    } else if (value == 3) {
        psqb.className = "qBtn";
        quarter3Button.className = "qBtnSelected";
    } else if (value == 4) {
        psqb.className = "qBtn";
        quarter4Button.className = "qBtnSelected";
    }
    quarter = value;
    sendTimer();
}

function changeHasBall(team) {
    miscReq.hasBall = team;
}







var dLoad = document.getElementById("dLoad");
var dLsvg = document.getElementById("determinateSVG");
var lDiv = document.getElementById("loader");
var running = false;

function sendTimer() {
    if (!running) {
        running = true;
        dLsvg.style.stroke = "rgb(0, 195, 255)";
        dLoad.style.strokeDashoffset = -313;
        lDiv.className = "loaderShown";
        console.log("start");
        var timer = setInterval(function () {
            ms++;
            dLoad.style.strokeDashoffset = parseInt(-313 + ((ms / 300) * 313));
            if (ms == 300) {
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
        dLoad.style.strokeDashoffset = "";
        dLsvg.style.stroke = "rgb(255, 196, 87)";
        dLoad.className.baseVal = "indeterminateLoad";

    }
    xhttp.onload = function () {
        dLoad.style.strokeDashoffset = 0;
        dLsvg.style.stroke = "rgb(0, 216, 11)";
        dLoad.className.baseVal = "dC";
        request = {};
        miscReq = {};
        setTimeout(function () {
            lDiv.className = "loaderHidden";
        }, 1000);
        running = false;
    }
    xhttp.onerror = function () {
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




function sendToSrv() {
    for (var k in request) {
        console.log("POST: " + k + " || " + request[k]);
    }

}




var xhttp = new XMLHttpRequest();
var acct;

function initializePage() {
    contactDB();
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