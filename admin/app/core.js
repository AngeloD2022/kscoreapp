var request = new Array();
var xhttp = new XMLHttpRequest();
var ms = 0;
//elements
var kenstonScoreDisplay = document.getElementById("kscore");
//scores
var KenstonScore = 0;
var GuestScore = 0;

//misc
//readServer();



function incrementScore(amount, team) {
    if (team == "k") {
        if (request.kscore == null) {
            request.kscore = 0;
        }
        request.addk = request.addk + amount;
        KenstonScore -= amount;
        ms = 0;
    } else {
        if (request.gscore == null) {
            request.gscore = 0;
        }
        request.addg = request.addg + amount;
        GuestScore -= amount;
        ms = 0;
    }
}

function decrementScore(amount, team) {
    if (team == "k") {
        if (request.kscore == null) {
            request.kscore = 0;
        }
        request.remk = request.kscore - amount;
        KenstonScore -= amount;
        ms = 0;
    } else {
        if (request.gscore == null) {
            request.gscore = 0;
        }
        request.gscore = request.gscore + amount;
        GuestScore -= amount;
        ms = 0;
    }
}

function changeMisc() {
    
}
var dLoad = document.getElementById("dLoad");
var dLsvg = document.getElementById("determinateSVG");
var lDiv = document.getElementById("loader");
function sendTimer() {
    dLoad.style.color = "rgb(0, 195, 255)";
    dLoad.style.strokeDashoffset = -313;
    lDiv.className = "loaderShown";
    console.log("start");
    var timer = setInterval(function () {
        ms++;
        dLoad.style.strokeDashoffset = parseInt(-313+((ms/300)*313));
        kenstonScoreDisplay.innerHTML = ms;
        if (ms == 300) {
            readServer();
            console.log("Done");
            //clear timer icon
            ms = 0;
            clearInterval(timer);
        }
    }, 10);
    
}

function readServer(){
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var updated = JSON.parse(this.responseText);
            for(var i = 0; i < updated.length; i++){
                if(updated[i].id == gameId){
                    KenstonScore = updated[i].homeScore;
                    GuestScore = updated[i].oppScore;
                    console.log("GT:Success\nHome:"+ KenstonScore+"\nGuest: "+GuestScore);
                }
            }
            
        }
    }
    xhttp.onloadstart = function(){
        //show indeterminite
        dLsvg.style.stroke = "rgb(255, 196, 87)";
        
    }
    xhttp.onload = function(){
        dLsvg.style.stroke = "rgb(0, 216, 11)";
        setTimeout(function(){
            lDiv.className = "loaderHidden";
        }, 1000)
    }
    xhttp.open("GET", "/data/events.php", true);
    xhttp.send();

}

function sendToSrv() {
    for (var k in request) {
        console.log("POST: " + k + " || " + request[k]);
    }
    
}
