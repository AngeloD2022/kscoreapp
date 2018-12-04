var request = new Array();
var xhttp = new XMLHttpRequest();
var secs = 0;


function incrementScore(amount, team) {
    if (team == "k") {
        if (request.addk == null) {
            request.addk = 0;
        }
        request.addk = request.addk + amount;
        secs = 0;
    } else {
        if (request.addg == null) {
            request.addg = 0;
        }
        request.addg = request.addg + amount;
        secs = 0;
    }
}

function decrementScore(amount, team) {
    if (team == "k") {
        if (request.remk == null) {
            request.remk = 0;
        }
        request.remk = remk + amount;
        secs = 0;
    } else {
        if (request.remg == null) {
            request.remg = 0;
        }
        request.remg = remg + amount;
        secs = 0;
    }
}

function changeMisc() {

}

function sendTimer() {

    var timer = setInterval(function () {
        secs++;
        if (secs == 3) {
            sendToSrv();
            clearInterval(timer);
        }
    }, 1000);

}

function sendToSrv() {
    for (var k in request) {
        console.log("output: " + k + " || " + request[k]);
    }


}