//checks if account exists
var uname = document.querySelector("#uname");
var password = document.querySelector("#pswd");
var xhttp = new XMLHttpRequest();
var statbar = document.querySelector("#stat");

function Login(){
    showLoad();
    if(uname.value == "" || password.value == ""){
        alert("You can't leave fields blank.");
    }else{
        contactDB("script.php?u="+uname.value+"&p="+password.value);
    }
    
}

function contactDB(url){
    showLoad();
    xhttp.onreadystatechange = function() {

        if(this.readyState == 4 && this.status == 200){

            if(this.responseText == "not found"){
                statbar.style.color = "red";
                statbar.innerHTML = "Invalid username/password";
            }else if(this.responseText == "disabled"){
                statbar.style.color = "red";
                statbar.innerHTML = "Your account has been disabled by an administrator.";

            }else{
                var acct = JSON.parse(this.responseText);
                statbar.style.color = "green";
                statbar.innerHTML = "Logging you in...";
                
                
                finishUp(acct);
            }
            endLoad();
        }
    }
    xhttp.open("GET", url, true);
    xhttp.send();
}

function endLoad(){
    var loader = document.querySelector(".loader");
    loader.style.visibility = "hidden";
    loader.style.display = "none";
}
function showLoad(){
    var loader = document.querySelector(".loader");
    loader.style.visibility = "visible";
    loader.style.display = "block";
}

function finishUp(arr){
    var account = arr[0];
    
    //set cookie
    
    
    var d = new Date();
    d.setTime(d.getTime() + (30*24*60*60*1000));
    var expires = "expires="+ d.toGMTString();
    document.cookie = "ksb_usr="+account.name+";"+expires+";path=/";
    document.cookie = "ksb_pswd="+account.passwordSHA256+";"+expires+";path=/";

    //navigate to mainPage
    document.location.href = "/admin/dashboard/";
    
}