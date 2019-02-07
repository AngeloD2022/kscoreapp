//KENSTON GT-CLIENT CORE FRAMEWORK
//Coded by Angelo DeLuca
//Copyright (c) 2018 Kenston Local School District

var xhttp = new XMLHttpRequest();
var data;
var fireworks = false;
var wloaded = false;

window.onload = function () {
    wloaded = true;
};
document.getElementById("kball").style.display = "none";
document.getElementById("gball").style.display = "none";

setInterval(function () {
    if (wloaded) {
        fetchData();
    }
}, 1000)


function fetchData() {
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            if (data['misc'] != null) {
                changePIndicator(!('period' in data['misc']) ? 0 : data['misc'].period);
                if(data["finished"] == 1 && data["homeScore"] > data["oppScore"] && !fireworks){
                    fireworks = true;
                    endFw.play();
                }else if(fireworks && data["finished"] == 0){
                    fireworks = false;
                    endFw.stop();
                }
                if (data['misc'].ballPosess == "home") {
                    document.getElementById("kball").style.display = "inline-block";
                    document.getElementById("gball").style.display = "none";
                } else if (data['misc'].ballPosess == "guest") {
                    document.getElementById("kball").style.display = "none";
                    document.getElementById("gball").style.display = "inline-block";
                }
            } else {
                changePIndicator(0);
                updateDown(1);
            }
            document.getElementById("kscore").innerHTML = data["homeScore"] == null ? 0 : data["homeScore"];
            document.getElementById("gscore").innerHTML = data["oppScore"] == null ? 0 : data["oppScore"];
        }
    }
    xhttp.open("GET", "eventData.php?id=" + gid, true);
    xhttp.send();
}


var p1 = document.getElementById("p1");
var p2 = document.getElementById("p2");
var p3 = document.getElementById("p3");
var p4 = document.getElementById("p4");

var downNo = document.getElementById("dNum");
var downAfter = document.getElementById("numSuffix");

var pspi = p1;

function changePIndicator(v) {

    pspi.className = "pInd";
    if (v == 1) {
        p1.className = "pIndCurrent";
    } else if (v == 2) {
        p2.className = "pIndCurrent";
    } else if (v == 3) {
        p3.className = "pIndCurrent";
    } else if (v == 4) {
        p4.className = "pIndCurrent";
    }
    if (v == null) {
        pspi = document.getElementById("p1");
    }else if(v != 0){
        pspi = document.getElementById("p"+v);
    }
}


//CTIMER CORE -------------------------------

var txhttp = new XMLHttpRequest();
var timerdisplay = document.getElementById("tdisplay");
var tValCached = 0;
var timerStateLbl = document.getElementById("tstate");
var seconds;
var srvInitial;
var srvTime;
var tEnabled = false;


var checkTime = setInterval(function () {
    txhttp.open("GET", "timerData.php?id=" + gid, true);
    txhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var reply = JSON.parse(this.responseText);
            srvTime = reply["unix"];
            srvInitial = reply["startValue"];
            srvState = reply["currentState"];

            
            if (reply["currentState"] == "S" || reply["currentState"] == "P" || reply["currentState"] == "E") {
                if (tEnabled) {
                    clearInterval(timer);
                    tEnabled = false;
                }

                seconds = srvInitial;

                if (seconds < 0) {

                    timerdisplay.innerHTML = "00:00";

                } else {

                    timerdisplay.innerHTML = (Math.floor(seconds / 60) < 10 ? "0" + Math.floor(seconds / 60) : Math.floor(seconds / 60)) + ":" + (seconds % 60 < 10 ? "0" + seconds % 60 : seconds % 60);
                }

                timerStateLbl.innerHTML = "&#9612;&#9612;";
                timerStateLbl.style.color = "orange";

            } else if (reply["currentState"] == "R") {

                if (!tEnabled) {
                    runTimer();
                }

                timerStateLbl.innerHTML = "&#9654;";
                timerStateLbl.style.color = "green";
                seconds = srvInitial;
            }
            
        }
    }
    txhttp.send();
}, 1000);

var timer;


function runTimer() {

    tEnabled = true;
    timer = setInterval(function () {
        var now = new Date().getTime();
        var difference = now - srvTime;
        seconds = srvInitial - Math.floor(difference / 1000);

        if (seconds < 0) {
            timerdisplay.innerHTML = "00:00";
        } else {

            timerdisplay.innerHTML = (Math.floor(seconds / 60) < 10 ? "0" + Math.floor(seconds / 60) : Math.floor(seconds / 60)) + ":" + (seconds % 60 < 10 ? "0" + seconds % 60 : seconds % 60);
        }

    }, 200);
}