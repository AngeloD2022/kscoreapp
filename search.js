var btn = document.querySelector("#sbtn");
var box = document.querySelector("#sbox");


window.addEventListener("click", function (event) {

if(event.target.nearestViewportElement != btn && event.srcElement != box && event.target.offsetParent != box && box.className.includes("SearchMenuOpened")){//(event.target != btndiv && event.target != box) && box.className.includes("SearchMenuOpened")){
    console.log("Click off");
    toggleSearchBox();
}

if(event.target.nearestViewportElement == btn){
    console.log("Button Click");
    toggleSearchBox();
}


});


function toggleSearchBox() {

    btn.classList.toggle("sbClicked");
    box.classList.toggle("SearchMenuOpened");
}



