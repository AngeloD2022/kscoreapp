//KENSTON GT-CLIENT CORE FRAMEWORK
//Coded by Angelo DeLuca
//Copyright (c) 2018 Kenston Local School District

var xhttp = new XMLHttpRequest();
var data;

var wloaded = false;

window.onload = function(){wloaded=true;};

function fetchData(){
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            data = JSON.parse(this.responseText);
        }
    }
    xhttp.open("GET", "eventData.php", true);
    xhttp.send();
}


var q1 = document.getElementById("q1");
var q2 = document.getElementById("q2");
var q3 = document.getElementById("q3");
var q4 = document.getElementById("q4");

var downNo = document.getElementById("dNum");
var downAfter = document.getElementById("numSuffix");

var psqi = q1;
function changeQIndicator(v){
    psqi.className = "qInd";
    if(v == 1){
        q1.className = "qIndSelected";
    }else if(v == 2){
        q2.className = "qIndSelected";
    }else if(v == 3){
        q3.className = "qIndSelected";
    }else if(v == 4){
        q4.className = "qIndSelected";
    }
}
function updateDown(v){
    if(v == 1){
        downAfter.innerHTML = "st";
    }else if(v == 2){
        downAfter.innerHTML = "nd";
    }else if(v == 3){
        downAfter.innerHTML = "rd";
    }else if(v == 4){
        downAfter.innerHTML = "th";
    }
}