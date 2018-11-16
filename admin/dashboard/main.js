var acct;
var xhttp = new XMLHttpRequest();






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
var eventName = document.getElementById("ce_name");
var opposingTeam = document.getElementById("ce_opposing");
var startTime = document.getElementById("ce_timestart");
var teamClass = document.getElementById("ce_teamclass");
var grade = document.getElementById("ce_grade");
var eventLocation = document.getElementById("ce_location");
var opponentLogoUrl = document.getElementById("ce_oppLogo");
var sport = document.getElementById("ce_sport");


function createSportEvent(){
    //get vals from fields
    //check if any are null
    if(eventName.value == null || opposingTeam.value == null || startTime.value == null || teamClass.value == null || grade.value == "NONE" || eventLocation.value == null || opponentLogoUrl.value == null || sport.value == "NONE"){
        alert("You must complete all required fields.");
    }else{
        var url = "data/createEvent.php?gname="+eventName.value+"&gopposing="+opposingTeam.value+"&timeStart="+startTime.value+"&tclass="+teamClass.value+"&grade="+grade.value+"&gloc="+eventLocation.value+"&opplogo="+opponentLogoUrl.value+"&sport="+sport.value;
        xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
    
                if (this.responseText.includes("error")) {
                    console.log(this.responseText);
                    if(this.responseText.includes("auth")){
                        alert("Authentication error. Reloading page...");
                        document.location.reload();
                    }else{
                        alert("Error from server: "+ this.responseText);
                    }
                } else {
                    alert("Event created successfully.");
                    toggleDialog("create");
                    clearFields();
                    document.location.reload();
                }
    
            }
        }
        xhttp.open("GET", url, true);
        xhttp.send();
    }


}





function clearFields() {
    eventName.value = "";
    opposingTeam.value = "";
    startTime.value = "";
    teamClass.value = "";
    grade.value = "NONE";
    eventLocation.value = "";
    opponentLogoUrl.value = "";
    sport.value = "NONE";
}