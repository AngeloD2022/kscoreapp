//checks if account exists
var uname = document.querySelector("#uname");
var password = document.querySelector("#pswd");
var xhttp = new XMLHttpRequest();

function Login(){
    if(uname.value == "" || password.value == ""){
        alert("You can't leave fields blank.");
    }else{
        contactDB("script.php?u="+uname.value+"&p="+password.value);
    }
    
}

function contactDB(url){
    xhttp.onreadystatechange = function() {

        if(this.readyState == 4 && this.status == 200){

            if(this.responseText != "not found"){
                var acct = JSON.parse(this.responseText);
            }else{
                alert("Account not found.");
            }

        }
    }
    xhttp.open("GET", url, true);
    xhttp.send();
}

function testSys(arr){
    
}