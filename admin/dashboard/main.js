var acct;
var xhttp = new XMLHttpRequest();



function createEvent() {

}


function getEventsFromDB() {
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == "not found" || this.responseText == "disabled") {
                document.location.href = "/admin";
            } else {
                //do stuff here
            }

        }
    }
    xhttp.open("GET", "/data/script.php", true);
    xhttp.send();
}


function getAcct() {//Contact database and verify cookies. get acct[]
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            if (this.responseText == "not found" || this.responseText == "disabled") {
                console.log("not found or disabled");

                document.location.href = "/admin";
            } else {
                var acc = JSON.parse(this.responseText);
                var acct = acc[0];
            }

        }
    }
    xhttp.open("GET", "/admin/script.php", true);
    xhttp.send();
}


var cemodal = document.querySelector("#createEvent");
var memodal = document.querySelector("#modEvent");
var cancelmodal = document.querySelector("#cancelEvent");

var ceTrigger = document.querySelector(".createEvent");
var metrigger = document.querySelector(".modEvent");
var cancelEvtrigger = document.querySelector(".cancelEvent");




var lastClicked = "create";
function toggleDialog(winType) {
    lastClicked = winType;
    if (winType == "create") {
        cemodal.classList.toggle("ModalOpened");
    } else if (winType == "mod") {
        memodal.classList.toggle("ModalOpened");
    } else if (winType == "cancel") {
        cancelmodal.classList.toggle("ModalOpened");
    }
}


function Logout(){
    document.cookie = "ksb_usr=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "ksb_pswd=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.location.href="/admin";
}






// --------- DATA PROCESSING -------------


