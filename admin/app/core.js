var request = new Array();
var xhttp = new XMLHttpRequest();
var ms = 0;

//scores
var KenstonScore = 0;
var GuestScore = 0;

//misc
updateGames();

function updateGames(){
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
 xhttp.open("GET", "/data/events.php", true);
 xhttp.send();

}


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

function sendTimer() {
    //show timer icon
    var timer = setInterval(function () {
        ms++;
        if (ms == 3000) {
            sendToSrv();
            //clear timer icon
            clearInterval(timer);
        }
    }, 1);

}

function sendToSrv() {
    for (var k in request) {
        console.log("POST: " + k + " || " + request[k]);
    }

}

xhttp.onloadstart = function(){
    //show indeterminite
}
xhttp.onloadend = function(){
    //hide indeterminite
}