

function initializePage(){
    if(findCookie("ksb_usr") == "" || findCookie("ksb_pswd") == ""){
        document.location.href = "/admin";
    }
}



function findCookie(cname){
    var cookies = decodeURIComponent(document.cookie);
    var name = cname + "=";
    var cookieSplit = cookies.split(';');
    for(var i = 0; cookieSplit.length; i++){
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
