var xhttp = new XMLHttpRequest();
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
                document.getElementById("loginas").innerHTML = "Logged in as: "+ acct.name +" ("+acct.rname+")"+ ' <a href="#" onclick="Logout()"> Log out</a>';
                
            }

        }
    }
        xhttp.open("GET", "/admin/script.php", true);
        xhttp.send();
}




