function editEvent(id){
    console.log("Updating event "+ id);
    //Send request to php file and update table entry
}
function deleteEvent(id){
    var r = confirm("Do you want to delete event "+ id+"?");
    if(r){
        console.log("Deleting event "+ id);
    }
    
}



function launchEvent(id, btn){
    button = btn;
    console.log("LAUNCHING EV"+ id);
    console.log("Loading...");
    btn.disabled = true;
    btn.style.backgroundColor = "orange";
    btn.innerHTML = "Launching...";
    setTimeout(function(){
        btn.innerHTML = "App opened";
        var w = 500;
        var h = 500;

        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;
        
        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
        
        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open("/admin/app?id="+id, "GameTime V1.0", 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        newWindow.document.write("<button onclick=\"window.close()\">close</button>");
         
        var timer = setInterval(function() {   
            if(newWindow.closed) {
                console.log("testing...");    
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

