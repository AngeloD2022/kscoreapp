function updateGames(){
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
        var updated = JSON.parse(this.responseText);
        for(var i = 0; i < ids.length; i++){
            var hs document.getElementByID("hsID"+ids[i]);
            var gs document.getElementByID("gsID"+ids[i]);
            if(hs.innerHTML == updated)
        }
    }
    xhttp.open("GET", "data/events.php", true);
    xhttp.send();
}