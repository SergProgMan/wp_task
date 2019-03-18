console.log('random-color');
window.onload=function(){
    if(document.querySelector('.activateScript')){
        var x = document.querySelectorAll(".coloredDiv");
        //console.log(x);
        x.forEach(setRandomColor);
    }    
}

function setRandomColor(el){
    var red = Math.floor((Math.random()*256)+0);
    var blue = Math.floor((Math.random()*256)+0);
    var green = Math.floor((Math.random()*256)+0);
    el.style.backgroundColor = 'rgb('+red+','+green+','+blue+')';
}


