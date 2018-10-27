var acct;
var xhttp = new XMLHttpRequest();



function createEvent(){

}


function getEventsFromDB(){
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){

            if(this.responseText == "not found" || this.responseText == "disabled"){
                document.location.href = "/admin";
            }else{
                //do stuff here
            }

        }
    }
        xhttp.open("GET", "/data/script.php", true);
        xhttp.send();
}


function getAcct(){//Contact database and verify cookies. get acct[]
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){

            if(this.responseText == "not found" || this.responseText == "disabled"){
                console.log("not found or disabled");

                document.location.href = "/admin";
            }else{
                var acc = JSON.parse(this.responseText);
                var acct = acc[0];
            }

        }
    }
        xhttp.open("GET", "/admin/script.php", true);
        xhttp.send();
}


var modal = document.querySelector("#createEvent");
var ceTrigger = document.querySelector(".createEvent");
var closeBtn = document.querySelector(".closeBtn");
//event listeners
ceTrigger.addEventListener("click", function(){ toggleDialog("create"); }, false);
closeBtn.addEventListener("click", function(){ toggleDialog(lastClicked); }, false);

var lastClicked;
function toggleDialog(winType){
    lastClicked = winType;
    if(winType == "create"){
        modal.classList.toggle("ModalOpened");
    }
}