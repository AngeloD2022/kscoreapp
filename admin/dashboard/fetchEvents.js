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

function launchEvent(id){
    console.log("LAUNCHING EV"+ id);
    
}