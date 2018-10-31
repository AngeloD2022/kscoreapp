var xhttp = new XMLHttpRequest();

function getAllGames(){
    xhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200){
            var gamesArr = JSON.parse(this.responseText);
        }
    }
    xhttp.open("GET", "/data/events.php", true);
    xhttp.send();
}

function displayGames(){
    
}