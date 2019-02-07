//KENSTON GT-CLIENT CORE FRAMEWORK
//Coded by Angelo DeLuca
//Copyright (c) 2018 Kenston Local School District

var xhttp = new XMLHttpRequest();
var data;
var fireworks = false;
var wloaded = false;

window.onload = function(){wloaded=true;};
document.getElementById("kball").style.display = "none";
document.getElementById("gball").style.display = "none";

setInterval(function(){
    if(wloaded){
        fetchData();
    }
}, 1000)

function fetchData(){
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            data = JSON.parse(this.responseText);
            if(data['misc'] != null){
                if(data["finished"] == 1 && data["homeScore"] > data["oppScore"] && !fireworks){
                    fireworks = true;
                    endFw.play();
                }else if(fireworks && data["finished"] == 0){
                    fireworks = false;
                    endFw.stop();
                }
                changeQIndicator(!('quarter' in data['misc']) ? 0 : data['misc'].quarter);
                updateDown(!('down' in data['misc'])  ? 1 :  data['misc'].down);
                document.getElementById("ydsToGo").innerHTML = data['misc'].ydsToGo == null? 0 : data['misc'].ydsToGo;
                document.getElementById("ydsBallOn").innerHTML = data['misc'].ydsBallOn == null? 0 : data['misc'].ydsBallOn;
                var ballOn = data['misc'].ydsBallOn;
                document.getElementById("ydsBallOn").innerHTML = ballOn + (data['misc'].ballOnTeam == "home"? " Home" : " Guest");
                if(data['misc'].ballPosess == "home"){
                    document.getElementById("kball").style.display = "inline-block";
                    document.getElementById("gball").style.display = "none";
                }else if(data['misc'].ballPosess == "guest"){
                    document.getElementById("kball").style.display = "none";
                    document.getElementById("gball").style.display = "inline-block";
                }
            }else{
                changeQIndicator(0);
                updateDown(1);
            }
            document.getElementById("kscore").innerHTML = data["homeScore"] == null? 0 : data["homeScore"];
            document.getElementById("gscore").innerHTML = data["oppScore"] == null? 0 : data["oppScore"];
        }
    }
    xhttp.open("GET", "eventData.php?id="+gid, true);
    xhttp.send();
}


var q1 = document.getElementById("q1");
var q2 = document.getElementById("q2");
var q3 = document.getElementById("q3");
var q4 = document.getElementById("q4");

var downNo = document.getElementById("dNum");
var downAfter = document.getElementById("numSuffix");

var psqi = q1;
function changeQIndicator(v){

    psqi.className = "qInd";
    if(v == 1){
        q1.className = "qIndCurrent";
    }else if(v == 2){
        q2.className = "qIndCurrent";
    }else if(v == 3){
        q3.className = "qIndCurrent";
    }else if(v == 4){
        q4.className = "qIndCurrent";
    }
    if(v == null){
        psqi = document.getElementById("q1");
    }
}
function updateDown(v){
    downNo.innerHTML = v;
    if(v == 1){
        downAfter.innerHTML = "st";
    }else if(v == 2){
        downAfter.innerHTML = "nd";
    }else if(v == 3){
        downAfter.innerHTML = "rd";
    }else if(v == 4){
        downAfter.innerHTML = "th";
    }
}