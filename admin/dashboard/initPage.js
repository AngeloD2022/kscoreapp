var xhttp = new XMLHttpRequest();
var url = "/script.php";
function initializePage(){
    var usr = findCookie("ksb_usr");
    var pw = findCookie("ksb_pswd");
    if(usr == "" || pw == ""){
        document.location.href = "/admin";
    }else{
        if()
    }
}



function findCookie(cname){
    var cookies = decodeURIComponent(document.cookie);
    var name = cname + "=";
    var cookieSplit = cookies.split(';');
    for(var i = 0; i < cookieSplit.length; i++){
        var c = cookieSplit[i];
        
        while(String(c).charAt(0) == ' '){
            c = c.substring(1);
        }
        if(String(c).indexOf(name) == 0){
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


function contactDB(){
    xhttp.onreadystatechange = function() {
        if()
    }
        xhttp.open("GET", url, true);
        xhttp.send();
}