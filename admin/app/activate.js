var xhttp = new XMLHttpRequest();
function activateEvent(){
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText.includes("error")){
                if(this.responseText.includes("auth")){
                    alert("Authentication error");
                    document.location.reload();
                }else{
                    alert("An error occured. \n"+this.responseText);
                }
            }else{
                alert("Event "+gid+" successfully activated.");
                window.location.reload();
            }
        }
    }
    xhttp.onload = function(){
        document.getElementById("activatebtn").innerHTML = "<strong>Activating...</strong>";
    }
    xhttp.onload = function(){
        document.getElementById("activatebtn").innerHTML = "<strong>Yes</strong>";
    }
    xhttp.open("GET", "activategame.php?id="+gid, true);
    xhttp.send();
}
