var xhttp = new XMLHttpRequest();
var url = "/admin/script.php";
var acct;
function initializePage(){

    contactDB();
}



function contactDB(){
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){

            if(this.responseText == "not found" || this.responseText == "disabled"){
                console.log("not found or disabled");

                document.location.href = "/admin";
            }else{
                var acc = JSON.parse(this.responseText);
                var acct = acc[0];
                document.getElementById("loginas").innerHTML = "Logged in as: "+ acct.name +" ("+acct.rname+")";
            }

        }
    }
        xhttp.open("GET", url, true);
        xhttp.send();
}