var xhttp = new XMLHttpRequest();
function editEvent(id){
    console.log("Updating event "+ id);
    //Send request to php file and update table entry
}
function deleteEvent(id){
    var r = confirm("Do you want to delete event "+ id+"?");
    if(r){
        console.log("Deleting event "+ id);
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200){
    
                if(this.responseText.includes("error_") && !this.responseText.includes("auth")){
                    alert("There was an error performing this action");
                }else if(this.responseText.includes("error_auth")){
                    alert("There was an authentication error. Reloading the page.");
                    document.location.reload();
                }else{
                    alert("Successfully deleted event "+id);
                    document.location.reload();
                }
    
            }
        }
            xhttp.open("GET", "data/deleteEvent.php?id="+id, true);
            xhttp.send();
    
    }
    
}



function launchEvent(id, btn){
    button = btn;
    console.log("LAUNCHING EV"+ id);
    console.log("Loading...");
    btn.disabled = true;
    btn.style.backgroundColor = "orange";
    btn.style.cursor = "not-allowed";
    btn.innerHTML = "Launching...";
    setTimeout(function(){
        btn.innerHTML = "App opened";
        var w = 1500;
        var h = 900;

        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;
        
        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
        
        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open("/admin/app?id="+id, "GameTime V1.0", 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
         
        var timer = setInterval(function() {   
            if(newWindow.closed) {    
                closed(btn); 
                clearInterval(timer);
            }  
        }, 1000);

    }, 500);
    
}

function closed(btn){
    console.log("GameTime: App closed");
    btn.disabled = false;
    btn.style = null;
    btn.innerHTML = "Launch";
}

