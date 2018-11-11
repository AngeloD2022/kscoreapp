var btn = document.querySelector("#sbtn");
var box = document.querySelector("#sbox");

document.addEventListener("click", function(event) {
    
    
    if (event.currentTarget != box && event.currentTarget === btn && box.className === "SearchMenuDefault SearchMenuOpened"){//clicks on not the box and not the button (which means it's outside of the div) and while div is open
       console.log("clicked on");
    }else if(event.currentTarget === btn && box.className === "SearchMenuDefault SearchMenuOpened"){
        
    }
    else{
       
    }
    

});


function toggleSearchBox(){
    
    btn.classList.toggle("sbClicked");
    box.classList.toggle("SearchMenuOpened");
}



