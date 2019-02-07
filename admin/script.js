//checks if account exists
var uname = document.querySelector("#uname");
var password = document.querySelector("#pswd");
var xhttp = new XMLHttpRequest();
var statbar = document.querySelector("#stat");
var request = {};

function Login() {
  showLoad();
  if (uname.value == "" || password.value == "") {
    alert("You can't leave fields blank.");
    endLoad();
  } else {
    request.u = uname.value;
    request.p = password.value;
    contactDB();
  }
}

function testForCookies() {
  if (findCookie("ksb_usr") != null && findCookie("ksb_pswd") != null) {
    var loader = document.querySelector(".loader");
    loader.style.visibility = "visible";
    loader.style.display = "block";
    cookieTest();
  }
}

function resetStatbar(){
  statbar.innerHTML = "Please enter your Login details.";
  statbar.style.color = "black";
}

document.querySelector("#pswd").onkeypress = function (e) {
  var event = e || window.event;
  var char = event.which || event.keyCode;
  if (char == '13') {
    Login();
  }
}


function cookieTest() {

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "not found" || this.responseText == "disabled") {
      } else {

        document.location.href = "/admin/dashboard";
      }
    }
  };
  xhttp.open("GET", "script.php", true);
  xhttp.send();
  endLoad();
}



function contactDB() {
  showLoad();
  xhttp.open("POST", "script.php", true);
  xhttp.setRequestHeader('Content-type', 'application/json; charset=utf-8');
  var raw = JSON.stringify(request);


  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "not found") {
        statbar.style.color = "red";
        statbar.innerHTML = "Invalid username/password";
      } else if (this.responseText == "disabled") {
        statbar.style.color = "red";
        statbar.innerHTML =
          "Your account has been disabled by an administrator.";
      } else {
        var acct = JSON.parse(this.responseText);
        statbar.style.color = "green";
        statbar.innerHTML = "Logging you in...";

        finishUp(acct);
      }
      endLoad();
    }
  };
  xhttp.send(raw);
}

function endLoad() {
  var loader = document.querySelector(".loader");
  loader.style.visibility = "hidden";
  loader.style.display = "none";
}
function showLoad() {
  var loader = document.querySelector(".loader");
  loader.style.visibility = "visible";
  loader.style.display = "block";
}

function findCookie(cname) {
  var cookies = decodeURIComponent(document.cookie);
  var name = cname + "=";
  var cookieSplit = cookies.split(";");
  for (var i = 0; i < cookieSplit.length; i++) {
    var c = cookieSplit[i];

    while (String(c).charAt(0) == " ") {
      c = c.substring(1);
    }
    if (String(c).indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function finishUp(arr) {
  var account = arr[0];

  //set cookie

  var checkbox = document.querySelector("#remember");
  if (remember.checked == true) {
    var d = new Date();
    d.setTime(d.getTime() + 30 * 24 * 60 * 60 * 1000);
    var expires = "expires=" + d.toGMTString();
    document.cookie = "ksb_usr=" + account.name + ";" + expires + ";path=/";
    document.cookie =
      "ksb_pswd=" + account.passwordSHA256 + ";" + expires + ";path=/";
  } else {
    document.cookie = "ksb_usr=" + account.name + ";path=/";
    document.cookie = "ksb_pswd=" + account.passwordSHA256 + ";path=/";
  }

  //navigate to mainPage
  document.location.href = "/admin/dashboard/";
}
