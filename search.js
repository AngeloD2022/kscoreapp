var btn = document.querySelector("#sbtn");
var box = document.querySelector("#sbox");


window.addEventListener("click", function (event) {

    if (event.target.nearestViewportElement != btn && event.srcElement != box && event.target.offsetParent != box && box.className.includes("SearchMenuOpened")) {//(event.target != btndiv && event.target != box) && box.className.includes("SearchMenuOpened")){
        toggleSearchBox();
    }

    if (event.target.nearestViewportElement == btn) {
        toggleSearchBox();
    }


});

btn.addEventListener("touchend", toggleSearchBox);

function toggleSearchBox() {

    btn.classList.toggle("sbClicked");
    box.classList.toggle("SearchMenuOpened");
}








